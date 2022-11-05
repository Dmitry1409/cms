<?php
	session_start();
	$res = [];
	$res['len'] = count($_SESSION['FPImgArr']);
	$res['imgs'] = array_slice($_SESSION['FPImgArr'], $_GET['curNum'], 12);
	echo json_encode($res);
?>