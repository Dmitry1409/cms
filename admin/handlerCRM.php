<?php

	$db = new SQLite3("crm.db");
	$time = time();

	function getAndAddinFild($q, $n_value){
		global $db;
		$res = $db->querySingle($q);
		if(!$res){
			return "[$n_value]";
		}else{
			$js = json_decode($res);
			$js[] = $n_value;
			return json_encode($js);
		}
		
	}

	if($_SERVER['REQUEST_METHOD']=="POST"){

		if($_POST['comand'] == "addObject"){
			$q = "INSERT INTO object (status, type, description, ref_client, created";
			if(array_key_exists("address", $_POST)){
				$q = $q.", address";
			}
			$q = $q.") VALUES ('{$_POST['status']}', '{$_POST['type']}', '{$_POST['description']}', '{$_POST['client_id']}',$time";
			if(array_key_exists("address", $_POST)){
				$q = $q.", '{$_POST['address']}'";
			}
			$q = $q.")";
			if(!$db->exec($q)){
				echo $db->lastErrorMsg();
				exit;
			}
			$idObj =  $db->lastInsertRowID();
			$n = getAndAddinFild("SELECT ref_obj FROM clients WHERE id = {$_POST['client_id']}", $idObj);
			$q = "UPDATE clients SET ref_obj = '$n' WHERE id = {$_POST['client_id']}";
			if(!$db->exec($q)){
				echo $db->lastErrorMsg();
				exit;
			}
			echo "succes";
		}

		if($_POST['comand'] == "addPhone"){
			$q = "INSERT INTO phones (val, ref_client) VALUES('{$_POST['tel']}', '{$_POST['client_id']}')";
			if(!$db->exec($q)){
				echo $db->lastErrorMsg();
				exit;
			}
			$idTel = $db->lastInsertRowID();
			$nv = getAndAddinFild("SELECT ref_tel FROM clients WHERE id = {$_POST['client_id']}", $idTel);
			$q = "UPDATE clients SET ref_tel = '$nv' WHERE id = {$_POST['client_id']}";
			if(!$db->exec($q)){
				echo $db->lastErrorMsg();
				exit;
			}
			echo "succes";
		}
		
		if($_POST['comand'] =="addEvent"){
			$q = "INSERT INTO events (start, finish, type, created, status";
			if($_POST['type'] == "замер"){
				$q = $q.",ref_obj, ref_client";
			}
			$q = $q.") VALUES ('{$_POST['start']}','{$_POST['finish']}','{$_POST['type']}',$time, 'будет'";
			if($_POST['type'] == 'замер'){
				$q = $q.", '{$_POST['obj_id']}', '{$_POST['client_id']}'";
			}
			$q = $q.")";

			if(!$db->exec($q)){
				echo $db->lastErrorMsg();
				exit;
			}
			$evID = $db->lastInsertRowID();
			if($_POST['type'] =="замер"){
				$ref = getAndAddinFild("SELECT ref_event FROM object WHERE id = {$_POST['obj_id']}", $evID);
				$q = "UPDATE object SET ref_event = '$ref' WHERE id = {$_POST['obj_id']}";
				if(!$db->exec($q)){
					echo $db->lastErrorMsg();
					exit;
				}
				
				$ev = getAndAddinFild("SELECT ref_event FROM clients WHERE id = {$_POST['client_id']}", $evID);

				if(!$db->exec("UPDATE clients SET ref_event = '$ev' WHERE id = {$_POST['client_id']}")){
					echo $db->lastErrorMsg();
					exit;
				}

			}
			echo "succes";
			
		}

	}
	
	if(array_key_exists("comand", $_GET)){
		if($_GET['comand'] == "addClient"){
			$q = "INSERT INTO phones (val) VALUES ('".$_GET['tel']."')";
			if(!$db->exec($q)){
				echo $db->lastErrorMsg();
				exit;
			}
			$phID = $db->lastInsertRowID();

			$q = "INSERT INTO object (description, type, created, status";
			if($_GET['address']){
				$q = $q.", address)";
			}else{
				$q = $q.")";
			}
			$q = $q." VALUES ('".$_GET['desc']."','".$_GET['type']."',".time().",'нужно'";
			if($_GET['address']){
				$q = $q.",'".$_GET['address']."')";
			}else{
				$q = $q.")";
			}


			if(!$db->exec($q)){
				echo $db->lastErrorMsg();
				exit;
			}
			$objID = $db->lastInsertRowID();


			$q = "INSERT INTO clients (ref_tel, ref_obj, created, status";
			if($_GET['name']){
				$q = $q.", name";
			}
			if($_GET['from']){
				$q = $q.", from_is)";
			}else{
				$q = $q.")";
			}
			$q = $q." VALUES ('[".$phID."]', '[".$objID."]',".time().", 'need'";
			if($_GET['name']){
				$q = $q.",'".$_GET['name']."'";
			}
			if($_GET['from']){
				$q = $q.", '".$_GET['from']."')";
			}else{
				$q = $q.")";
			}

			if(!$db->exec($q)){
				echo $db->lastErrorMsg();
				exit;
			}
			$clID = $db->lastInsertRowID();
			$q = "UPDATE phones SET ref_client = $clID WHERE id = $phID";

			if(!$db->exec($q)){
				echo $db->lastErrorMsg();
				exit;
			}

			$q = "UPDATE object SET ref_client = $clID WHERE id = $objID";

			if(!$db->exec($q)){
				echo $db->lastErrorMsg();
				exit;
			}

			echo "succes";
		}
	}

	function createInsertQuery($arr, $table){
		$q = "INSERT INTO $table (";
		$i = 0;
		foreach ($arr as $key => $value) {
			if($i<(count($arr)-1)){
				$q = $q.$key.",";
			}else{
				$q = $q.$key.")";
			}
			$i++;
		}
		$q = $q." VALUES (";
		$i = 0;
		foreach ($arr as $key => $value) {
			if($i<(count($arr)-1)){
				$q = $q.$value.",";
			}else{
				$q = $q.$value.")";
			}
			$i++;
		}
		return $q;
	}

?>