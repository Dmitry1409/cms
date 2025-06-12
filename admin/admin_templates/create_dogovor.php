

	<script defer src='js/pdfmake_2.10.min.js'></script>
	<script defer src='js/vfs_fonts.min.js'></script>
	<script defer src="js/create_dogovor.js" type="text/javascript"></script>
	<script defer src="js/shet_and_dogovor_action.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="css/dogovor_shet_style.css">
	

	<?php

		$dirs = [];
		$db = new SQLite3("crm.db");
		$res = $db->query("SELECT * FROM dir_catalog");
		$allData = [];
		while($o = $res->fetchArray(SQLITE3_ASSOC)){
			$allData[] = $o;
		}
		$res = $db->query("SELECT * FROM products");
		$allProduct = [];
		while($o = $res->fetchArray(SQLITE3_ASSOC)){
			$allProduct[] = $o;
		}


		function print_prod($parent){
			global $allProduct;
			$fl = false;
			foreach ($allProduct as $pk => $pv) {
				if($pv['parent_dir'] == $parent){
					if(!$fl){
						$fl = true;
						echo "<ul class='ulclose'>";
					}
					$id = $pv['id'];
					echo "<li data_id='$id'>".$pv['name'];
				}
			}
			if($fl){
				echo "</li>";
				echo "</ul>";
			}
		}

		function printRecurs($name){
			global $allData;
			$fl = false;
			foreach ($allData as $k => $v) {
				if($v['parent'] == $name){
					if(!$fl){
						echo "<ul class='ulclose'>";
						$fl = true;
					}
					echo "<li>";
					echo $v['name'];
					printRecurs($v['name']);
				}
			}
			if($fl){
				echo "</ul>";
			}else{
				print_prod($name);
			}
		}


		echo "<ul>";
		foreach ($allData as $k => $v) {
			if($v['parent'] == null){
				echo "<li>".$v['name'];
				printRecurs($v['name']);
			}
		}
		echo "</ul>";

	?>

	<div class="wrapp_input_dogov flex-column">
		<span class="flex-column" style="max-width: 200px;">
			<span>Номер договора</span>
			<input autocomplete="off" type="text">
		</span>
		<span class="flex-column">
			<span>Имя клиента</span>
			<input autocomplete="off" type="text">
		</span>
		<span style="max-width: 200px;" class="flex-column">
			<span>Дата</span>
			<input autocomplete="off" type="text">
		</span>
		<span class="flex-column">
			<span>Адрес</span>
			<input autocomplete="off" type="text">
		</span>
		<span class="flex-column">
			<span>Сумма</span>
			<input style="max-width: 200px;" autocomplete="off" type="text">
		</span>
		<span class="flex-column">
			<span>Предоплата</span>
			<input style="max-width: 200px;" autocomplete="off" type="text">
		</span>
		<span class="flex-column">
			<span>Сроки</span>
			<input style="max-width: 200px;" autocomplete="off" type="text">
		</span>	
	</div>

	<div class="tableWrap" style="overflow: scroll;">
		
		<table>
			<thead>
				<tr>
					<td></td>
					<td>Наименование</td>
					<td>Ед.изм</td>
					<td>Кол.</td>
					<td>Цена</td>
					<td>Сумма</td>
				</tr>
			</thead>
			<tbody>
				<tr class="itog_tr">
					<td style="width: 15px;"></td>
					<td class="name_tov_table"><input value="Итого" autocomplete="off" name='name' type="text"></td>
					<td class="digit_inp_tabl"><input autocomplete="off" name='mert' type="text"></td>
					<td class="digit_inp_tabl"><input autocomplete="off" name="count" type="text"></td>
					<td class="price_row"><input autocomplete="off" name='price' type="text"></td>
					<td class="sum_itog"><input autocomplete="off" name='sum_itog' type="text"></td>
				</tr>
			</tbody>
		</table>
		<img class="plus_png" src='../img/plus.png'>
	</div>
	<button name='open'>открыть</button>
