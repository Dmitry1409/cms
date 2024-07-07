<?php

	$db = new SQLite3("crm.db");
	$time = time();

	function getAndAddinFild($table, $col, $rowid, $val){
		global $db;

		$res = $db->querySingle("SELECT $col FROM $table WHERE id = $rowid");

		$out = "";

		if(!$res){
			$out = "[$val]";
		}else{
			$js = json_decode($res);
			$js[] = $val;
			$out = json_encode($js);
		}
		return update_fild($table, $col, $rowid, $out);
	}

	function update_fild($table, $col, $rowid, $val){
		global $db;
		if(!$db->exec("UPDATE $table SET $col = '$val' WHERE id = $rowid")){
			return $db->lastErrorMsg();
		}else{
			return "succes";
		}

	}
	function insert_object($status, $description, $created, $type, $ref_client, $address){
		global $db;

		$q = "INSERT INTO object (status, description, created";
		if($type){
			$q .= ", type";
		}
		if($ref_client){
			$q .= ", ref_client";
		}
		if($address){
			$q .= ", address";
		}
		$q .= ") VALUES ('$status', '$description', $created";
		if($type){
			$q .=", '$type'";
		}
		if($ref_client){
			$q .= ", $ref_client";
		}
		if($address){
			$q .= ", '$address'";
		}
		$q .= ")";

		if(!$db->exec($q)){
			echo $db->lastErrorMsg();
			exit;
		}else{
			return $db->lastInsertRowID();
		}

	}

	function get_or_null($key, $arr){
		if(array_key_exists($key, $arr)){
			return $arr[$key];
		}else{
			return NULL;
		}
	}

	function insert_phone($tel, $ref_client){
		global $db;
		$q = "INSERT INTO phones (val";
		if($ref_client){
			$q .=", ref_client";
		}
		$q .= ") VALUES ('$tel'";
		if($ref_client){
			$q .= ", $ref_client";
		}		
		$q .= ")";

		if(!$db->exec($q)){
			echo $db->lastErrorMsg();
			exit;
		}else{
			return $db->lastInsertRowID();
		}
	}

	function insert_event($start, $finish, $type, $status, $ref_client, $ref_obj){
		global $db;

		$q = "INSERT INTO events (start, finish, type, status, created";
		if($ref_client){
			$q .= ", ref_client";
		}
		if($ref_obj){
			$q .= ", ref_obj";
		}
		$q .= ") VALUES ('$start', '$finish', '$type', '$status', ".time();
		if($ref_client){
			$q .= ", $ref_client";
		}
		if($ref_obj){
			$q .= ", $ref_obj";
		}
		$q .= ")";

		if(!$db->exec($q)){
			echo $db->lastErrorMsg();
			exit;
		}else{
			return $db->lastInsertRowID();
		}
	}

	function insert_client($status, $name, $ref_tel, $ref_obj, $ref_event, $from_is){
		global $db;

		$q = "INSERT INTO clients (status, created";
		if($name){
			$q .= ", name";
		}
		if($ref_tel){
			$q .= ", ref_tel";
		}
		if($ref_obj){
			$q .= ", ref_obj";
		}
		if($ref_event){
			$q .= ", ref_event";
		}
		if($from_is){
			$q .= ", from_is";
		}

		$q .= ") VALUES ('$status', ".time();

		if($name){
			$q .= ", '$name'";
		}

		if($ref_tel){
			$q .= ", '[$ref_tel]'";
		}
		if($ref_obj){
			$q .= ", '[$ref_obj]'";
		}
		if($ref_event){
			$q .= ", '[$ref_event]'";
		}
		if($from_is){
			$q .= ", '$from_is'";
		}

		$q .=")";

		if(!$db->exec($q)){
			echo $db->lastErrorMsg();
			exit;
		}else{
			return $db->lastInsertRowID();
		}


	}

	if($_SERVER['REQUEST_METHOD']=="POST"){

		//из страницы все клиенты
		if($_POST['comand'] == "addClient"){

			$phID = insert_phone($_POST['tel']);

			$objID = insert_object("нужно", $_POST['desc'], $time, get_or_null('typeObj', $_POST),
									 NULL, get_or_null('address', $_POST));

			$clID = insert_client("новый", get_or_null('name', $_POST), "$phID", "$objID", NULL, get_or_null('from', $_POST));

			
			update_fild("phones", "ref_client", $phID, $clID);

			echo update_fild("object", "ref_client", $objID, $clID);


		}

		//из календаря менять поля
		if($_POST['comand'] == "change_fild"){
			echo update_fild($_POST['table'], $_POST['tabcol'], $_POST['rowid'], $_POST['newval']);
		}

		//из страницы клиенты добавление объекта
		if($_POST['comand'] == "addObject"){

			$idObj =  insert_object($_POST['status'], $_POST['description'], $time, get_or_null("type", $_POST),
									get_or_null('client_id', $_POST), get_or_null("address", $_POST));

			echo getAndAddinFild('clients', 'ref_obj', $_POST['client_id'], $idObj);
		}
		//из страници все клиенты
		if($_POST['comand'] == "addPhone"){
			$idTel = insert_phone($_POST['tel'], $_POST['client_id']);
			echo getAndAddinFild("clients", "ref_tel", $_POST['client_id'], $idTel);

		}
		//из календаря
		if($_POST['comand'] =="addEvent"){
			if($_POST['type'] == "замер"){

				$evID = insert_event($_POST['start'], $_POST['finish'], $_POST['type'], 'будет',
									 $_POST['client_id'], $_POST['obj_id']);

				getAndAddinFild('object', 'ref_event', $_POST['obj_id'], $evID);
				
				echo getAndAddinFild('clients', 'ref_event', $_POST['client_id'], $evID);
			}
			
			
			if($_POST["type"] == "вх. звонок"){

				$phID = insert_phone($_POST['telehon']);

				$objID = insert_object('нужно', $_POST['desc'], $time, get_or_null('typeObj', $_POST),
						 NULL, get_or_null('address', $_POST));


				$clID = insert_client('новый', get_or_null('name', $_POST),
						 "$phID", "$objID", NULL, get_or_null('from_is', $_POST));

				$evID = insert_event($_POST['start'], $_POST['finish'], $_POST['type'], "было", $clID, $objID);

				update_fild("phones", "ref_client", $phID, $clID);

				update_fild("object", "ref_client", $objID, $clID);


				echo update_fild("clients", "ref_event", $clID, "[$evID]");

			}
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