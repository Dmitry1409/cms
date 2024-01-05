<?php
	session_start();
	$db = new SQLite3('../cms.db');
	include "../config_cms.php" ;
	include "listRouts.php";
	include "mainPage.php";
	$out_count = 2;
	include "simple_ceil_offer_block.php";
	include "base_footer.php";
?>