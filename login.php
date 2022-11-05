<?php
	require "config_cms.php";
	require "session_handlers.php";
	$db = new SQLite3('cms.db');
	session_start();
	collect_data();
	ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Вход</title>
	<style type="text/css">
		.flex_cont{
			width: 100%;
			height: 100vh;
			display: flex;
			flex-direction: column;
			justify-content: center;
			align-items: center;
		}
		.error{
			color: red;
			font-size: 12px;
		}
	</style>
</head>
<body>
	<?php
		if($_SERVER['REQUEST_METHOD'] == "POST"){

			if($_POST['login'] == "admin"){
				$pass = $db->querySingle('SELECT password FROM stuff WHERE name == "admin"');
				if ($pass == $_POST['password']){
					$_SESSION['isAdmin'] = true;
					header('Location: admin/admin_panel.php');
					ob_end_flush();
					exit;
				}else{
					$error_login = "Не верный пароль";
					include "templates/form_login.php";
					exit;
				}
			}else{
				$error_login = "Не верный логин";
				include "templates/form_login.php";
				exit;
			}

		}elseif($_SERVER['REQUEST_METHOD'] == "GET"){
			if(!$_SESSION['isAdmin']){
				include "templates/form_login.php";
			}else{
				header("Location: admin/admin_panel.php");
				ob_end_flush();
				exit;
			}
		}
	?>

	<a href="index.php">index</a>
	
	</body>
</html>

