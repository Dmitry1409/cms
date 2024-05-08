<?php
	$ndb = null;
	if($_SERVER['REQUEST_METHOD']== "POST"){
		$ndb = $_POST['nameDB'];
	}elseif($_SERVER['REQUEST_METHOD']== "GET"){
		$ndb = $_GET['nameDB'];
	}
	$db = new SQLite3($ndb);

	// имена таблиц и колонок 
	$imageObj_table_name = "imageObj";
	$hashTag_Id_column_name = "hashTag_id";


	$hashTags_table_name = "hashTags";
	$id_img_column_name = "id_img";

	if($_SERVER['REQUEST_METHOD'] == "GET"){
		if($_GET['comand'] == "get_last_row"){
			$max = $db->query("SELECT MAX(rowid) FROM ". $_GET['name_table'])->fetchArray()[0];
			$res = $db->query("SELECT * FROM ".$_GET['name_table']." WHERE rowid == $max")->fetchArray(SQLITE3_ASSOC);
			echo json_encode($res);
		}

		if($_GET['comand']=="dropTable"){
			if($db->exec("DROP TABLE ".$_GET['name_table'])){
				echo 1;
			}else{
				echo $db->lastErrorMsg();
			}
		}
		if($_GET['comand'] == 'tab'){
			$ot = [];
			$res = $db->query("SELECT * FROM sqlite_master WHERE type = 'table'");
			$ar = ['name' => 'dima', 'count' => 15];
			while ($r = $res->fetchArray(SQLITE3_ASSOC)){
				$ot[] = $r;
			}
			echo json_encode($ot);
			$db->close();
		}
		if($_GET['comand'] == 'data_of_table'){
			$query = "SELECT * FROM '".$_GET["name_table"]."'";
			$res = $db->query($query);
			$ot = [];
			while ($r = $res->fetchArray(SQLITE3_ASSOC)){
				$ot[] = $r;
			}
			echo json_encode($ot);
		}
		if($_GET['comand'] == 'table_info'){
			$ot = [];
			$res = $db->query("pragma table_info(".$_GET['table_name'].")");
			while($r = $res->fetchArray(SQLITE3_ASSOC)){
				$ot[] = $r;
			}
			echo json_encode($ot);
		}

	}elseif($_SERVER['REQUEST_METHOD']=="POST"){

		if($_POST['comand'] == "addHashTag"){
			$new_tag = json_decode($_POST['value']);
			$imageObjRow = $db->query("SELECT * FROM $imageObj_table_name WHERE id = $_POST[id]")->fetchArray(SQLITE3_ASSOC);
			$imgObj_Tag_id = json_decode($imageObjRow[$hashTag_Id_column_name]);

			for($i=0; $i<count($new_tag); $i++){
				if(!in_array($new_tag[$i], $imgObj_Tag_id)){
					$imgObj_Tag_id[] = $new_tag[$i];
				}
			}
			$hash = json_encode($imgObj_Tag_id);
			$q = "UPDATE $imageObj_table_name SET $hashTag_Id_column_name = '$hash' WHERE id = $imageObjRow[id]";

			if(!$db->exec($q)){
				echo $db->lastErrorMsg().". Не удалось записать в таблицу $imageObj_table_name value $hash.";
				exit;
			}


			$id_img ;
			$new_id_img = $_POST['id'] + 0;
			for($i =0; $i<count($new_tag); $i++){
				$id_img = $db->query("SELECT $id_img_column_name FROM $hashTags_table_name WHERE id = $new_tag[$i]")->fetchArray(SQLITE3_ASSOC);
				$id_img = json_decode($id_img[$id_img_column_name]);
				if(!in_array($new_id_img, $id_img)){
					$id_img[] = $new_id_img;
					$id_img = json_encode($id_img);
					$q = "UPDATE $hashTags_table_name SET $id_img_column_name = '$id_img' WHERE id = $new_tag[$i]";
					if(!$db->exec($q)){
						echo $db->lastErrorMsg().". Не удалось записать в таблицу $hashTags_table_name value $id_img";
						exit;
					}
				}
			}
			echo 1;

		}

		if($_POST['comand'] == 'delHashTag'){
			// idHashTag, idImg
			$q = "SELECT $hashTag_Id_column_name FROM $imageObj_table_name WHERE id = $_POST[idImg]";
			$img_hashTagId = $db->querySingle($q);
			$img_hashTagId = json_decode($img_hashTagId);

			$new_record = [];
			for($i=0; $i<count($img_hashTagId); $i++){
				if($img_hashTagId[$i] != $_POST['idHashTag']){
					$new_record[] = $img_hashTagId[$i];
				}
			}

			$new_record = json_encode($new_record);
			$q = "UPDATE $imageObj_table_name SET $hashTag_Id_column_name = '$new_record' WHERE id = $_POST[idImg]";
			if(!$db->exec($q)){
				echo $db->lastErrorMsg().". Не удалось записать в imgObj value $new_record в строку $_POST[id_img]";
				exit;
			}


			$q = "SELECT $id_img_column_name FROM $hashTags_table_name WHERE id = $_POST[idHashTag]";
			$textHashTag = $db->querySingle($q);
			$textHashTag = json_decode($textHashTag);

			$new_record = [];
			for($i=0; $i<count($textHashTag); $i++){
				if($textHashTag[$i] != $_POST['idImg']){
					$new_record[] = $textHashTag[$i];
				}
			}
			$new_record = json_encode($new_record);

			$q = "UPDATE $hashTags_table_name SET $id_img_column_name = '$new_record' WHERE id = $_POST[idHashTag]";
			if(!$db->exec($q)){
				echo $db->lastErrorMsg().". Не удалось записать в $hashTags_table_name value $new_record в строку $_POST[idHashTag]";
				exit;
			}

			echo 1;

		}

		if($_POST['comand'] == 'updateCell'){
			// echo var_dump($_POST);
			$newVal = $_POST['newVal'];
			$col = $_POST['col'];
			$nTab = $_POST['name_table'];
			unset($_POST['newVal']);
			unset($_POST['col']);
			unset($_POST['name_table']);
			unset($_POST["comand"]);
			unset($_POST['nameDB']);
			$q = "UPDATE $nTab SET $col = '$newVal' WHERE ";
			$i = 0;
			foreach($_POST as $key => $val){

				if($key == "id"){
					$q = $q."id = $val";
					break;
				}
				if($val ==""){
					$q = $q.$key." is NULL";
					if(count($_POST)-1 > $i) {
						$q = $q." AND ";
					}
					$i++;
					continue;
				}
				$q = $q."$key = '$val'";
				if(count($_POST)-1 > $i){
					$q = $q." AND ";
				}
				$i++;
			}
			if($db->exec($q)){
				echo 1;
			}else{
				echo $db->lastErrorMsg();
			}
			
		}

		if($_POST['comand'] == "delete_row"){
			$name_tb = $_POST['name_table'];
			unset($_POST['nameDB']);
			unset($_POST['comand']);
			unset($_POST['name_table']);
			$q = "DELETE FROM ".$name_tb." WHERE ";
			$i = 0;
			foreach($_POST as $key => $val){

				if($key == "id"){
					$q = $q."id = $val";
					break;
				}
				$q = $q.$key." = "."'".$val."'";
				if(count($_POST)-1> $i){
					$q = $q." AND ";
				}
				$i++;
			}
			
			if($db->exec($q)){
				echo true;
			}else{
				echo $db->lastErrorMsg();
			}
			
		}

		if($_POST['comand'] == "add_record_table"){
			$keys =  array_slice(array_keys($_POST), 0, -3);
			$name_table = $_POST['name_table'];

			$query = "INSERT INTO $name_table (";
			for($i = 0; $i< count($keys); $i++){
				$query = $query.$keys[$i];
				if($i < count($keys) -1){
					$query = $query.",";
				}
			}
			$query = $query.") VALUES (";
			for($i = 0; $i< count($keys); $i++){
				$query = $query."'".$_POST[$keys[$i]]."'";
				if($i < count($keys) -1){
					$query = $query.",";
				}
			}

			$query = $query.")";

			if($db->exec($query)){
				echo true;
			}else{
				echo $db->lastErrorMsg();
			}
		}
		if($_POST['comand']=="add_table"){
			if($_POST['name']=="" or $_POST['sql'] == ""){
				echo "Не указано имя таблицы или название колонок";
			}
			$q = "CREATE TABLE ".$_POST['name']." (";
			$q = $q.$_POST['sql'].")";
			if($db->exec($q)){
				echo 1;
			}else{
				echo $db->lastErrorMsg();
			}
		}
	}
?>