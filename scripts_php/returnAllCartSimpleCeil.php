<?php
	session_start();
	// $res = array_slice($_SESSION['simple_Ceil'], $_GET['curNum']);
	echo json_encode($_SESSION['simple_Ceil']);
?>