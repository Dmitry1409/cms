<?php
session_start();
$fotoId = $_GET['fotoId'];

if(array_key_exists("favourImg", $_SESSION)){
	$fl = true;
	for($i=0; $i<count($_SESSION['favourImg']); $i++){
		if($_SESSION['favourImg'][$i] == $fotoId){
			unset($_SESSION['favourImg'][$i]);
			$fl = false;
		}
	}
	if(!$fl){
		$_SESSION['favourImg'] = array_values($_SESSION['favourImg']);
	}
	if($fl){
		$_SESSION['favourImg'][] = $fotoId;
	}

}else{
	$_SESSION['favourImg'] = [$fotoId];
}
?>