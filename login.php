<?php
	require "config_cms.php";
	$db = new SQLite3('admin/crm.db');

	if($_SERVER['REQUEST_METHOD'] == "POST"){
		if($_POST['login'] == "admin"){
			$admin = $db->query("SELECT * FROM stuff WHERE role = 'admin'")->fetchArray(SQLITE3_ASSOC);
			if($admin['pass'] == md5($_POST['password'])){
				$tok_js = json_decode($admin['tokens']);
				$arr_tok = [];
				for($i=0; $i<count($tok_js); $i++){
					if($tok_js[$i]->{'expires'}>time()){
						$arr_tok[] = $tok_js[$i];
					}
				}
				$new_cook = md5(microtime() . rand(0, 9999));
				$t = time()+ 604800;
				setcookie("aur_crm", $new_cook, $t, $root_dir."admin");
				$arr_tok[] = ["val"=>$new_cook, "expires"=>$t];
				$arr_tok = json_encode($arr_tok);
				$db->query("UPDATE stuff SET tokens = '$arr_tok' WHERE role = 'admin'");
				header('Location: admin/');
			}else{
				$error_login = "Не верный пароль";
			}
		}else{
			$error_login = "Не верный логин";
		}	
	}
	
	include "templates/form_login.php";




?>
	


