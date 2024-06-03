<?php

	$db = new SQLite3('crm.db');
	$d = $_GET['day'].".".$_GET['month']."%";
	$q = "SELECT * FROM events WHERE start LIKE '$d'";
	// echo var_dump($db);
	$res = $db->query($q);
	$out = [];
	while($r = $res->fetchArray(SQLITE3_ASSOC)){
		if($r['type'] == "замер" || $r['type'] == "монтаж"){
			$q = "SELECT * FROM object WHERE id = {$r['ref_obj']}";
			$r['obj'] = $db->query($q)->fetchArray(SQLITE3_ASSOC);
			$q = "SELECT * FROM clients WHERE id = {$r['obj']['ref_client']}";
			$r['client'] = $db->query($q)->fetchArray(SQLITE3_ASSOC);
			$q = "SELECT * FROM phones WHERE id in";
			$q = $q.listToCupStr($r['client']['ref_tel']);
			$tel = $db->query($q);
			$tel_arr = [];
			while($t = $tel->fetchArray(SQLITE3_ASSOC)){
				$tel_arr[] = $t['val'];
			}
			$r['client']['tel_arr'] = $tel_arr;
		}
		$out[] = $r;
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