<?php
	// require "../session_handlers.php";
	session_start();
	// collect_data();
	if(!$_SESSION['isAdmin']){
		// header("Location: ../");
		http_response_code(403);
		exit;
	}
	include "admin_templates/admin_panel_baseHeader.php";
	

	echo "<h1>Hello</h1>";

?>
