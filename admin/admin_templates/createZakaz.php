<?php
	// ob_start();
	// include "admin_templates/getHTMLText.php";
	// $html_msg = ob_get_clean();

	session_start();
	if(!$_SESSION['isAdmin']){
		http_response_code(403);
		exit;
	}


	// use PHPMailer\PHPMailer\PHPMailer;
	// use PHPMailer\PHPMailer\Exception;
	// require_once '../mailer/Exception.php';
	// require_once '../mailer/PHPMailer.php';
	// require_once '../mailer/SMTP.php';

	// $mail = new PHPMailer;

	// $mail->CharSet = 'UTF-8';

	// $mail->isSMTP();
	// $mail->SMTPAuth = true;
	// $mail->SMTPDebug = 0;

	// $mail->Host = 'ssl://smtp.mail.ru';
	// $mail->Port = 465;
	// $mail->Username = '89202929892@mail.ru';
	// $mail->Password = 'nGWBmwn0wY2cHc1vvQvi';
	// $mail->setFrom('89202929892@mail.ru', 'AuRoom');
	// $mail->addAddress('auroom-nn@mail.ru', 'Дмитрий');
	// $mail->Subject = 'Заказ';

	// $mail->msgHTML($html_msg);

	// if($mail->send()){
	// 	echo "success";
	// }else{
	// 	echo $mail->ErrorInfo;
	// }
	
?>