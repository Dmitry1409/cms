<?php 
	require "../config_cms.php";
	
	require "../session_handlers.php";
	session_start();
	collect_data();
	$db = new SQLite3('../cms.db');
	require "../templates/mainHead.php";
	require "headLighting.php";
	require "../templates/base_header.php";
	require "lightingPage.php";
	require "../templates/clientFeedBack.php";
	require "../templates/base_footer.php";

?>