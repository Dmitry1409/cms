<?php
	$db = new SQLite3('../cms.db');

	$ar_hashTag = json_decode($_GET['hashTags']);
	if($ar_hashTag[0] == "все"){
		$q = "SELECT * FROM imageObj";
	}else{
		$q = "SELECT id_img FROM hashTags WHERE name in(";
		for($i=0; $i<count($ar_hashTag); $i++){
			$q = $q."'".$ar_hashTag[$i]."'";
			if($i == count($ar_hashTag)-1){
				$q = $q.')';
			}else{
				$q = $q.',';
			}
		}
		$res = $db->query($q);
		$val = [];
		while($r = $res->fetchArray(SQLITE3_ASSOC)){
			$val[] = $r;
		}
		$mergeArr = [];
		for($i=0; $i<count($val); $i++){
			$r = json_decode($val[$i]['id_img']);
			$mergeArr = array_merge($r, $mergeArr);
		}

		$q = "SELECT * FROM imageObj WHERE id in (";
		
		for($i=0; $i<count($mergeArr); $i++){
			$q = $q.$mergeArr[$i];
			if($i == count($mergeArr)-1){
				$q = $q.')';
			}else{
				$q = $q.",";
			}
		}

	}

	$res = $db->query("SELECT id, name FROM hashTags");

	$hash = [];
	while($r = $res->fetchArray(SQLITE3_ASSOC)){
		$hash[$r['id']] = $r['name'];
	}
	
	


	$res = $db->query($q);
	$val = [];

	while($r = $res->fetchArray(SQLITE3_ASSOC)){
		$h = [];
		$t = json_decode($r['hashTag_id']);
		for($j=0; $j<count($t); $j++){
			$h[] = '#'.$hash[$t[$j]];
		}
		$d = [];
		$d['hashName'] = $h;
		$d['prise'] = $r['prise'];
		$d['webp'] = $r['webp'];
		$d['jpg'] = $r['jpg'];
		$d['id'] = $r['id'];
		$val[] = $d;
	}
	shuffle($val);
	echo json_encode($val);

?>