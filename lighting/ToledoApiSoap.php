<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
</head>
	<body>
<?php
$db = new Sqlite3('../cms.db');
$res = $db->query("SELECT code FROM ToledoProducts");
$arr = [];
while($r = $res->fetchArray(SQLITE3_ASSOC)){
	$arr[] = $r['code'];
}
$arr = json_encode($arr);

$params = array(

    "APIKey" => "fddc3897499b8e27a1c7142ae4bd164f",

    "Filter" => "{'Products': $arr}",

    "PreviousProduct" => "",

    "OnlyPrice" => false,

);


$client = new SoapClient("http://api-ka.toledo24.ru/ka/ws/api.1cws?wsdl");

$res = $client->PriceList($params);
// $res = $client->ProductsInfo($params);

$val = $res->return;

echo "<pre>";
// echo var_dump($params)

// print_r($val);
//ProductId
$val = json_decode($val);
$val = $val->{'#value'}->Objects;
for($i=0; $i<count($val); $i++){
	$q = "UPDATE ToledoProducts SET prise = ".$val[$i]->{"#value"}->Price;
	// echo $i, "<br>";
	// echo $val[$i]->{"#value"}->Name." ";
	// echo "<br>";
	$q = $q.", наличие = ".$val[$i]->{"#value"}->Balance;
	$q = $q." WHERE code = ".$val[$i]->{"#value"}->ProductId;

	// echo $val[$i]->{"#value"}->ProductId,"<br>", $q, "<br>";
	// echo $q;
	// echo $db->exec($q);
	// break;
	// echo "<br>";
	// echo $val[$i]->{"#value"}->Balance;
	// echo "<br>";
}
echo "succes";
	
?>
</body>
</html>