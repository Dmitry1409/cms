<?php 
	require "../config_cms.php";
	
	require "../session_handlers.php";
	session_start();
	collect_data();
	$db = new SQLite3('../cms.db');
	require "../templates/mainHead.php";
	require "headFavourites.php";
	require "../templates/base_header.php";
	require "FavouritesPage.php";
	require "../templates/base_footer.php";

?>