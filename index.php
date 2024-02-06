<?php
	session_start();
	$db = new SQLite3('cms.db');

	require_once "config_cms.php";

	include "templates/listRouts.php";

	$listTemplates = array("technologylightLines"=>["technology/headLines.php", "technology/lightLinePage.php"],
						"technologyshadowProfil"=>["technology/headShadow.php", "technology/shadowPage.php"],
						"technologymultiLevel"=>["technology/headMultiLevel.php", "technology/multiLevelPage.php"],
						"technologyhiddenCurtain"=>["technology/headHiddenCurtain.php", "technology/hiddenCurtainPage.php"],
						"technologytextureColor"=>["technology/headTextureColor.php", "technology/textureColorPage.php"],
						"technologydubleVisionPrint"=>["technology/headDubleVis.php", "technology/dubleVisPage.php"],
						"technologycarvedCelling"=>["technology/headCarvedCelling.php", "technology/carvedCellingPage.php"],
						"technologyligthNiches"=>["technology/headLightNiches.php", "technology/lightNichesPage.php"],
						"technologystarsSky"=>["technology/headStarsSky.php", "technology/starsSkyPage.php"],
						"vendorsFoilBAUF"=>["vendorsFoil/headBauf.php", "vendorsFoil/baufPage.php"],
						"vendorsFoilMSD"=>["vendorsFoil/headMSD.php", "vendorsFoil/msdPage.php"],
						"vendorsFoilPongs"=>["vendorsFoil/headPongs.php", "vendorsFoil/pongsPage.php"],
						"vendorsFoilTeqtum"=>["vendorsFoil/headTeqtum.php", "vendorsFoil/teqtumPage.php"],
						"lighting"=>["headLighting.php", "lightingPage.php"],
						"favourites"=>["headFavourites.php", "FavouritesPage.php"],
						"certificates"=>["headCertificates.php", "certificatesPage.php"],
						"technologysimpleCeil"=>["technology/headSimpleCeil.php", "technology/simpleCeilPage.php"]);

	
	

	$getPar = explode("?", $_SERVER['REQUEST_URI']);

	$p = explode("/", $getPar[0]);

	//очищаем массив от пустых строк в начале и конце массива
	$clearArr = [];
	for($i = 0; $i<count($p); $i++){
		if($p[$i] != ""){
			$clearArr[] = $p[$i];
		}
	}

	//делаем путь минуя cms если путь длинее одного
	$f = "";
	for($i=0; $i<count($clearArr); $i++){
		if(count($clearArr) > 1){
			if($clearArr[$i] == "cms"){
				continue;
			}
		}
		$f = $f.$clearArr[$i];
	}

	if($f == 'cms'){
		// echo $root_dir;
		root();
		exit;
	}

	if(array_key_exists($f, $listTemplates)){
		require "templates/mainHead.php";
		include "templates/".$listTemplates[$f][0];
		require "templates/base_header.php";
		include "templates/".$listTemplates[$f][1];
		require "templates/clientFeedBack.php";
		if(strpos($_SERVER['REQUEST_URI'], "simpleCeil") == false){
			$out_count = 2;
			include "templates/simple_ceil_offer_block.php";
		}
		if(strpos($_SERVER['REQUEST_URI'], "lighting") == false && strpos($_SERVER['REQUEST_URI'], "simpleCeil") == false){
			include "templates/ligthing_link_block.php";
		}
		require "templates/base_footer.php";
	}else{
		header('Location: '.$domain.$root_dir);
	}

	function root(){
		require "templates/mainHead.php";
		// require "templates/startMainHead.php";
		require "templates/headMainPage.php";
		require "templates/base_header.php";
		require "templates/saleMainPage.php";
		include "templates/howMuchDone.php";
		include "templates/clientFeedBack.php";
		include "templates/mainPage.php";
		$out_count = 2;
		include "templates/simple_ceil_offer_block.php";
		include "templates/base_footer.php";
	}
?>
