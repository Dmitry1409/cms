<?php
	$db = new Sqlite3('../cms.db');
	$r = $db->query("SELECT * FROM headerBanner");
	$e = [];
	while($o = $r->fetchArray(SQLITE3_ASSOC)){
		$e[] = $o;
	}
	shuffle($e);
	echo json_encode($e);
?>