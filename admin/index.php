<?php
	

	$db = new SQLite3("crm.db");

	include "api/api_secure.php";

	include "admin_templates/admin_panel_baseHeader.php";

	$dirs = array("dataBase"=>["admin_templates/dataBase.php"],
					"create_shet"=>["admin_templates/create_shet.php"],
					"adminPanel"=>[],
					"create_dogovor"=>["admin_templates/create_dogovor.php"],
					"clientCRM"=>["admin_templates/clientCRM.php"],
					"clients"=>["admin_templates/clients.php"],
					"addReportZamer"=>["admin_templates/addReportZamer.php"],
					"showZamer"=>["admin_templates/showZamer.php"],
					"edit_zamer"=>["admin_templates/edit_zamer.php"]
				);
	
	$getPar = explode("?", $_SERVER['REQUEST_URI']);

	$pMain = explode("/", $getPar[0]);

	for($iM=0; $iM<count($pMain); $iM++){
		if(array_key_exists($pMain[$iM], $dirs)){
			for($jM=0; $jM<count($dirs[$pMain[$iM]]); $jM++){
				include $dirs[$pMain[$iM]][$jM];
			}
		}
	}


	include "admin_templates/admin_panel_baseFooter.php";

?>