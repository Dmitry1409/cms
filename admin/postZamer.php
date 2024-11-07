<?php
	
	$db = new SQLite3('crm.db');

	include "api/api_secure.php";

	$dict = json_decode($_POST['dict']);
	$rooms = $dict->rooms;


	include "admin_templates/calculate_zamer.php";


	$idEvent = $_POST['idEvent'];
	$idZamer = $_POST['idZamer'];
	$zamerJS = null;
	if($idZamer){
		$zamerJS = json_decode($db->querySingle("SELECT json FROM zamer WHERE id = $idZamer"));
	}

	$imgArr = [];

	for($i=0; $i<count($rooms); $i++){
		if(array_key_exists('фото', $rooms[$i])){
			$n_name = md5(microtime() . rand(0, 9999)).".jpg";
			$o = fopen("img_admin/img_zamer/".$n_name, 'wb');
			fwrite($o, base64_decode($rooms[$i]->{'фото'}));
			fclose($o);
			$rooms[$i]->{'фото'} = $n_name;
			$imgArr[] = $n_name;
		}else{
			// если у нас редактиррвание, ищем и добавляем старые фото
			if($idZamer){
				foreach ($zamerJS->{"rooms"} as $zamerRoom) {
					if($zamerRoom->{"помещение"} == $rooms[$i]->{'помещение'}){
						if(array_key_exists("фото", $zamerRoom)){
							$rooms[$i]->{"фото"} = $zamerRoom->{"фото"};
							$imgArr[] = $zamerRoom->{"фото"};
						}
					}
				}
			}
		}
	}

	// если редактирование просто обновляем json
	if($idZamer){
		$js = json_encode($dict, JSON_UNESCAPED_UNICODE);
		$q = "UPDATE zamer SET json = '$js' WHERE id = $idZamer";
		if(!$db->exec($q)){
			echo $db->lastErrorMsg();
		}

		$foto = json_encode($imgArr);

		if(!$db->exec("UPDATE zamer SET foto = '$foto' WHERE id = $idZamer")){
			echo $$db->lastErrorMsg();
		}

		echo "succes";

	}else{
		$id_client = $db->querySingle("SELECT ref_client FROM events WHERE id = $idEvent");
		$id_obj = $db->querySingle("SELECT ref_obj FROM events WHERE id = $idEvent");

		$q = "INSERT INTO zamer (ref_client, ref_obj, ref_event, created, json ";
		if(count($imgArr) > 0){
			$q = $q.", foto)";
		}else{
			$q = $q.")";
		}
		$time = time();
		$js = json_encode($dict, JSON_UNESCAPED_UNICODE);
		$q = $q." VALUES ($id_client, $id_obj, $idEvent, $time, '$js'";
		if(count($imgArr) > 0){
			$q = $q.", '".json_encode($imgArr)."')";
		}else{
			$q = $q.")";
		}


		if(!$db->exec($q)){
			echo $db->lastErrorMsg();
			exit;
		}

		$id_zamer = $db->lastInsertRowID();

		update_filds("events", ["ref_zamer"=>$id_zamer], $idEvent);

		update_filds("events", ["status"=>"выполнено"], $idEvent);

		update_filds("object", ["status"=>"замер выполнен"], $id_obj);

		update_filds("clients", ["status"=>"замер выполнен"], $id_client);

		getAndAddinFild('object', "ref_zamer", $id_obj, $id_zamer);

		echo "succes";
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
		global $db;

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

		if(!$db->exec($q)){
			echo $db->lastErrorMsg();
			exit;
		}
	}

?>