<?php
	session_start();
	
	require "../scripts_php/collectImage.php";

	$db = new Sqlite3("../cms.db");

	if($_SERVER["REQUEST_METHOD"] == "GET"){
		if($_GET['comand'] == "scan_dir"){
			$imgs = getImages($_GET['path']);
			if(count($imgs) > 0){
				echo count($imgs);
				$_SESSION['imgs'] = $imgs;
			}else{
				echo 0;
			}
			
		}
		if($_GET['comand'] == "add_record"){
			$nameFolder = "lightTransp";
			for($i = 0; $i< count($_SESSION['imgs']); $i++){
				$source = $_SESSION['imgs'][$i];

				$k = strpos($source, '.');	
				
				$nameWebp = substr($source, 0, $k);
				$nameWebp = $nameWebp.".webp";

				$query = "INSERT INTO imageObj (webp, jpg, hashTag_id) VALUES ('img/imgObj/$nameFolder/webp/$nameWebp',";
				$query = $query."'img/imgObj/$nameFolder/jpg/$source', '[]')";

				if(!$db->exec($query)){
					echo $db->lastErrorMsg().". Не удалось записать в таблицу imgObj. Имя файла - $source";
					exit;
				}

			}
			echo 1;
		}
	}
?>