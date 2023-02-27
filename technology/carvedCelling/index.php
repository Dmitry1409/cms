<?php 
	session_start();
	$db = new SQLite3('../../cms.db');
	require "../../config_cms.php";
	require "../../templates/mainHead.php";
	require "headCarvedCelling.php";
	require "../../templates/base_header.php";
	require "carvedCellingPage.php";
	require "../../templates/clientFeedBack.php";
	require "../../templates/base_footer.php";

?>