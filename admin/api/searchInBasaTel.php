<?php
	$db = new SQLite3("../crm.db");
	$data = substr($_GET['tel'], 2);
	$data = "%".$data;
	$s = "SELECT * FROM phones WHERE val LIKE '$data'";
	$res = $db->query($s);
	$r = $res->fetchArray(SQLITE3_ASSOC);
	if($r){
		$cl = $db->query("SELECT * FROM clients WHERE id = {$r['ref_client']}")->fetchArray(SQLITE3_ASSOC);
		$tel = [];
		$ref_js_tel = json_decode($cl['ref_tel']);
		for($i=0; $i<count($ref_js_tel); $i++){
			if($ref_js_tel[$i] == $r['id']){
				$tel[] = ["id"=>$r['id'],
							"val"=>$r['val']];
			}else{
				$tel[]= $db->query("SELECT * FROM phones WHERE id = {$ref_js_tel[$i]}")->fetchArray(SQLITE3_ASSOC);
			}
		} 
		$cl['tel_val'] = $tel;
		$obj = [];
		$ref_obj = json_decode($cl['ref_obj']);
		for($i =0; $i<count($ref_obj); $i++){
			$obj[] = $db->query("SELECT * FROM object WHERE id = {$ref_obj[$i]}")->fetchArray(SQLITE3_ASSOC);
		}
		$ev = [];
		$js_ev = json_decode($cl['ref_event']);
		for($i=0; $i<count($js_ev); $i++){
			$getEvent = $db->query("SELECT * FROM events WHERE id = {$js_ev[$i]}")->fetchArray(SQLITE3_ASSOC);
			if(!$getEvent){
				continue;
			}
			$ev[] = $getEvent;
		}
		$cl['events'] = $ev;
		$cl['obj_val'] = $obj;
		echo json_encode($cl);
	}else{
		echo "{}";
	}
?>