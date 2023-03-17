<?php
	session_start();
	$db = new SQLite3("../../cms.db");

	if(array_key_exists('comand', $_GET)){	
		if($_GET['comand'] == "getAllProd"){
			echo json_encode($_SESSION['toledoAllprod']);
			exit;
		}
	}

	$cat = json_decode($_GET['category']);
	if($cat[0] == "все"){
		$q = "SELECT * FROM ToledoProducts";
	}else{
		$q = "SELECT * FROM ToledoProducts WHERE category in (";

		for($i=0; $i<count($cat); $i++){
			$q = $q."'".$cat[$i]."'";
			if($i == count($cat)-1){
				$q = $q.")";
			}else{
				$q = $q.',';
			}
		}
	}
	$fl = true;
	if(array_key_exists('sortBy', $_GET)){	
		if($_GET['sortBy']=="ASC"){
			$q = $q." ORDER BY prise";
			$fl = false;
		}
		if($_GET['sortBy']=="DESC"){
			$q = $q." ORDER BY prise DESC";
			$fl = false;
		}
	}

	$res = $db->query($q);
	$ar = [];
	while($r = $res->fetchArray(SQLITE3_ASSOC)){
		$ar[] = $r;
	}

	if($fl){
		shuffle($ar);
	}

	echo json_encode($ar);
?>