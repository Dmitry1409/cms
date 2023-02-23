<?php
	session_start();
	//echo "noClick";
	// unset($_SESSION['maskTelClick']);
	if(!array_key_exists('maskTelClick', $_SESSION)){
		echo "noClick";
	}
	if(array_key_exists('click', $_GET)){
		$_SESSION['maskTelClick'] = "yes";
	}

?>