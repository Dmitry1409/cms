<?php
	session_start();
	if(!array_key_exists("aur_crm", $_COOKIE)){
		http_response_code(403);
		exit;
	}else{
		$db = new SQLite3("crm.db");
		$adm_tok = json_decode($db->querySingle("SELECT tokens FROM stuff WHERE role = 'admin'"));
		$tok_flag = false;
		for($i=0; $i<count($adm_tok);$i++){
			if($adm_tok[$i]->{'val'} == $_COOKIE['aur_crm']){
				$tok_flag = true;
			}
		}
		if(!$tok_flag){
			http_response_code(403);
			exit;
		}
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