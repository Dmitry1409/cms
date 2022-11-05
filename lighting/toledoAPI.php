<?php
	
	$url = 'http://api-ka.toledo24.ru/ka/ws/api.1cws';

	$xml = '<?xml version="1.0" encoding="utf-8"?>

			<soap12:Envelope xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">

  			<soap12:Body xmlns="http://www.toledo24.ru/webservices/ToledoAPI">

    		<PriceList>

    		<APIKey>fddc3897499b8e27a1c7142ae4bd164f</APIKey>

    		<Filter>{"Products": ["59706"]}</Filter>

    		<PreviousProduct></PreviousProduct>

    		<OnlyPrice>false</OnlyPrice>

    		</PriceList>

  			</soap12:Body>

			</soap12:Envelope>';


	$ch = curl_init();
	curl_setopt( $ch, CURLOPT_URL, $url );
	curl_setopt( $ch, CURLOPT_POST, true );
	curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $ch, CURLOPT_POSTFIELDS, $xml );
	$result = curl_exec($ch);
	curl_close($ch);

	// $val = json_decode($result);
	echo var_dump($result);
?>