<?php

	session_start();
	$res = array_slice($_SESSION['fotoWorkExamp'], $_GET['len'], 10);
	echo json_encode($res);

?>