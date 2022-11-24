<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
</head>
	<body>
<?php
// $params = array(
//     "APIKey" => "fddc3897499b8e27a1c7142ae4bd164f",
//     "Filter" => '{"Products": ["619601", "91485"]}',
//     "PreviousProduct" => "",
//     "OnlyPrice" => false,
// );

// $client = new SoapClient("http://api-ka.toledo24.ru/ka/ws/api.1cws?wsdl");
// $res = $client->PriceList($params);
// $res = json_decode($res->return);
// // print_r($res);
// echo var_dump($res->{'#value'}->Objects[0]->{'#value'});

$params = array(

    "APIKey" => "fddc3897499b8e27a1c7142ae4bd164f",

    "Filter" => '{"Products": ["619601", "91485", "601356", "414258"]}',

    "PreviousProduct" => "",

    "OnlyPrice" => false,

);

$client = new SoapClient("http://api-ka.toledo24.ru/ka/ws/api.1cws?wsdl");

$res = $client->PriceList($params);

$val = $res->return;

echo "<pre>";

// print_r($res);

$r = json_decode($val);
$ar = $r->{'#value'}->Objects;
echo var_dump($ar);
for($i=0; $i<count($ar); $i++){
	echo $ar[$i]->{"#value"}->Name." ";
	echo "<br>";
	echo $ar[$i]->{"#value"}->Price;
	echo "<br>";
	echo $ar[$i]->{"#value"}->Balance;
	echo "<br>";
}
	
// $js = json_decode($res->return);
// $js2 = json_decode($res->return);

// echo var_dump($js2);

?>
</body>
</html>