<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	require_once 'Exception.php';
	require_once 'PHPMailer.php';
	require_once 'SMTP.php';

	$mail = new PHPMailer;

	$mail->CharSet = 'UTF-8';

	$mail->isSMTP();
	$mail->SMTPAuth = true;
	$mail->SMTPDebug = 0;

	$mail->Host = 'ssl://smtp.mail.ru';
	$mail->Port = 465;
	$mail->Username = '89202929892@mail.ru';
	$mail->Password = 'FNMJyKUBCvyUsNeC9m8j';
	$mail->setFrom('89202929892@mail.ru', 'Сайт Auroom');
	$mail->addAddress('auroom-nn@mail.ru', 'Дмитрий');
	$mail->Subject = 'Уведомления';
	$mail->msgHTML("<h4>Backup complite</h4>");

	$mail->send()	
?>