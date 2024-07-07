<?php
	session_start();
	if(!$_SESSION['isAdmin']){
		http_response_code(403);
		exit;
	}

	include "admin_templates/admin_panel_baseHeader.php";

	$dirs = array("dataBase"=>["admin_templates/dataBase.php"],
					"adminPanel"=>[],
					"pricing"=>["admin_templates/pricing.php"],
					"clientCRM"=>["admin_templates/clientCRM.php"],
					"clients"=>["admin_templates/clients.php"],
					"addReportZamer"=>["admin_templates/addReportZamer.php"],
					"showZamer"=>["admin_templates/showZamer.php"]);
	
	$getPar = explode("?", $_SERVER['REQUEST_URI']);

	$p = explode("/", $getPar[0]);

	for($iM=0; $iM<count($p); $iM++){
		if(array_key_exists($p[$iM], $dirs)){
			for($jM=0; $jM<count($dirs[$p[$iM]]); $jM++){
				include $dirs[$p[$iM]][$jM];
			}
		}
	}


	include "admin_templates/admin_panel_baseFooter.php";

?>