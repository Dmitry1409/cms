<?php
	require "../session_handlers.php";
	session_start();
	collect_data();
	$_SESSION['isAdmin'] = null;
	header("Location: ../");
?>