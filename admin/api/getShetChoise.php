<?php

	$db = new SQLite3('../crm.db');

	if(array_key_exists("shet_id", $_GET)){
		$json = $db->query("SELECT json, data, sale FROM sheta WHERE id = {$_GET['shet_id']}")->fetchArray(SQLITE3_ASSOC);
		echo json_encode($json);
		exit;
	}

	$out = [];
	$res = $db->query("SELECT * FROM sheta ORDER BY created DESC");
	while($r = $res->fetchArray(SQLITE3_ASSOC)){
		$elem = new stdClass();
		$cl = $db->query("SELECT * FROM clients WHERE id = {$r['ref_client']}")->fetchArray(SQLITE3_ASSOC);
		$cl['tel_val'] = getElem("SELECT val FROM phones WHERE id in ", $cl['ref_tel']);
		$cl['obj_val'] = getElem("SELECT * FROM object WHERE id in ", "[{$r['ref_obj']}]");
		$elem->client = $cl;
		$object = $db->query("SELECT * FROM object WHERE id = {$r['ref_obj']}")->fetchArray(SQLITE3_ASSOC);
		$elem->object = $object;
		$elem->shet = $r; 
		$out[] = $elem;
	}
	echo json_encode($out);

	function getElem($q, $ref){
		global $db;
		$q = $q.listToCupStr($ref);
		$el = $db->query($q);
		$e = [];
		while($v = $el->fetchArray(SQLITE3_ASSOC)){
			$e[] = $v;
		}
		return $e;
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