<?php
	session_start();
	$db = new SQLite3('../cms.db');
	include "../config_cms.php" ;
	include "mainPage.php";
	include "base_footer.php";
?>