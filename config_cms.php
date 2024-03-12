<?php
	//файл должен быть после функции session_start()
	$domain = "http://localhost";
	$root_dir = "/cms/";
	$COMPANY_NAME = "АuRoom";
	$comp_telef1 = "8(831)200-34-98";
	$comp_telef2 = "+7 996 567 37 62";
	$email_comp = "auroom-nn@mail.ru";


	$ourCity = array("nizhniyNovgorod"=>['г. Нижний Новгород и обл.', 'г. Нижний Новгород Московское ш. 105', 'в Нижнем Новгороде'],
					"dzerzhinsk"=>['г. Дзержинск', 'г. Дзержинск ул. Циолковского, 32А', "в Дзержинске"],
					"kstovo"=>['г. Кстово', 'г. Кстово ул. Мира, 21А', "в г. Кстово"],
					"bor"=>['г. Бор', 'г. Бор ул. Максима Горького, 90', "на Бору"],
					"balahna"=>['г. Балахна', "г.Балахна ул. Челюскинцев, 10А", "в Балахне"],
					"bogorodsk"=>['г. Богородск', 'г. Богородск ул. Ленина, 203', "в Богородске"],
					"gorodec"=>['г. Городец', 'г. Городец ул.Кирова, 25', "в Городце"],
					"zavolzhe"=>['г. Заволжье', 'г. Заволжье ул. Пономарёва, 2', "в Заволжье"],
					"pavlovo"=>['г. Павлово', 'г. Павлово ул. Аллея Ильича, 5', "в Павлово"]);
	

	if(!array_key_exists('cityHeader', $_SESSION) && !array_key_exists("city", $_GET)){
		$_SESSION['cityHeader'] = "Нижний Новгород и обл.";
		$_SESSION['addres_comp'] = "г. Нижний Новгород Московское шоссе 105";
		$_SESSION['citytitle'] = "в Нижнем Новгороде";
	}elseif(array_key_exists("city", $_GET)){
		if(array_key_exists($_GET['city'], $ourCity)){
			$_SESSION['cityHeader'] = $ourCity[$_GET['city']][0];
			$_SESSION['addres_comp'] = $ourCity[$_GET['city']][1];
			$_SESSION['citytitle'] = $ourCity[$_GET['city']][2];
		}else{
			$_SESSION['cityHeader'] = "Нижний Новгород и обл.";
			$_SESSION['addres_comp'] = "г. Нижний Новгород Московское шоссе 105";
			$_SESSION['citytitle'] = "в Нижнем Новгороде";
		}
	}
	
	$fn = array('Favourites_script.js'=>'Favourites_script.js', 'carvedCelling_script.js'=>'carvedCelling_script.js', 'dubleVis_script.js'=>		'dubleVis_script01.js', 'exampWorkFoto.js'=>'exampWorkFoto01.js', 'fancybox.js'=>'fancybox.js',
	 			'feedBackClient.js'=>'feedBackClient01.js', 'fotoGalView.js'=>'fotoGalView.js', 'hidenCurtain.js'=>'hidenCurtain.js',
	  			'ligthing_script.js'=>'ligthing_script.js', 'main.js'=>'main01.js', 'mainPage.js'=>'mainPage01.js',
	   			'multiLev_script.js'=>'multiLev_script01.js','sale_light_block.js'=>'sale_light_block01.js',
	   			'simpleCeilOffer.js'=>'simpleCeilOffer01.js','starsSky_script.js'=>'starsSky_script.js',
	   			'textureColor_script.js'=>'textureColor_script.js','FavouritesStyle.css'=>'FavouritesStyle.css',
	   			'fancybox.css'=>'fancybox.css', 'lightingStyle.css'=>'lightingStyle.css', 'main.css'=>'main01.css',
	   			'mainPage.css'=>'mainPage.css', 'normalize.css'=>'normalize.css','vendorsFoilStyle.css'=>'vendorsFoilStyle.css', 
	   			'carvedCellingStyle.css'=>'carvedCellingStyle.css','dubleVisStyle.css'=>'dubleVisStyle.css', 
	   			'hiddenCurtainStyle.css'=>'hiddenCurtainStyle.css','lightNichesStyle.css'=>'lightNichesStyle.css',
	   			'lights.css'=>'lights.css', 'multiLevelStyle.css'=>'multiLevelStyle.css','shadow.css'=>'shadow.css',
	   			'starsSkyStyle.css'=>'starsSkyStyle.css', 'textureColorStyle.css'=>'textureColorStyle.css',
	   			'site.webmanifest'=>'site.webmanifest');
?>