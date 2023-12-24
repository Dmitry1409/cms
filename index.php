<?php
	session_start();
	$db = new SQLite3('cms.db');
	require "config_cms.php";

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
						"certificates"=>["headCertificates.php", "certificatesPage.php"]);
	

	$getPar = explode("?", $_SERVER['REQUEST_URI']);

	$p = explode("/", $getPar[0]);

	//очищаем массив от пустых строк в начале и конце массива
	$clearArr = [];
	for($i = 0; $i<count($p); $i++){
		if($p[$i] != ""){
			$clearArr[] = $p[$i];
		}
	}

	//делаем путь миную cms если путь длинее одного
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
		root();
		exit;
	}

	if(array_key_exists($f, $listTemplates)){
		require "templates/mainHead.php";
		include "templates/".$listTemplates[$f][0];
		require "templates/base_header.php";
		include "templates/".$listTemplates[$f][1];
		require "templates/clientFeedBack.php";
		require "templates/base_footer.php";
	}else{
		header('Location: '.$domain.$root_dir);
	}

	function root(){
		require "templates/startMainHead.php";
		require "templates/headMainPage.php";
		require "templates/base_header.php";
		include "templates/howMuchDone.php";
	}
?>
