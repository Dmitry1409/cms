<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once 'Exception.php';
require_once 'PHPMailer.php';
require_once 'SMTP.php';

session_start();
$db = new SQLite3('../cms.db');

require_once "../scripts_php/funcsDateBase.php";
include "../config_cms.php";

$mail = new PHPMailer;

$mail->CharSet = 'UTF-8';

$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->SMTPDebug = 0;

$name = $_GET['name'];
$phone = $_GET['phone'];

$html = "<h4>Имя: $name</h4>\n";
$html = $html."<h4>Телефон: $phone</h4><br><br>";

if(array_key_exists("dataCalc", $_GET)){
	$val = json_decode($_GET['dataCalc']);
	$val = get_object_vars($val);
	$keys = array_keys($val);

	for($i=0; $i<count($keys); $i++){
		$k = $keys[$i];
		$v = $val[$keys[$i]];
		$html = $html."\n<h4>$k: $v</h4><br>";
	}
}

if(array_key_exists('dataProd', $_GET)){
	$val = json_decode($_GET['dataProd']);
	$code_arr = [];
	
	for($i=0; $i<count($val); $i++){
		$code_arr[] = $val[$i]->code;
	}
	$q = createSQLRequest("*", "ToledoProducts", "code", $code_arr);
	
	$prod = exectRequest($q, $db);

	$html = $html."\n<h3>Продукты</h3>";

	for($i=0; $i<count($prod); $i++){
		$name = $prod[$i]['name'];
		$id = $prod[$i]['id'];
		$code = $prod[$i]['code'];
		$amount = $val[$i]->amount;
		$html = $html."\n<h4>Наименование: $name</h4>";
		$html = $html."\n<h4>Code: $code</h4>";
		$html = $html."\n<h4>ID: $id</h4>";
		$html = $html."\n<h4>Колличество : $amount</h4>";
		$html = $html."\n<br><br>";
	}
}
if(array_key_exists('foto_id', $_GET)){
	$f_id = $_GET['foto_id'];
	$q = "SELECT * FROM imageObj WHERE id = $f_id";
	$img = exectRequest($q, $db);
	$html = $html."\n<h3>Расчитать потолок по фото</h3>";

	for($i=0; $i<count($img); $i++){
		$src = $domain.$root_dir.$img[$i]['jpg'];
		$html = $html."\n<img style='width=300px; height=300px; object-fit=cover;' src=$src>";
	}
}
if(array_key_exists("simpleCeil", $_GET)){
	$html = $html."\n<h3>Заказать простой потолок</h3><br><br>";
	$simpleCeil = json_decode($_GET['simpleCeil']);
	$sr = $simpleCeil->img_sr;
	$sr = $domain.$sr;
	$html = $html."\n<img style='width=300px; height=300px; object-fit=cover;' src=$sr>";
	$pr = $simpleCeil->prise;
	$html = $html."\n<h3>Цена: $pr</h3>";
}

if(array_key_exists('click_link', $_GET)){
	$click_link = $_GET['click_link'];
	$html = $html."\n<h4>Кликнули по ссылке в: $click_link</h4>";
}

$mail->Host = 'ssl://smtp.mail.ru';
$mail->Port = 465;
$mail->Username = '89202929892@mail.ru';
$mail->Password = 'nGWBmwn0wY2cHc1vvQvi';
$mail->setFrom('89202929892@mail.ru', 'Сайт Auroom');
$mail->addAddress('auroom-nn@mail.ru', 'Дмитрий');
$mail->Subject = 'Заказ';

$mail->msgHTML($html);

echo "success";
// $mail->addAttachment('hed2.jpg');

// if($mail->send()){
// 	echo "success";
// }else{
// 	echo $mail->ErrorInfo;
// }

?>
