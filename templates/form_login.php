<form method="POST" class="flex_cont" action="login.php">
	<span class="error"><?php echo $error_login; ?></span>
	<input type="text" name="login" placeholder="login">
	<input style="margin-top: 1em;" type="password" name="password" placeholder="пароль">
	<input style="margin-top: 1em;" type="submit" value="отправить">
</form>