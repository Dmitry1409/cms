<?php
	session_start();
	// echo "nosend";
	if(array_key_exists('YDTarget', $_SESSION)){
		echo "send";
	}else{
		echo "nosend";
		$_SESSION['YDTarget'] = 'send';
	}
?>