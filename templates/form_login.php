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
	<form method="POST" class="flex_cont" action="login.php">
		<span class="error"><?php echo $error_login; ?></span>
		<input type="text" name="login" placeholder="login">
		<input style="margin-top: 1em;" type="password" name="password" placeholder="пароль">
		<input style="margin-top: 1em;" type="submit" value="отправить">
	</form>
</body>
</html>