<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<!-- <link rel="stylesheet" type="text/css" href="../css/admin.css"> -->
	<script src='../js/pdfmake_2.10.min.js'></script>
	<script src='../js/vfs_fonts.min.js'></script>
	<script src="../js/pricing.js" type="text/javascript"></script>
	<style type="text/css">

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
		input[name=number_price]{
			margin: 20px;
		}

	</style>
</head>
<body>

	<?php
		include "../../config_cms.php";

		$dirs = [];
		$db = new SQLite3("../pricing.db");
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

	<input type="text" name="number_price" placeholder="Номер счета">

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