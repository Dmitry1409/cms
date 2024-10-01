<?php
	
	$db = new SQLite3("crm.db");

	include "api/api_secure.php";


	$time = time();

	function exec_query($q, $fl_succes){
		global $db;

		if(!$db->exec($q)){
			echo $db->lastErrorMsg();
			exit;
		}else{
			if($fl_succes){
				return "succes";
			}else{
				return $db->lastInsertRowID();
			}
		}
	}

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
		return update_filds($table, [$col=>$out], $rowid);
	}
	
	function update_filds($table, $arr, $rowid){
		$q = "UPDATE $table SET ";
		foreach ($arr as $key => $value) {
			if(is_numeric($value)){
				$q .= "$key=$value,";
			}else{
				$q .= "$key='$value',";
			}
		}
		$q = substr($q, 0, strlen($q)-1);
		$q .= " WHERE id = $rowid";
		return exec_query($q, true);
	}

	function insert_row($table, $arr){
		$q = "INSERT INTO $table (";
		foreach ($arr as $key => $value) {
			$q .= $key.",";
		}
		
		$q .= " created) VALUES (";
		foreach ($arr as $key => $value) {
			if(is_numeric($value)){
				$q .= $value.",";
			}else{
				$q .="'$value',";
			}
		}
		$q .= time().")";

		return exec_query($q, false);
	}

	if($_SERVER['REQUEST_METHOD']=="POST"){

		if($_POST['comand'] == "deleteTel"){
			$ref_cl = $db->querySingle("SELECT ref_client FROM phones WHERE id = {$_POST['tel_id']}");
			$tel_arr = json_decode($db->querySingle("SELECT ref_tel FROM clients WHERE id = $ref_cl"));
			$out = [];
			for($i=0; $i<count($tel_arr); $i++){
				if($tel_arr[$i] != $_POST['tel_id']){
					$out[] = $tel_arr[$i];
				}
			}
			$out = json_encode($out);
			$q = "UPDATE clients SET ref_tel = '$out' WHERE id = $ref_cl";
			exec_query($q);
			$q = "DELETE FROM phones WHERE id = {$_POST['tel_id']}";
			echo exec_query($q, true);
		}

		//из страницы все клиенты
		if($_POST['comand'] == "addClient"){

			$phID = insert_row("phones", ["val"=>$_POST['tel']]);

			$arr = [
					"status"=>'нужно',
					'description'=>$_POST['desc']
				];
			if(array_key_exists("typeObj", $_POST)){
				$arr['type'] = $_POST['typeObj'];
			}
			if(array_key_exists("address", $_POST)){
				$arr['address'] = $_POST['address'];
			}
			$objID = insert_row("object", $arr);

			$arr = [
					"status"=>'новый',
					"ref_tel"=>"[$phID]",
					"ref_obj"=>"[$objID]"
				];
			if(array_key_exists("name", $_POST)){
				$arr['name'] = $_POST['name'];
			}
			if(array_key_exists("from", $_POST)){
				$arr['from_is'] = $_POST['from'];
			}

			$clID = insert_row("clients", $arr);
			
			update_filds("phones", ["ref_client"=> $clID],$phID);

			echo update_filds("object", ["ref_client"=>$clID], $objID);
		}

		//из календаря менять поля
		if($_POST['comand'] == "change_fild"){
			if($_POST['table'] == "events"){
				if($_POST['tabcol'] == "status"){
					$events = $db->query("SELECT * FROM {$_POST['table']} WHERE id = {$_POST['rowid']}")->fetchArray(SQLITE3_ASSOC);
					if($events['type'] == "монтаж"){
						if($_POST['newval'] == 'выполнен'){
							update_filds('zakaz', ['status'=>"выполнен"], $events['ref_zakaz']);
							update_filds("clients", ["status"=>"монтаж выполнен"], $events['ref_client']);
							update_filds("object", ["status"=>"монтаж выполнен"], $events['ref_obj']);
						}						
					}elseif($events['type'] == "заказать"){
						update_filds('zakaz', ['status'=>$_POST['newval']], $events['ref_zakaz']);
					}
				}
				echo update_filds($_POST['table'], [$_POST['tabcol']=> $_POST['newval']],$_POST['rowid']);
			}else{
				echo update_filds($_POST['table'], [$_POST['tabcol']=> $_POST['newval']],$_POST['rowid']);
			}
		}

		//из страницы клиенты добавление объекта
		if($_POST['comand'] == "addObject"){
			$arr = [
					"status"=>$_POST['status'],
					"description"=>$_POST['description'],
					"ref_client"=>$_POST['client_id'],
				];
			if(array_key_exists("address", $_POST)){
				$arr['address'] = $_POST['address'];
			}
			if(array_key_exists("typeObj", $_POST)){
				$arr['type'] = $_POST['typeObj'];
			}

			$idObj = insert_row("object", $arr);

			echo getAndAddinFild('clients', 'ref_obj', $_POST['client_id'], $idObj);
		}
		//из страници все клиенты
		if($_POST['comand'] == "addPhone"){
			$idTel = insert_row("phones", ["val"=>$_POST['tel'],"ref_client"=>$_POST['client_id']]);
			echo getAndAddinFild("clients", "ref_tel", $_POST['client_id'], $idTel);

		}
		//из календаря
		if($_POST['comand'] =="addEvent"){
			if($_POST['type']=="монтаж"){
				$sel = $db->query("SELECT * FROM zakaz WHERE id = {$_POST['zakaz_id']}")->fetchArray(SQLITE3_ASSOC);
				$arr = ["start"=>$_POST['start'],
						"finish"=>$_POST['start'],
						"type"=>$_POST['type'],
						"status"=>"назначен",
						"ref_zakaz"=>$_POST['zakaz_id'], 
						"ref_client"=>$_POST['client_id'],
						"ref_obj"=>$_POST['obj_id'],
						"ref_zamer"=>$sel['ref_zamer']];
				$idEv = insert_row("events", $arr);
				update_filds("clients", ["status"=>"монтаж назначен"], $_POST['client_id']);
				update_filds("object", ["status"=>"монтаж назначен"], $_POST['obj_id']);
				getAndAddinFild("clients", "ref_event", $_POST['client_id'], $idEv);
				echo getAndAddinFild("object", "ref_event", $_POST['obj_id'], $idEv);
			}
			if($_POST['type'] == "замер"){

				$arr = [
						"start"=>$_POST['start'],
						"finish"=>$_POST['finish'],
						"type"=>$_POST['type'],
						"status"=>"будет",
						"ref_client"=>$_POST['client_id'],
						"ref_obj"=>$_POST['obj_id']
					];

				$evID = insert_row("events", $arr);

				getAndAddinFild('object', 'ref_event', $_POST['obj_id'], $evID);

				update_filds("clients", ["status"=>"замер назначен"], $_POST['client_id']);

				update_filds("object", ["status"=>"замер назначен"], $_POST['obj_id']);
				
				echo getAndAddinFild('clients', 'ref_event', $_POST['client_id'], $evID);
			}
					
			if($_POST["type"] == "вх. звонок"){

				$phID = insert_row("phones", ["val"=>$_POST['telehon']]);

				$arr = [
						"status"=>'нужно',
						"description"=>$_POST['desc']
					];
				if(array_key_exists("typeObj", $_POST)){
					$arr['type'] = $_POST['typeObj'];
				}
				if(array_key_exists("address", $_POST)){
					$arr['address'] = $_POST['address'];
				}
				$objID = insert_row("object", $arr);


				$arr = [
						"status"=>"новый",
						"ref_tel"=>"[$phID]",
						"ref_obj"=>"[$objID]",

					];
				if(array_key_exists('name', $_POST)){
					$arr['name'] = $_POST['name'];
				}
				if(array_key_exists("from_is", $_POST)){
					$arr['from_is'] = $_POST['from_is'];
				}
				$clID = insert_row("clients", $arr);


				$arr = ["start"=>$_POST['start'],
						"finish"=>$_POST['finish'],
						"type"=>$_POST['type'],
						"status"=>"было",
						"ref_client"=> $clID,
						"ref_obj"=>$objID
						];
				$evID = insert_row("events", $arr);

				update_filds("phones", ["ref_client"=>$clID],$phID);

				update_filds("object", ["ref_client"=>$clID], $objID);

				echo update_filds("clients", ["ref_event"=>"[$evID]"], $clID);
			}
			if($_POST["type"] == "ис. звонок"){
				$arr = ["start"=>$_POST['start'],
						"finish"=>$_POST['start'],
						"type"=>$_POST['type'],
						"status"=>"будет", 
						"ref_client"=>$_POST['client_id'],
						"ref_obj"=>$_POST['obj_id']];
				$idEv = insert_row("events", $arr);
				echo getAndAddinFild("clients", "ref_event", $_POST['client_id'], $idEv);
			}

			if($_POST["type"] == "заказать"){
				$sel = $db->query("SELECT * FROM zakaz WHERE id = {$_POST['zakaz_id']}")->fetchArray(SQLITE3_ASSOC);
				$arr = ["start"=>$_POST['start'],
						"finish"=>$_POST['start'],
						"type"=>$_POST['type'],
						"status"=>"ожидает отправки",
						"ref_zakaz"=>$_POST['zakaz_id'], 
						"ref_client"=>$sel['ref_client'],
						"ref_obj"=>$sel['ref_obj'],
						"ref_zamer"=>$sel['ref_zamer']];
				$idEv = insert_row("events", $arr);

				$arr = ["status"=>'ожидает отправки',
						"data_send"=>$_POST['start'],
						"ref_event"=>"[$idEv]"];
				echo update_filds("zakaz", $arr, $_POST['zakaz_id']);
			}
			if($_POST['type'] == "доставка"){
				$sel = $db->query("SELECT * FROM zakaz WHERE id = {$_POST['zakaz_id']}")->fetchArray(SQLITE3_ASSOC);
				$arr = ["start"=>$_POST['start'],
						"finish"=>$_POST['start'],
						"type"=>$_POST['type'],
						"status"=>"будет",
						"ref_zakaz"=>$_POST['zakaz_id'], 
						"ref_client"=>$sel['ref_client'],
						"ref_obj"=>$sel['ref_obj'],
						"ref_zamer"=>$sel['ref_zamer']];
				$idEv = insert_row("events", $arr);
				echo getAndAddinFild('zakaz', 'ref_event', $_POST['zakaz_id'], $idEv);
			}
			if($_POST['type'] == "другое"){
				$arr = [
						"start"=>$_POST['start'],
						"finish"=>$_POST['finish'],
						"type"=>$_POST['type'],
						"status"=>"не выполнено",
						"comment"=>$_POST['disc']
					];
				if(array_key_exists("header", $_POST)){
					$arr["header"] = $_POST['header']; 
				}

				insert_row("events", $arr);
				echo "succes";
			}
		}
	}

	if($_SERVER["REQUEST_METHOD"] == "GET"){
		if($_GET['comand'] == "addZakaz"){
			$res = $db->query("SELECT * FROM zamer WHERE id = {$_GET['idZamer']}")->fetchArray(SQLITE3_ASSOC);
			$arr = ["status"=>"создан",
					"ref_zamer"=>$_GET['idZamer'],
					"ref_obj"=>$res['ref_obj'],
					"ref_client"=>$res['ref_client']];

			$idZak = insert_row("zakaz", $arr);
			$arr = ["ref_zakaz"=>$idZak];
			echo update_filds("zamer", $arr, $_GET['idZamer']);
		}
	}

?>