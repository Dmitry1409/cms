<?php
	$db = new SQLite3('../crm.db');
	$year = $_GET['year'];
	$ye_f = (int)$_GET['year']+1;
	$t_start = strtotime("{$year}-01-01");
	$t_finish = strtotime("{$ye_f}-01-01");

	$res = $db->query("SELECT * FROM events WHERE time_start >= $t_start AND time_finish < $t_finish");
	$out = [];
	while($r = $res->fetchArray(SQLITE3_ASSOC)){
		$out[] = $r;

	}
	echo json_encode($out);

	// echo date('d.m.Y H:i:s', $t_start). "  ".date('d.m.Y H:i:s', $t_finish);


?>