<?php
	session_start();
	include "../config_cms.php" ;
	$db = new SQLite3('../cms.db');
	include "mainPage.php";
	include "base_footer.php";

?>