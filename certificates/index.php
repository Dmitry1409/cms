<?php 
	session_start();
	$db = new SQLite3('../cms.db');
	require "../config_cms.php";
	require "../session_handlers.php";
	require "../templates/mainHead.php";
	require "headCertificates.php";
	require "../templates/base_header.php";
	require "certificatesPage.php";
	require "../templates/clientFeedBack.php";
	require "../templates/base_footer.php";

?>