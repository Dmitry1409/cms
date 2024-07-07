<?php
	session_start();
	if(!$_SESSION['isAdmin']){
		http_response_code(403);
		exit;
	}

	$db = new SQLite3('crm.db');



	$dict = json_decode($_POST['dict']);
	$rooms = $dict->rooms;


	$all_data = ["общ. периметр"=>0,
				"общ. площадь"=>0,
				"доп. углы"=>0,
				"установка люстра наклад."=>0,
				"установка люстра крюч." =>0,
				"установка спот встраив."=>0,
				"обвод тр"=>0,
				"установка накл. гардины"=>0,
				"каркас имитации стены"=>0,
				"установка принуд. вентиляции"=>0,
				"установка решетка вент."=>0,
				"установка гардины Lumfer UK"=>0,
				"установка гардины ПК-5"=>0,
				"установка световой линии"=>0,
				"обрыв световой линии"=>0,
				"установка блока питания"=>0,
				'установка парящего профиля'=>0,
				"установка теневого профиля алюм."=>0,
				"установка теневого профиля ПВХ"=>0
				];

	$all_mat = [
			"багет пвх"=>0,
			"маскировочная лента"=>0,
			"саморезы 41"=>0,
			"дупель 6х40"=>0,
			"подвес"=>0,
			"крючек"=>0,
			"клемник"=>0,
			"бур 110х6" =>0,
			"платф. под спот 90"=>0,
			"платф. под спот унв."=>0,
			"провод ПВС 2х0.75"=>0,
			"кольцо 90"=>0,
			"кольцо 60"=>0,
			"брус 45х45"=>0,
			"кронштейн 100х125"=>0,
			"доска 90х20"=>0,
			"перо по кафелю"=> 0,
			"клей титан"=>0,
			"спот GX-53 белый"=>0,
			"спот GX-53 хром"=>0,
			"спот GX-53 золото"=>0,
			"обвод тр. 22"=>0,
			"обвод тр. 27"=>0,
			"обвод тр. 32"=>0,
			"решетка вент. 110"=>0,
			"решетка вент. 120"=>0,
			"ПВХ гардина 2-х рядная"=>0,
			"ПВХ блэнда"=>0,
			"ПВХ углы компл. 2шт" =>0,
			"гардина Lumfer UK белый"=>0,
			"гардина Lumfer UK черный"=>0,
			"гардина ПК-5 белый"=>0,
			"торцевая заглюшка Lumfer UK белый"=>0,
			"торцевая заглюшка Lumfer UK черный"=>0,
			"блок питания 50W"=>0,
			"блок питания 100W"=>0,
			"блок питания 150W"=>0,
			"профиль line30"=>0,
			"профиль line50"=>0,
			"заглушка line30"=>0,
			"заглушка line50"=>0,
			"рассеватель полик. line30 белый"=>0,
			"рассеватель полик. line50 белый"=>0,
			"рассеватель полик. line30 темный"=>0,
			"рассеватель полик. line50 темный"=>0,
			"Светод. лента 24V 12W холодная"=>0,
			"Светод. лента 24V 12W дневная"=>0,
			"Светод. лента 24V 12W теплая"=>0,
			"профиль теневой алюм."=>0,
			"профиль теневой ПВХ"=>0
			];

	$wall = ["бетон"=>0,
			"гипс\карт"=>0,
			"гипс\блок"=>0,
			"дерево"=>0,
			"кирпич"=>0,
			"кермика"=>0,
			"гранит"=>0];



	

	$sum_polotna =[];
	$sum_data = [];
	$sum_mat = [];
	$sum_wall = [];
	
	// основной цыкл расчета--------------------------------------------
	foreach ($rooms as $r) {
		$all_data['общ. периметр'] += $r->{'перим.'};
		$all_data['общ. площадь'] += $r->{'площадь'};
		$polotno = [];
		$polotno['м2'] = $r->{'площадь'};
		$polotno['фактура'] = $r->{'полотно'};
		$polotno['название комнаты'] = $r->{'название комнаты'};
		$sum_polotna[] = $polotno;

		foreach ($r->{'стены'} as $key => $value) {
			$wall[$key] += $value;
		}

		foreach ($r as $key => $value) {
			switch ($key) {
				case "доп. углы":
					$all_data['доп. углы'] += $r->{'доп. углы'};
					break;

				case "имитация стены":
					$all_data['каркас имитации стены'] += $value;
					$all_mat['брус 45х45'] += $value;
					$all_mat['кронштейн 100х125'] += ceil($value*2);
					break;

				case 'люстры':
					foreach ($value as $lk => $lv) {
						if($lk == 'накладная'){
							$all_data['установка люстра наклад.'] += $lv;
							$all_mat['доска 90х20'] += 0.5*$lv;
							$all_mat['подвес'] += 2*$lv;
						}
						if($lk == 'крючек'){
							$all_data['установка люстра крюч.'] += $lv;
						}
						$all_mat['клемник'] += 2*$lv;
						$all_mat['кольцо 60'] += $lv;
						$all_mat["провод ПВС 2х0.75"] += $lv;
					}
					break;
				case "споты наши":
					foreach ($value as $lv) {
						$all_data['установка спот встраив.'] += $lv->{'шт'};
						$all_mat["спот GX-53 ".$lv->{'цвет'}] += $lv->{"шт"};
						$all_mat["лампа светод. GX-53 ".$lv->{'свечение'}." ".$lv->{"мощность"}] += $lv->{"шт"};
						$all_mat['кольцо 90'] += $lv->{'шт'};
						$all_mat['подвес'] += $lv->{'шт'};
						$all_mat['платф. под спот 90'] += $lv->{'шт'};
						$all_mat['клемник'] += 2*$lv->{'шт'};
						$all_mat["провод ПВС 2х0.75"] += $lv->{'шт'};
					}
					break;
				case "споты клиента":
					foreach ($value as $lk => $lv){
						if(array_key_exists("кольцо ".$lk, $all_mat)){
							$all_mat["кольцо ".$lk] += $lv;
						}else{
							$all_mat["кольцо ".$lk] = $lv;
						}
						$all_data['установка спот встраив.'] += $lv;
						$all_mat['подвес'] += $lv;
						$all_mat['клемник'] += 2*$lv;
						$all_mat['платф. под спот унв.'] += $lv;
						$all_mat["провод ПВС 2х0.75"] += $lv;
					}
					break;
				case "обвод тр":
					foreach ($value as $lk => $lv){
						if(array_key_exists("обвод тр. ".$lk, $all_mat)){
							$all_mat["обвод тр. ".$lk] += $lv;
						}else{
							$all_mat["обвод тр. ".$lk] = $lv;
						}
					}

					break;

				case "вент":
					foreach ($value as $kvent => $ov) {				
						if($ov->{'принуд'}){
							$all_data['установка принуд. вентиляции'] += $ov->{'шт'};
							$all_mat['брус 45х45'] += $ov->{'шт'} * 0.5;
							$all_mat['подвес'] += $ov->{'шт'} *2;
							$all_mat["провод ПВС 2х0.75"] +=  $ov->{'шт'} *2;
							if(array_key_exists("кольцо ".$ov->{'диам'}, $all_mat)){
								$all_mat["кольцо ".$ov->{'диам'}] += $ov->{'шт'};
							}else{
								$all_mat["кольцо ".$ov->{'диам'}] = $ov->{'шт'};
							}
						}else{
							$all_data['установка решетка вент.'] += $ov->{'шт'};
							if(array_key_exists("решетка вент. ".$ov->{'диам'}, $all_mat)){
								$all_mat["решетка вент. ".$ov->{'диам'}] += $ov->{'шт'};
							}else{
								$all_mat["решетка вент. ".$ov->{'диам'}] = $ov->{'шт'};
							}
						}
					}
					break;

				case "гардина накладная":
					foreach ($value as $vrag) {
						$all_data['установка накл. гардины'] += $vrag->{'м.п'};
						$all_mat['брус 45х45'] += $vrag->{'м.п'} * 0.5;
						$all_mat['подвес'] += ceil($vrag->{'м.п'}); 
						$all_mat["ПВХ гардина 2-х рядная"] += $vrag->{'м.п'};
						if($vrag->{"с блендой"}){
							$all_mat["ПВХ блэнда"] += $vrag->{'м.п'};
						}
						if($vrag->{"с углами"}){
							$all_mat["ПВХ углы компл. 2шт"] += 1;
						}
					}
					break;
				case "гардина скрытая":
					foreach ($value as $vhid) {
						$all_data["установка гардины ".$vhid->{"тип"}] += $vhid->{"м.п"};
						$all_mat["кронштейн 100х125"] += ceil($vhid->{"м.п"} *2);
						if($vhid->{"тип"} == "ПК-5"){
							$all_mat["гардина ".$vhid->{"тип"}." белый"] += $vhid->{"м.п"};
						}elseif ($vhid->{"тип"} == "Lumfer UK") {
							$all_mat["гардина Lumfer UK ".$vhid->{"цвет"}] += $vhid->{"м.п"};
							if($vhid->{"обрыв"} != ""){
								$all_mat["торцевая заглюшка Lumfer UK ".$vhid->{"цвет"}] += $vhid->{"обрыв"};
							}
						}
					}
					break;
				case "световые линии":
					foreach ($value as $vsv) {
						$all_data["установка световой линии"] += $vsv->{'м.п'};
						$all_mat["профиль ".$vsv->{'тип профиля'}] += $vsv->{'м.п'};
						$all_mat["Светод. лента 24V 12W ".$vsv->{'тип ленты'}] += $vsv->{'м.п'}*$vsv->{'кол. лент'};
						$all_mat["кронштейн 100х125"] += ceil($vsv->{"м.п"} *2);
						$all_mat["рассеватель полик. ".$vsv->{"тип профиля"}." ".$vsv->{"тип рассеивателя"}] += $vsv->{'м.п'};
						if($vsv->{'обрыв'} != ""){
							$all_data["обрыв световой линии"] += $vsv->{'обрыв'};
							$all_mat["заглушка ".$vsv->{"тип профиля"}] += $vsv->{'обрыв'};

						}
						if($vsv->{"кол. блоков"} !=""){
							$all_data["установка блока питания"] += $vsv->{"кол. блоков"};
							$all_mat["блок питания ".$vsv->{'блок мощ.'}] += $vsv->{"кол. блоков"};
						}
					}
					break;
				case "парящий":
					foreach ($value as $flv) {
						$all_data['установка парящего профиля'] += $flv->{'м.п'};						
						$all_data["установка блока питания"] += $flv->{"кол. блоков"};
						$all_mat["блок питания ".$flv->{'блок мощ.'}] += $flv->{"кол. блоков"};
						$all_mat["парящий профиль ".$flv->{'тип профиля'}] += $flv->{'м.п'};
						$all_mat["Светод. лента 24V 12W ".$flv->{"тип ленты"}] += $flv->{"м.п"};
					}
					break;
				case "теневой":
					foreach ($value as $flv) {
						$all_data['установка теневого профиля '.$flv->{"тип профиля"}] += $flv->{'м.п'};
						$all_mat["профиль теневой ".$flv->{"тип профиля"}] += $flv->{'м.п'};
					}
					break;
			}
		}
	}

	$all_mat['багет пвх'] += ceil($all_data['общ. периметр'] / 2.5) * 2.5;
	$all_mat['маскировочная лента'] += ceil($all_data['общ. периметр']);

	function rollArr($arr, &$out){
		foreach ($arr as $key => $value) {
			if($value != 0){
				$out[$key] = $value;
			}
		}
	}
	rollArr($wall, $sum_wall);

	foreach ($sum_wall as $key => $value) {
		switch ($key) {
			case 'бетон':
				$all_mat['саморезы 41'] += ceil($value / 0.12);
				$all_mat['дупель 6х40'] += ceil($value / 0.12);
				break;
			
			case "гипс\карт":
				$all_mat['саморезы 41'] += ceil($value/0.06);
				break;
			case "гипс\блок":
				$all_mat['саморезы 41'] += ceil($value/0.06);
				break;
			case "дерево":
				$all_mat['саморезы 41'] += ceil($value/0.12);
				break;
			case "кирпич":
				$all_mat['саморезы 41'] += ceil($value / 0.12);
				$all_mat['дупель 6х40'] += ceil($value / 0.12);
				break;
			case "керамика":
				$all_mat['саморезы 41'] += ceil($value / 0.12);
				$all_mat['дупель 6х40'] += ceil($value / 0.12);
				if($value > 15){
					$all_mat['перо по кафелю'] += 1;
				}
				break;
			case 'гранит':
				$all_mat['клей титан'] += 1;
				break;
		}
	}



	rollArr($all_data, $sum_data);
	rollArr($all_mat, $sum_mat);


	$dict->sum_data = $sum_data;
	$dict->sum_mat = $sum_mat;
	$dict->sum_wall = $sum_wall;
	$dict->sum_polotna = $sum_polotna;


	$imgArr = [];

	for($i=0; $i<count($rooms); $i++){
		if(array_key_exists('фото', $rooms[$i])){
			$n_name = md5(microtime() . rand(0, 9999)).".jpg";
			$o = fopen("img_admin/img_zamer/".$n_name, 'wb');
			fwrite($o, base64_decode($rooms[$i]->{'фото'}));
			fclose($o);
			$rooms[$i]->{'фото'} = $n_name;
			$imgArr[] = $n_name;
		}
	}

	$id_event = $_POST['idEvent'];

	$id_client = $db->querySingle("SELECT ref_client FROM events WHERE id = $id_event");
	$id_obj = $db->querySingle("SELECT ref_obj FROM events WHERE id = $id_event");

	$q = "INSERT INTO zamer (ref_client, ref_obj, ref_event, created, json ";
	if(count($imgArr) > 0){
		$q = $q.", foto)";
	}else{
		$q = $q.")";
	}
	$time = time();
	$js = json_encode($dict, JSON_UNESCAPED_UNICODE);
	$q = $q." VALUES ($id_client, $id_obj, $id_event, $time, '$js'";
	if(count($imgArr) > 0){
		$q = $q.", '".json_encode($imgArr)."')";
	}else{
		$q = $q.")";
	}
	if(!$db->exec($q)){
		echo $db->lastErrorMsg();
		exit;
	}

	$id_zamer = $db->lastInsertRowID();
	$q = "UPDATE events SET ref_zamer = $id_zamer, status = 'выполнено' WHERE id = $id_event";

	if(!$db->exec($q)){
		echo $db->lastErrorMsg();
		exit;
	}

	$q = "UPDATE object SET status = 'замерено' WHERE id = $id_obj";

	if(!$db->exec($q)){
		echo $db->lastErrorMsg();
		exit;
	}

	echo "succes";
?>