<?php
	$db = new SQLite3('../crm.db');
	$ser = $_GET['name'];
	$upper = null;
	$lower = null;
	if(preg_match('/[a-zA-Z]/', $ser)){
		$upper = ucfirst($ser);
		$lower = strtolower($ser);
	}else{
		$upper = mb_upper($ser);
		$lower = mb_strtolower($ser, $encoding='utf-8');
	}

	$q = "SELECT * FROM complect WHERE name LIKE '%$ser%' OR name LIKE '%$upper%' OR name LIKE '%$lower%'";
	$res = $db->query($q);
	$out = [];
	while($r = $res->fetchArray(SQLITE3_ASSOC)){
		$out[]=$r;
	}
	echo json_encode($out);
	function mb_upper($str, $encoding="UTF-16"){
		$char = mb_strtoupper(substr($str,0,2), "utf-8"); // это первый символ
		$str[0] = $char[0];
		$str[1] = $char[1];
		return $str;
	}
?>