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


	include "admin_templates/admin_panel_baseFooter.php"; 
?>
<a href="../index.php">index</a>



<?php
	// header("Location: http://localhost/cms/");
	
	// if($_SERVER['REQUEST_METHOD'] == "POST"){	
	// 	$res = $mydb->query('SELECT * FROM stuff WHERE name == '.'"'.$_POST['login'].'"')->fetchArray();
	// 	if($res){
	// 		if($res['password'] == $_POST['password']){
	// 			echo 'we admin';
	// 			session_start();
	// 			$_SESSION['login'] = $_POST['login'];
	// 			$_SESSION['time'] = date('H:i:m');
	// 		}else{
	// 			echo 'no valid password';
	// 		}
	// 	}else{
	// 		echo 'no';
	// 	}
	// }
	// echo print_r($_SESSION);

	// echo print_r($res->fetchArray());



	// echo $futt;
	// echo $fuut;
	// echo "<br><br>";
	// if(!$db){
	// 	echo 'no';
	// }else{
	// 	echo 'es';
	// }
	// // echo $_POST['login'], var_dump($_POST['login']);
	// $sql = "SELECT * FROM stuff WHERE name = '". $_POST['login']."'";
	// $resul = $db->query($sql)->fetchArray();
	// if($resul){
	// 	if($_POST['password'] == $resul['password']){
	// 		echo "we admin\n";
	// 	}else{
	// 		echo "we no admin\n";
	// 	}
	// }else{
	// 	echo 'we no stuff\n';
	// }
	// echo print_r($resul);
	// if($resul['password'] == )
	// while($res = $resul->fetchArray()){
	// 	echo print_r($res);
	// }
	// // echo $_POST['login'];
	// $result = $db->query('SELECT * FROM USER2');


	// echo var_dump($_result);

?>
