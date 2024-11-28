<style type="text/css">
	.output_bold{
		font-weight: bold;
	}
	.zam_img{
		width: 60px;
		height: 60px;
	}
	.column-block{
		display: flex;
		flex-direction: column;
		border: 1px solid gray;
		margin-right: 5px;
		margin-top: 5px;
		padding: 3px;
	}
	.flex-wrap{
		display: flex;
		flex-wrap: wrap;
	}
	.flex-wrap > span{
		margin-right: 10px;
		border: 1px solid grey;
		margin-top: 10px;
		padding: 3px;
	}
	.row_obj{
		display: flex; 
		flex-wrap: wrap;
	}
	.row_obj span{
		margin-right: 10px;
		padding: 3px;
	}
	table {
		border-collapse: collapse;
		border: 1px solid grey;
	}
	td {
		border: 1px solid grey;
		padding: 3px;
	}
	.input-width{
		width: 80px;
	}
</style>

<?php
	$db = new SQLite3('crm.db');
	$idZamer = $_GET['idZamer'];	
?>
<title>Замер № <?php echo $idZamer?></title>

<script src="../js/fancybox.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="../css/fancybox.css">

<script type="text/javascript">
	async function createZakaz(){
		let url = new URL(window.location.href)
		let idZamer = url.searchParams.get('idZamer')

		let fd = new FormData()
		fd.append("comand", "createZakaz")
		fd.append("idZamer", idZamer)
		fd.append('sum', document.querySelector("input[name=sum]").value)
		fd.append('sumZakupki', document.querySelector('.sumZakupId').innerText)
		fd.append('prepay', document.querySelector("input[name=prepay]").value)
		fd.append('deadline', document.querySelector("input[name=deadline]").value)


		let res = await fetch('handlerCRM.php', {method: 'POST',body: fd});

		checkRespondServer(res)	
		
		document.querySelector('.createZakaz_btn_id').remove()
	}
	window.addEventListener("DOMContentLoaded", ()=>{
		Fancybox.bind("[data-fancybox='gallary']",{})
	})
</script>

<?php 
	echo "<a href='edit_zamer?idZamer={$_GET['idZamer']}'>Рeдактировать замер</a>";
?>

<?php 

	function print_simple_value($val, $head){
		echo "<span style='display: flex; flex-direction: column;'>";
			echo "<span style='font-weight: bold;'>$head</span>";
			echo "<span style='text-align: center;'>$val</span>";
		echo "</span>";
	}

	function print_obj($obj, $head){
		echo "<span style='display: flex; flex-direction: column;'>";
			echo "<span style='font-weight: bold;'>$head</span>";
			foreach ($obj as $key => $value) {
				if(is_bool($value)){
					if($value){
						echo "<span>$key: да</span>";
					}else{
						echo "<span>$key: нет</span>";
					}
					continue;
				}
				echo "<span>$key: $value</span>";
			}
		echo "</span>";
	}

	function print_arr_obj($arr, $head){
		foreach ($arr as $obj) {
			print_obj($obj, $head);
		}
	}

	function print_row_obj($arr, $head){
		foreach ($arr as $obj) {
			echo "<div style='margin-top: 3px; padding: 3px; border: 1px solid grey;'>";
				echo "<div style='text-align: center; font-weight: bold;'>$head</div>";
				echo "<div class='row_obj'>";
				foreach ($obj as $key => $value) {
					if(is_bool($value)){
						if($value){
							echo "<span>$key: да</span>";
						}else{
							echo "<span>$key: нет</span>";
						}
						continue;
					}
					echo "<span>$key: $value</span>";
				}
				echo "</div>";
			echo "</div>";
		}

	}

	
	$zamer = $db->query("SELECT * FROM zamer WHERE id = {$_GET['idZamer']}")->fetchArray(SQLITE3_ASSOC);

	$zam_js = json_decode($zamer['json']);

	$rooms = $zam_js->rooms;
	$sum_data = $zam_js->sum_data;
	$sum_wall = $zam_js->sum_wall;
	$sum_mat = $zam_js->sum_mat;
	$sum_polotna = $zam_js->sum_polotna;


	$keys_room = ["стена А","стена Б","площадь", "перим.","полотно", "доп. углы"];
	$keys2 = ['стены',"люстры","обвод тр",'вент', "споты клиента","споты наши","имитация стены"];
	$key3 = [ "гардина накладная", "гардина скрытая", "световые линии", "парящий", "теневой"];


	for($i=0; $i<count($rooms); $i++){
		echo "<div style='margin-top:10px; border: 1px solid grey;'>";
			echo "<h3 style='margin-bottom:5px;'>Помещение: {$rooms[$i]->{'помещение'}}</h3>";
			echo "<div class='rooms-block'>";
				if(array_key_exists("фото", $rooms[$i])){
					echo "<img data-fancybox='gallary' class='zam_img' src='img_admin/img_zamer/{$rooms[$i]->{'фото'}}'>";
				}
				echo "<div class='flex-wrap'>";
					foreach ($keys_room as $kr) {
						if(array_key_exists($kr, $rooms[$i]))
							echo "<span>$kr: {$rooms[$i]->$kr}</span>";
					}
				echo "</div>";
				echo "<div class='flex-wrap'>";
					foreach ($keys2 as $kr) {
						if(array_key_exists($kr, $rooms[$i]))
							if(is_array($rooms[$i]->$kr)){
								print_arr_obj($rooms[$i]->$kr, $kr);
							}elseif(is_object($rooms[$i]->$kr)){
								print_obj($rooms[$i]->$kr, $kr);
							}else{
								print_simple_value($rooms[$i]->$kr, $kr);
							}

					}
				echo "</div>";
				foreach ($key3 as $kr) {
					if(array_key_exists($kr, $rooms[$i])){
						print_row_obj($rooms[$i]->$kr, $kr);
					}
				}

			echo "</div>";

		echo "</div>";
	}



	

	$res = $db->query("SELECT * FROM products");
	$prod = [];
	while($r = $res->fetchArray(SQLITE3_ASSOC)){
		$prod[] = $r;
	}

	$ob = 0;

	function print_table_row($arr){
		global $prod, $ob, $sum_zakaz;


		$itog = 0;
		$n = 1;
		foreach ($arr as $k_sum => $v_sum) {
			echo "<tr>";
				echo "<td>$n</td>";
				$n++;
				echo "<td>$k_sum</td>";
				echo "<td>$v_sum</td>";
				$fl = false;
				foreach ($prod as $v_p) {
					if($v_p['name'] == $k_sum){
						$fl = true;
						$rub = ceil($v_p['price'] * $v_sum);
						$itog += $rub;
						$ob += $rub;
						echo "<td>{$v_p['metric']}</td>";
						echo "<td>{$v_p['price']}</td>";
						echo "<td>$rub</td>";
					}
				}
				if($fl == false){
					echo "<td></td>";
					echo "<td></td>";
					echo "<td>не найдено</td>";
				}
		}
		$sum_zakaz += $itog;
		echo "<tr><td></td><td>Итого</td><td></td><td></td><td></td><td style='font-weight:bold;'>$itog</td></tr>";
	}

	function out_polotna($arr){
		global $ob, $sum_zakaz;
		$loc = 0;
		$sq = 0;
		$n = 1;
		foreach ($arr as $v) {
			echo "<tr>";
				echo "<td>$n</td>";
				$n++;
				$name = "без имени";
				if($v->{'название комнаты'} != ""){
					$name = $v->{'название комнаты'};
				}

				echo "<td>$name</td>";
				echo "<td>{$v->{'м2'}}</td>";
				echo "<td>{$v->{'фактура'}}</td>";
				$sq += $v->{"м2"};
				$s = ceil(180*$v->{'м2'});
				$loc += $s;
				echo "<td>180</td>";
				echo "<td>$s</td>";
			echo "</tr>";

		}
		$ob += $loc;
		$sum_zakaz += $loc;
		echo "<tr><td></td><td>Итого</td><td>$sq</td><td></td><td></td><td style='font-weight:bold;'>$loc</td></tr>";
	}

?>
<div style="margin-top: 20px; border: 1px solid grey;">
	<?php
		$sum_zakaz = 0;
	?>
	<h3>Полотна</h3>
	<table>
		<thead>
			<tr>
				<td>#</td>
				<td>помещение</td>
				<td>м2</td>
				<td>факт/цвет</td>
				<td>цена</td>
				<td>сумма</td>
			</tr>
		</thead>
		<tbody>
			<?php out_polotna($sum_polotna)?>
		</tdoby>
	</table>

	<h3>комплектующие</h3>

	<table>
		<thead>
			<tr>
				<td>#</td>
				<td>наименование</td>
				<td>кол.</td>
				<td>ед.</td>
				<td>цена</td>
				<td>сумма</td>
			</tr>
		</thead>
		<tbody>
			<?php print_table_row($sum_mat)?>
		</tdoby>
	</table>


	<h3>Закупка на сумму: <span class="sumZakupId"><?php echo $sum_zakaz?></span></h3>

	
	<?php if(!$zamer['ref_zakupki']):?>
		<div>
			<div>
				<span>Общая сумма договора</span>
				<input class="input-width" type="number" name="sum">
			</div>
			<div>
				<span>Предоплата</span>
				<input class="input-width" type="number" name="prepay">
			</div>
			<div>
				<span>Сроки</span>
				<input class="input-width" type="number" name="deadline">
			</div>
		</div>
		<button class='createZakaz_btn_id' style='margin: 10px;' onclick='createZakaz()'>Создать договор</button>
	<?php else:?>
		<?php
			$zakup = $db->query("SELECT * FROM zakupki WHERE id = {$zamer['ref_zakupki']}")->fetchArray(SQLITE3_ASSOC);
			echo "<h4>Закупка номер № {$zakup['id']} статус : {$zakup['status']}</h4>";
			$clientZakaz = $db->query("SELECT * FROM clientZakaz WHERE ref_zamer = {$_GET['idZamer']}")->fetchArray(SQLITE3_ASSOC);
			echo "<h4>Сумма договора : {$clientZakaz['sum']}</h4>";
			echo "<h4>Предоплата : {$clientZakaz['prepay']}</h4>";
			echo "<h4>Сроки : {$clientZakaz['deadline']}</h4>";
		?>
	<?php endif?>
</div>



<h3>Работа</h3>


<table>
	<thead>
		<tr>
			<td>#</td>
			<td>наименование</td>
			<td>кол.</td>
			<td>ед.</td>
			<td>цена</td>
			<td>сумма</td>
		</tr>
	</thead>
	<tbody>
		<?php print_table_row($sum_data)?>
	</tdoby>
</table>

<h3>Стены</h3>
<?php
foreach ($sum_wall as $k => $v) {
	echo "<div>$k : $v м.п</div>";
}
echo "<h3>Общее $ob руб.</h3>";
?>