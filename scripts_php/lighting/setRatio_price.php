
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
</head>
	<body>

<?php
	$db = new SQLite3('../cms.db');
	$res = $db->query("SELECT * FROM ToledoProducts WHERE category = 'светильники с датчиками'");
	while($r = $res->fetchArray(SQLITE3_ASSOC)){
		$id = $r['id'];
		$q = "UPDATE ToledoProducts SET ratio_prise = '+ 500ы' WHERE id = $id";
		// echo $db->exec($q);
		echo $q, "<br>";
	}

?>
	</body>
</html>