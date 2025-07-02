<?php
	$db = new SQLite3('crm.db');

	$serchData = $_GET['year']."-".$_GET['month']."-".$_GET['day'];
	$time_start = strtotime($serchData);

	$time_finish = $time_start + 86400;

	// $d = $_GET['day'].".".$_GET['month']."%";
	$q = "SELECT * FROM events WHERE time_start >= $time_start AND time_start < $time_finish";

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
					$r['zakupki_status'] = $db->querySingle("SELECT status FROM zakupki WHERE id ={$r['ref_zakupki']}");
					$r['zakupki_data_send'] = $db->querySingle("SELECT data_send FROM zakupki WHERE id ={$r['ref_zakupki']}");
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