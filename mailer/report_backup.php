<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	require_once 'Exception.php';
	require_once 'PHPMailer.php';
	require_once 'SMTP.php';

	$mail = new PHPMailer;

	$db_crm = new SQLite3("cms/public_html/admin/crm.db");
	$smtp_tok = $db_crm->querySingle("SELECT value FROM keys WHERE name = 'smtp_mail_token'");

	$mail->CharSet = 'UTF-8';

	$mail->isSMTP();
	$mail->SMTPAuth = true;
	$mail->SMTPDebug = 0;

	$mail->Host = 'ssl://smtp.mail.ru';
	$mail->Port = 465;
	$mail->Username = '89202929892@mail.ru';
	$mail->Password = $smtp_tok;
	$mail->setFrom('89202929892@mail.ru', 'Сайт Auroom');
	$mail->addAddress('auroom-nn@mail.ru', 'Дмитрий');
	$mail->Subject = 'Уведомления';
	$mail->msgHTML("<h4>Backup complite</h4>");

	$mail->send()	
?>