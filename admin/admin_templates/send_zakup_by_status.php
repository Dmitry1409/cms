<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require_once '../mailer/Exception.php';
    require_once '../mailer/PHPMailer.php';
    require_once '../mailer/SMTP.php';
    
    $mail = new PHPMailer;

    $mail->CharSet = 'UTF-8';

    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPDebug = 0;
    $mail->Host = 'ssl://smtp.mail.ru';
    $mail->Port = 465;
    $mail->Username = '89202929892@mail.ru';
    $mail->Password = 'ixB7Amwrk0qGx3eiNWw1';
    
    $mail->setFrom('89202929892@mail.ru', 'AuRoom');
    // $mail->addAddress('89202929892@mail.ru', 'Ольга');
    $mail->addAddress('diler.potolok@mail.ru', 'Анастасия');
    $mail->Subject = 'Заказ';
    

    ob_start();
    include "admin_templates/getHTMLText.php";
    $html = ob_get_clean();


    $mail->msgHTML($html);

    if(!$mail->send()){
       echo "faled";
       exit;
    }
    
    $mail = new PHPMailer;

    $mail->CharSet = 'UTF-8';

    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPDebug = 0;
    $mail->Host = 'ssl://smtp.mail.ru';
    $mail->Port = 465;
    $mail->Username = '89202929892@mail.ru';
    $mail->Password = 'ixB7Amwrk0qGx3eiNWw1';
    
    $mail->setFrom('89202929892@mail.ru', 'Сайт Auroom');
    $mail->addAddress('auroom-nn@mail.ru', 'Дмитрий');
    $mail->Subject = 'Уведомления';
    
    $mail->msgHTML("<h3>Заказ отправлен</h3>".$html);
     
    $mail->send();
    
    for($i=0; $i<count($idZakup); $i++){
    	$events = json_decode($db->querySingle("SELECT ref_event FROM zakupki WHERE id = {$idZakup[$i]}"));
    	for($j=0; $j<count($events); $j++){
    		$type = $db->querySingle("SELECT type FROM events WHERE id = {$events[$j]}");
    		if($type == "заказать"){
    			$db->exec("UPDATE events SET status = 'отправлен crm' WHERE id = {$events[$j]}");
    		}
    	}
    	$db->exec("UPDATE zakupki SET status = 'отправлен crm' WHERE id = {$idZakup[$i]}");
    }
    echo "succes";  
?>