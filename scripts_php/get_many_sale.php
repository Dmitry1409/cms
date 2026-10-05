<?php

	$db = new SQLite3("../cms.db");

	$r = $db->query("SELECT * FROM many_sale");


	$arr = [];
	while($o = $r->fetchArray(SQLITE3_ASSOC)){
		$arr[] = $o;
	}
	shuffle($arr);
	echo json_encode($arr);

?>