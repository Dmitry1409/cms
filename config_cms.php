<?php
	//файл должен быть после функции session_start()
	$domain = "http://localhost";
	$root_dir = "/cms/";
	$COMPANY_NAME = "АuRoom";
	$comp_telef1 = "8(831)200-34-98";
	$comp_telef2 = "+7 996 567 37 62";
	$email_comp = "auroom-nn@mail.ru";
	if(!array_key_exists('cityHeader', $_SESSION)){
		$_SESSION['cityHeader'] = "Нижний Новгород и обл.";
		$_SESSION['addres_comp'] = "г. Нижний Новгород Московское шоссе 105";
		$_SESSION['citytitle'] = "в Нижнем Новгороде";
	}

	if(array_key_exists("idGroup", $_GET)){

		$groupYDirect = array('5153947630'=>['г. Балахна', "г.Балахна ул. Челюскинцев, 10А", "в Балахне"],
							'5153947629' => ['г. Нижний Новгород и обл.', 'г. Нижний Новгород Московское ш. 105', 'в Нижнем Новгороде'],
							'5153947631' => ['г. Городец', 'г. Городец ул.Кирова, 25', "в Городце"],
							'5153947632' => ['г. Заволжье', 'г. Заволжье ул. Пономарёва, 2', "в Заволжье"],
							'5153947633' => ['г. Бор', 'г. Бор ул. Максима Горького, 90', "на Бору"],
							'5153947634' => ['г. Дзержинск', 'г. Дзержинск ул. Циолковского, 32А', "в Дзержинске"],
							'5153947635' => ['г. Богородск', 'г. Богородск ул. Ленина, 203', "в Богородске"],
							'5153947636' => ['г. Кстово', 'г. Кстово ул. Мира, 21А', "в г. Кстово"],
							'5153947637' => ['г. Павлово', 'г. Павлово ул. Аллея Ильича, 5', "в Павлово"]);


		$groupYDirect2 = array('5366403748'=>['г. Балахна', "г.Балахна ул. Челюскинцев, 10А", "в Балахне"],
							'5366403747' => ['г. Нижний Новгород и обл.', 'г. Нижний Новгород Московское ш. 105', 'в Нижнем Новгороде'],
							'5366403749' => ['г. Городец', 'г. Городец ул.Кирова, 25', "в Городце"],
							'5366403750' => ['г. Заволжье', 'г. Заволжье ул. Пономарёва, 2', "в Заволжье"],
							'5366403751' => ['г. Бор', 'г. Бор ул. Максима Горького, 90', "на Бору"],
							'5366403752' => ['г. Дзержинск', 'г. Дзержинск ул. Циолковского, 32А', "в Дзержинске"],
							'5366403753' => ['г. Богородск', 'г. Богородск ул. Ленина, 203', "в Богородске"],
							'5366403754' => ['г. Кстово', 'г. Кстово ул. Мира, 21А', "в г. Кстово"],
							'5366403755' => ['г. Павлово', 'г. Павлово ул. Аллея Ильича, 5', "в Павлово"]);

		$idg = $_GET['idGroup'];
		if(array_key_exists($idg, $groupYDirect)){
			$_SESSION['cityHeader'] = $groupYDirect[$idg][0];
			$_SESSION['addres_comp'] = $groupYDirect[$idg][1];
			$_SESSION['citytitle'] = $groupYDirect[$idg][2];
		}elseif(array_key_exists($_GET['idGroup'], $groupYDirect2)){
			$_SESSION['cityHeader'] = $groupYDirect2[$idg][0];
			$_SESSION['addres_comp'] = $groupYDirect2[$idg][1];
			$_SESSION['citytitle'] = $groupYDirect2[$idg][2];
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