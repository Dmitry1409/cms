<?php
	function getArrRowById($table, $str){
		$js = json_decode($str);
		$q = "SELECT * FROM $table WHERE id in (";
		for($i=0; $i<count($js); $i++){
			$q .= $js[$i].",";
		}
		$q = substr($q, 0, strlen($q)-1);
		$q .= ")";
		return exec_in_arr($q);
	}
	function exec_in_arr($q){
		global $db;
		$out = [];
		$res = $db->query($q);
		while($r = $res->fetchArray(SQLITE3_ASSOC)){
			$out[] = $r;
		}
		return $out;
	}


	$db = new SQLite3('../crm.db');
	
	$query_arr =  json_decode($_POST['arr']);
	$q = "SELECT * FROM clients";
	if($query_arr[0] != "все"){
		$q .= " WHERE status in ";
		$s = '(';
		for($i = 0; $i < count($query_arr); $i++){
			$s .= "'{$query_arr[$i]}',";
		}
		$s = substr($s, 0, strlen($s)-1);
		$q .= $s.")";
	}
	$q .= " ORDER BY created {$_POST['by_data']}";


	$res = $db->query($q);
	$out = [];
	while($r = $res->fetchArray(SQLITE3_ASSOC)){
		$r['tel_arr'] = getArrRowById("phones", $r['ref_tel']);
		$r['obj_arr'] = getArrRowById('object', $r['ref_obj']);
		if($r['ref_event']){
			$r['event_arr'] = getArrRowById('events', $r['ref_event']);
		}else{
			$r['event_arr'] = [];
		}
		$out[] = $r;
	}

	echo json_encode($out);


	

?>