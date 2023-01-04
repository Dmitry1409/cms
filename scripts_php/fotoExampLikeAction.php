<?php
session_start();
$fotoId = $_GET['fotoId'];


if(array_key_exists("favourImg", $_SESSION)){
	$fl = false;
	$delFl = false;
	for($i=0; $i<count($_SESSION['favourImg']); $i++){
		if($_SESSION['favourImg'][$i] == $fotoId){
			if($_GET['comand'] == "delFoto"){
				unset($_SESSION['favourImg'][$i]);
				$delFl = true;
			}
			$fl = true;
		}
	}
	if($_GET['comand']== "addFoto"){
		if(!$fl){
			$_SESSION['favourImg'][] = $fotoId;
		}
	}

	if($delFl){
		$_SESSION['favourImg'] = array_values($_SESSION['favourImg']);
		if(count($_SESSION['favourImg']) == 0){
			unset($_SESSION['favourImg']);
		}
	}

}else{
	$_SESSION['favourImg'] = [$fotoId];
}

?>