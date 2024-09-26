<?php
	if(!array_key_exists("aur_crm", $_COOKIE)){
		http_response_code(403);
		exit;
	}else{
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
?>