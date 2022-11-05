<?php
	session_start();
	$prod = ($_SESSION['buyProducts']);
	$fl = false;
	for($i=0; $i<count($prod); $i++){
		if($prod[$i]->code == $_GET['code']){
			unset($prod[$i]);
			$fl = true;
			break;
		}
	}
	if($fl){
		if(count($prod)>0){
			$_SESSION['buyProducts'] = array_values($prod);
		}else{
			unset($_SESSION['buyProducts']);
		}
	}
?>