<?php
	$db = new SQLite3("../cms.db");
	session_start();

	$arr = json_decode($_GET['arr']);

	$fotoFl = false;

	for($i =0; $i<count($arr); $i++){
		if($arr[$i][0]=="С фото"){
			$fotoFl = true;
			break;
		}
	}

	$q = "SELECT * FROM feedBackClient ";

	if($fotoFl){
		$q = $q." WHERE foto_file_name_arr NOT NULL";
		$order = "";
		if(count($arr)>1){
			$order = " ORDER BY ";
			for($i=0; $i<count($arr);$i++){
				if($arr[$i][0]=="С фото"){
					continue;
				}
				if($arr[$i][0]=="Дата:"){
					$order = $order."timestamp";
				}else{
					$order = $order."scope";
				}
				if($arr[$i][1]=="down"){
					$order = $order." DESC";
				}
				if($i < count($arr)-1){
					if($arr[$i+1][0] != "С фото"){
						$order = $order.", ";
					}
				}
			}
		}
		$q = $q.$order;
		$res = $db->query($q);
		$valFoto = [];
		while($r= $res->fetchArray(SQLITE3_ASSOC)){
			$valFoto[] = $r;
		}

		$q = "SELECT * FROM feedBackClient WHERE foto_file_name_arr IS NULL".$order;
		$res = $db->query($q);
		while($r= $res->fetchArray(SQLITE3_ASSOC)){
			$valFoto[] = $r;
		}

		echo json_encode($valFoto);


	}else{
		$q = $q."ORDER BY ";
		for($i=0; $i<count($arr); $i++){
			if($arr[$i][0]=="Дата:"){
				$q = $q."timestamp";
			}else{
				$q = $q."scope";
			}
			if($arr[$i][1]=="down"){
				$q = $q." DESC";
			}
			if($i < count($arr)-1){
				$q = $q.", ";
			}
		}
		$res = $db->query($q);
		
		$val = [];
		while($r= $res->fetchArray(SQLITE3_ASSOC)){
			$val[] = $r;
		}

		echo json_encode($val);
	}

?>