<?php 
	session_start();
	$db = new SQLite3('../../cms.db');
	require "../../config_cms.php";
	require "../../templates/mainHead.php";
	require "headDubleVis.php";
	require "../../templates/base_header.php";
	require "dubleVisPage.php";
	require "../../templates/clientFeedBack.php";
	require "../../templates/base_footer.php";

?>