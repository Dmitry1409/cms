<?php

	$db = new SQLite3('../crm.db');


	if($_GET['metod']== "замер" OR $_GET['metod'] == "ис. звонок"){
		echo json_encode(client_obj_list("SELECT * FROM clients WHERE status in ('новый','повторно') ORDER BY created DESC"));
	}
	if($_GET['metod']=="заказать"){
		$q = "SELECT * FROM zakupki WHERE status = 'создан' ORDER BY created DESC";
		echo json_encode(client_obj($q));
	}

	if($_GET['metod']=="доставка" OR $_GET['metod']=="монтаж"){
		$q = "SELECT * FROM zakupki WHERE status = 'ожидает отправки' OR status = 'отправлен crm' OR status = 'отправлен' OR status = 'отправлен авто' OR status='создан' ORDER BY created DESC";
		echo json_encode(client_obj($q));
	}

	function client_obj_list($q){
		global $db;
		$res = $db->query($q);
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
		return $ar;
	}
	
	function client_obj($q){
		global $db;
		$res = $db->query($q);
		$all_zak = [];
		while($r = $res->fetchArray(SQLITE3_ASSOC)){
			$r['ref_obj'] = $db->query("SELECT * FROM object WHERE id = {$r['ref_obj']}")->fetchArray(SQLITE3_ASSOC);
			$cln = $db->query("SELECT * FROM clients WHERE id = {$r['ref_client']}")->fetchArray(SQLITE3_ASSOC);

			$q = "SELECT val FROM phones WHERE id in ";
			$q = $q.listToCupStr($cln['ref_tel']);

			$tel = $db->query($q);
			$tjs = [];
			while($v = $tel->fetchArray(SQLITE3_ASSOC)){
				$tjs[] = $v['val'];
			}
			$cln['ref_tel'] = $tjs;
			$r['ref_client'] = $cln;
			$all_zak[] = $r;
		}
		return $all_zak;
	}

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