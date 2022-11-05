<?php
	require "../session_handlers.php";
	session_start();
	collect_data();
	if(!$_SESSION['isAdmin']){
		// header("Location: ../");
		http_response_code(403);
		exit;
	}

	include "admin_templates/admin_panel_baseHeader.php";
?>

<button name="tab" style="margin-top: 20px;">Получить все таблицы</button>
<div class="result"></div>
<div class="con_table"></div>

<?php
	include "admin_templates/admin_panel_baseFooter.php"; 
?>