<?php
	session_start();
	if(!$_SESSION['isAdmin']){
		http_response_code(403);
		exit;
	}


	$db = new SQLite3('crm.db');
	$res = $db->query("SELECT * FROM clients WHERE status = 'новый' ORDER BY created DESC");
	$ar = [];
	while($r = $res->fetchArray(SQLITE3_ASSOC)){
		$q = "SELECT val FROM phones WHERE id in ";
		$q = $q.listToCupStr($r['ref_tel']);

		$tel = $db->query($q);
		$tjs = [];
		while($v = $tel->fetchArray(SQLITE3_ASSOC)){
			$tjs[] = $v['val'];
		}
		$r['ref_tel'] = $tjs;
		$q = "SELECT * FROM object WHERE id in ";
		$q = $q.listToCupStr($r['ref_obj']);
		$obj_res = $db->query($q);
		$obj_l = [];
		while($v = $obj_res->fetchArray(SQLITE3_ASSOC)){
			$obj_l[] = $v;
		}
		$r['ref_obj'] = $obj_l;
		$ar[] = $r;
	}

	echo json_encode($ar);

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