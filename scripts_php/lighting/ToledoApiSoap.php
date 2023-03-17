<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
</head>
	<body>
<?php
$db = new Sqlite3('../cms.db');
$res = $db->query("SELECT code FROM ToledoProducts ORDER BY code");
$arr = [];
while($r = $res->fetchArray(SQLITE3_ASSOC)){
	$arr[] = $r['code'];
}
echo count($arr), "<br><br>";
$arr = json_encode($arr);

$params = array(

    "APIKey" => "fddc3897499b8e27a1c7142ae4bd164f",

    "Filter" => "{'Products': $arr}",

    "PreviousProduct" => "",

    "OnlyPrice" => false,

);


$client = new SoapClient("http://api-ka.toledo24.ru/ka/ws/api.1cws?wsdl");

$res = $client->PriceList($params);

$val = $res->return;
$val = json_decode($val);
$val = $val->{'#value'}->Objects;

for($i=0; $i<count($val); $i++){
	$id = $val[$i]->{"#value"}->ProductId;
	$q = "UPDATE ToledoProducts SET prise = ".$val[$i]->{"#value"}->Price;
	$q = $q.", наличие = ".$val[$i]->{"#value"}->Balance;
	$q = $q." WHERE code = ".$id;

	// echo $db->exec($q);
}

	
?>
</body>
</html>