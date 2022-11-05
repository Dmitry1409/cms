<?php
	session_start();
	$res = array_slice($_SESSION['applyImg'], $_GET['len'], 12);
	echo json_encode($res);
?>