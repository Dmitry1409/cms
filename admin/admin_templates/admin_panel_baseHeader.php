<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0
				maximum-scale=1.0, user-scalable=0">
	<!-- <title>Админка</title> -->
	<link rel="stylesheet" type="text/css" href="../css/normalize.css">
	<script defer src="js/main_admin.js"></script>
	<style type="text/css">
		.panelWrapp a{
			padding: 10px;
			border: 1px solid grey;
		}
		.panelWrapp{
			display: flex;
			margin-right: 60px;
			flex-wrap: wrap;
			margin-top: 30px;
			margin-bottom: 20px;
		}
		.msg{
			position: fixed;
			right: -400px;
			top: 50px;
			border-radius: 10px;
			padding: 20px;
			color: white;
			transition: right .7s;
			z-index: 100;
		}
		.msg_succ{
			background-color: hsl(152deg 100% 40%);
		}
		.msg_err{
			background-color: hsl(0deg 100% 75%);
		}
		.msg_action{
			right: 20px !important;
		}
		input::-webkit-outer-spin-button,
		input::-webkit-inner-spin-button {
		    /* display: none; <- Crashes Chrome on hover */
		    -webkit-appearance: none;
		    margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
		}
	</style>
	
</head>
<body>
	<div class="msg"></div>
	<a href="logout.php" style="position: absolute; right: 20px;">выйти</a>
	<div class="panelWrapp">
		<a href="adminPanel">Панель</a>
		<a href="dataBase">База данных</a>
		<a href="clientCRM">Клиенты CRM</a>
		<a href="pricing">Счета</a>
		<a href="clients">Клиенты</a>
	</div>
