

	<script defer src='js/pdfmake_2.10.min.js'></script>
	<script defer src='js/vfs_fonts.min.js'></script>
	<script defer src="js/pricing.js" type="text/javascript"></script>
	<style  type="text/css">

		.plus_png{
			width: 20px;
		}

		.tableWrap{
			overflow: auto;
		}
		.close_png{
			width: 20px;
			opacity: 0;
			transition: 0.3s;
		}
		.close_png:hover{
			opacity: 1;
		}
		.ulclose{
			height: 0;			
		}
		ul{
			transition: 0.5s;
			overflow: hidden;
		}
		li{
			cursor: default;
			font-size: 18px;
		}

		.flex-column{
			display: flex; 
			flex-direction: column;
			margin-bottom: 10px;
		}
	</style>

	<?php
		include "../config_cms.php";

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
		// echo var_dump($allProduct);

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
				<tr>
					<td><img class="close_png" src=<?php echo $root_dir."img/close.png"?>></td>
					<td><input name='name' style="width: 200px;" type="text"></td>
					<td><input name='mert' style="width: 50px;" type="text"></td>
					<td><input name="count" style="width: 50px;" type="text"></td>
					<td><input name='price' style="width: 100px;" type="text"></td>
					<td><input name='sum' style="width: 100px;" type="text"></td>
				</tr>
			</tbody>
		</table>
		<img class="plus_png" src=<?php echo $root_dir."img/plus.png"?>>
	</div>
	<button name='total'>Итого</button>
	<button name='open'>открыть</button>
</body>
</html>