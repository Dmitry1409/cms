<?php

	$db = new SQLite3("crm.db");
	$res = $db->query("SELECT * FROM products");
	$a = [];
	while($o = $res->fetchArray(SQLITE3_ASSOC)){
		$a[] = $o;
	}
	echo json_encode($a);

?>