<script defer src='js/pdfmake_2.10.min.js'></script>
<script defer src='js/vfs_fonts.min.js'></script>
<script defer src='js/create_shet.js'></script>
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
		<span>Номер счета</span>
		<input autocomplete="off" type="text">
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
				<td><img class="close_png" src='../img/close.png'></td>
				<td><input name='name' style="width: 200px;" type="text"></td>
				<td><input name='mert' style="width: 50px;" type="text"></td>
				<td><input name="count" style="width: 50px;" type="text"></td>
				<td><input name='price' style="width: 100px;" type="text"></td>
				<td><input name='sum' style="width: 100px;" type="text"></td>
			</tr>
		</tbody>
	</table>
	<img class="plus_png" src='../img/plus.png'>
</div>
<button name='total'>Итого</button>
<button name='open'>открыть</button>