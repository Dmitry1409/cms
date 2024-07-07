<style type="text/css">
	.addClientWrap{
		display: flex;
		flex-wrap: wrap;
	}
	.addClientWrap input, .addClientWrap textarea{
		margin: 3px;
	}
	table{
		border-collapse: collapse;
		border: 1px solid gray;
	}
	td{
		border: 1px solid gray;
		padding: 4px;
	}
	.bottom-border{
		border-bottom: 1px solid grey;
	}
	.flex-column div:last-child{
		border-bottom: none;
	}
	.flex-column{
		display: flex;
		flex-direction: column;
	}
	.font-bold{
		font-weight: bold;
	}
</style>
<script type="text/javascript" src="js/allClient.js"></script>



<div class="addClientWrap">
	<input placeholder="Имя" type="text" name="clientName">
	<input placeholder="Телефон" type="number" name="telehon">
	<input placeholder="Адрес объекта" type="text" name="address">
	<input placeholder="Тип объекта" type="text" name="type">
	<input name="desc" placeholder="Описание">
	<input type="text" placeholder="Откуда нас нашел" name="from">
</div>
<button class="addClientId">Добавить</button>

<h3>Список клиентов</h3>
<?php
	$db = new SQLite3('crm.db');
	$res = $db->query("SELECT * FROM clients ORDER BY created DESC");
	$out = [];
	while($r = $res->fetchArray(SQLITE3_ASSOC)){
		$q = "SELECT val FROM phones WHERE id in ".listToCupStr($r['ref_tel']);
		$r['tel_arr'] = getArrInDB($q);
		$q = "SELECT * FROM object WHERE id in ".listToCupStr($r['ref_obj']);
		$r['obj_arr'] = getArrInDB($q);
		$q = "SELECT * FROM events WHERE id in ".listToCupStr($r['ref_event']);
		$r['event_arr'] = getArrInDB($q);
		$out[] = $r;
	}

	echo "<table>";
		echo "<thead>
				<tr>
					<td>Имя</td>
					<td>Статус</td>
					<td>Телефоны</td>
					<td>Объекты</td>
					<td>События</td>
				</tr>
			</thead>";
		echo "<tbody>";

	for($i=0; $i<count($out); $i++){
		echo "<tr client_id='{$out[$i]['id']}'>";
		$t = "<div class='flex-column'>";
		for($j=0; $j<count($out[$i]['tel_arr']); $j++){
			$t = $t."<a href=tel:{$out[$i]['tel_arr'][$j]['val']}$>{$out[$i]['tel_arr'][$j]['val']}</a>";
		}
		$t = $t."</div>";
		$ob = "<div class='flex-column'>";
		for($j=0; $j<count($out[$i]['obj_arr']); $j++){
			$ob = $ob."<div class='bottom-border'>";
			$ob = $ob."<div>id={$out[$i]['obj_arr'][$j]['id']}<br>Тип: {$out[$i]['obj_arr'][$j]['type']}</div>";
			$ob = $ob."<div><span class='font-bold'>Статус:</span> {$out[$i]['obj_arr'][$j]['status']}</div>";
			$ob = $ob."<div>Описание: {$out[$i]['obj_arr'][$j]['description']}</div>";
			$ob = $ob."<div><span class='font-bold'>Адрес:</span> {$out[$i]['obj_arr'][$j]['address']}</div>";
			$ob = $ob."</div>";
		}
		
		$ev = "<div class='flex-column'>";
		for($j=0; $j<count($out[$i]['event_arr']); $j++){
			$ev = $ev."<div class='bottom-border'>";
			$ev = $ev."<div> id={$out[$i]['event_arr'][$j]['id']}<br>Тип: {$out[$i]['event_arr'][$j]['type']}</div>";
			$ev = $ev."<div><span class='font-bold'>Статус:</span> {$out[$i]['event_arr'][$j]['status']}</div>";
			$ev = $ev."<div>{$out[$i]['event_arr'][$j]['start']} - {$out[$i]['event_arr'][$j]['finish']}</div>";
			$ev = $ev."</div>";
		}
		echo "<td>id={$out[$i]['id']}<br>{$out[$i]['name']}</td>";
		echo "<td>{$out[$i]['status']}</td>";
		echo "<td>$t<button class='addTelID'>Добавить</button></td>";
		echo "<td>$ob<button class='addObjID'>Добавить</button></td>";
		echo "<td>$ev</td>";
		echo "</tr>";
	}
	echo "</tbody>";
	echo "</table>";

	

	function getArrInDB($q){
		global $db;
		$res = $db->query($q);
		$out = [];
		if($res){
			while($t = $res->fetchArray(SQLITE3_ASSOC)){
				$out[] = $t;
			}
		}
		return $out;
	}

	function listToCupStr($js){
		$s = "(";
		$js = json_decode($js);
		for($i=0; $i<count($js); $i++){
			$s = $s.$js[$i];
			if($i == count($js)-1){
				$s = $s.")";
			}else{
				$s = $s.",";
			}
		}
		return $s;
	}
?>