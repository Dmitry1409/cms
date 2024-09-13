<?php

	$db = new SQLite3('crm.db');
	// $d = $_GET['day'].".".$_GET['month']."%";
	$q = "SELECT * FROM events";
	// echo var_dump($db);
	$res = $db->query($q);
	$out = [];
	while($r = $res->fetchArray(SQLITE3_ASSOC)){
		$st = explode(".",$r['start']);
		$fn = explode(".", $r['finish']);
		if($_GET['month'] == $st[1]){
			$intDay = (int)$_GET['day'];
			$intEvStart = (int)$st[0];
			$intEvFin = (int)$fn[0];
			if($intDay >= $intEvStart and $intDay <= $intEvFin){
				if($r['type'] == "другое"){
					$out[] = $r;
					continue;
				}
				if($r['type'] == "доставка" OR $r['type'] == "монтаж"){
					$r['zakaz_status'] = $db->querySingle("SELECT status FROM zakaz WHERE id ={$r['ref_zakaz']}");
				}
				$r['obj'] = $db->query("SELECT * FROM object WHERE id = {$r['ref_obj']}")->fetchArray(SQLITE3_ASSOC);
				$r['client'] = $db->query("SELECT * FROM clients WHERE id = {$r['ref_client']}")->fetchArray(SQLITE3_ASSOC);
				$q = "SELECT * FROM phones WHERE id in";
				$q = $q.listToCupStr($r['client']['ref_tel']);
				$tel = $db->query($q);
				$tel_arr = [];
				while($t = $tel->fetchArray(SQLITE3_ASSOC)){
					$tel_arr[] = $t['val'];
				}
				$r['client']['tel_arr'] = $tel_arr;
				$out[] = $r;
			}
		}
	}
	echo json_encode($out);


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