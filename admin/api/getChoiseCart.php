<?php
	$db = new SQLite3('../crm.db');

	$obj = new stdClass();
	$obj->value = [];
	$obj->metod = $_GET['metod'];


	if($_GET['metod']=="замер" OR $_GET['metod']=="ис. звонок"){
		getClient("SELECT * FROM clients WHERE status in ('новый','повторно','замер назначен','замер выполнен') ORDER BY created DESC");
	}
	if($_GET['metod']=="заказать"){
		getZakup("SELECT * FROM zakupki WHERE status = 'создан' ORDER BY created DESC");
	}

	if($_GET['metod']=="доставка" OR $_GET['metod']=="монтаж"){
		getZakup("SELECT * FROM zakupki WHERE status in ('ожидает отправки','отправлен crm','отправлен','отправлен авто','создан') ORDER BY created DESC");	
	}


	function getClient($q){
		global $db, $obj;

		$res = $db->query($q);

		while($r = $res->fetchArray(SQLITE3_ASSOC)){
			$r['tel_val'] = getElem("SELECT val FROM phones WHERE id in ", $r['ref_tel']);
			$r['obj_val'] = getElem("SELECT * FROM object WHERE id in ", $r['ref_obj']);

			$obj->value[] = $r;
		}
		echo json_encode($obj);
		exit;
		
	}

	function getZakup($q){
		global $db, $obj;

		$res = $db->query($q);
		while($r = $res->fetchArray(SQLITE3_ASSOC)){
			$cl = $db->query("SELECT * FROM clients WHERE id = {$r['ref_client']}")->fetchArray(SQLITE3_ASSOC);
			$cl['tel_val'] = getElem("SELECT val FROM phones WHERE id in ", $cl['ref_tel']);
			$cl['obj_val'] = getElem("SELECT * FROM object WHERE id in ", "[{$r['ref_obj']}]");
			$r['client'] = $cl;
			$obj->value[] = $r;
		}
		echo json_encode($obj);
		exit;
	}


	function getElem($q, $ref){
		global $db;
		$q = $q.listToCupStr($ref);
		$el = $db->query($q);
		$e = [];
		while($v = $el->fetchArray(SQLITE3_ASSOC)){
			$e[] = $v;
		}
		return $e;
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