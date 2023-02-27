<?php
	session_start();
	$db = new SQLite3('cms.db');
	require "config_cms.php" ;
	require "templates/startMainHead.php";
	require "templates/headMainPage.php";
	require "templates/base_header.php";
	include "templates/howMuchDone.php";
?>
