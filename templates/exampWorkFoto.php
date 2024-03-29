<div id=exampWork style="display: flex; justify-content: center; margin-top: 50px;">
	<div class="vert_line"></div>
</div>
<div class="heder_present" style="position: relative; z-index: 2;">
	<h1>Примеры работ</h1>
</div>

<?php
	$arr = [];
	$db = $GLOBALS['db'];
	if($query != "все"){
		$a = [];
		$id_img = $db->query($query);
		while($r = $id_img->fetchArray(SQLITE3_ASSOC)){
			$a[] = $r['id_img'];
		}
		$res = [];
		for($i=0; $i<count($a); $i++){
			$w = json_decode($a[$i]);
			for($j=0; $j<count($w); $j++){
				$res[] = $w[$j];
			}
		}
		$q = "SELECT * FROM imageObj WHERE id IN (";
		for($i=0; $i<count($res); $i++){
			$q = $q.$res[$i];
			if(count($res) - 1 == $i){
				$q = $q.")";
			}else{
				$q = $q.',';
			}
		}
	}else{
		$q = "SELECT * FROM imageObj";
	}

	$res = $db->query($q);

	while ($r = $res->fetchArray(SQLITE3_ASSOC)){
		$arr[] = $r;
	}


	$hash = $db->query("SELECT * FROM hashTags");
	$ar_hash = [];
	while($r = $hash->fetchArray(SQLITE3_ASSOC)){
		$ar_hash[$r['id']] = $r['name'];
	}
	// Добавляем имена хештегов в массив
	for($i=0; $i<count($arr); $i++){
		$jhash = json_decode($arr[$i]['hashTag_id']);
		for($j=0; $j<count($jhash); $j++){
			if(!array_key_exists("hashName", $arr[$i])){
				$arr[$i]['hashName'] = [];
			}
			$arr[$i]["hashName"][] = "#".$ar_hash[$jhash[$j]];
		}
	}


	shuffle($arr);

	$_SESSION["fotoWorkExamp"] = $arr;



	$hashTagName = [];
	$res = $db->query("SELECT name FROM hashTags");
	while($r = $res->fetchArray(SQLITE3_ASSOC)){
		$hashTagName[] = "#".$r["name"];
	}

?>

<div class="controlHashTagCont">
	<?php
		if($hashsSelect[0] == "#все"){
			echo "<div class='controlHashItem hashContrActiv'>#все</div>";
		}else{
			echo "<div class='controlHashItem'>#все</div>";
		}

		$fl = false;
		for($i=0; $i<count($hashTagName); $i++){
			for($j=0; $j<count($hashsSelect); $j++){
				if($hashsSelect[$j] == $hashTagName[$i]){
					echo "<div class='controlHashItem hashContrActiv'>".$hashTagName[$i]."</div>";
					$fl = true;
					break;
				}
			}
			if($fl){
				$fl = false;
				continue;
			}
			echo "<div class='controlHashItem'>".$hashTagName[$i]."</div>";
		}
	?>
</div>

<div class="examle_flex">
	<div class="shell_price">
		<div class="example_img_cont">
			<?php
				for($i = 0; $i<12; $i++){
					$webp = $GLOBALS['root_dir'].$arr[$i]['webp'];
					$jpg = $GLOBALS['root_dir'].$arr[$i]['jpg'];
					if($i < 3){
						echo "<picture class='examp_none'>";
					}
					if($i == 3){
						echo "<picture class='examp_left'>";
					}
					if($i == 4){
						echo "<picture class='examp_action'>";
					}
					if($i == 5){
						echo "<picture class='examp_right'>";
					}
					if($i == 6){
						echo "<picture class='examp_right_940'>";
					}
					if($i > 6){
						echo "<picture class='examp_none'>";
					}
					
					$priseFoto = $arr[$i]['prise'] . " руб.";
					// echo "<div class ='priseFoto'>$priseFoto</div>";

					$s_hash = "";
					echo "<div class='hashNameCont'>";
						for($j=0; $j<count($arr[$i]['hashName']); $j++){
							$val = $arr[$i]['hashName'][$j];
							$s_hash = $s_hash.$val." ";
							echo "<div>";
							echo "<span class='hashItem'>$val</span>";
							echo "</div>";
						}
					echo"</div>";
					echo "<source srcset=$webp type=image/webp>";
					$id = $arr[$i]['id'];
					echo "<img data-foto-id=$id src=$jpg alt='$s_hash'>";
					echo "</picture>";
				}
				
			?>
		</div>
		<div class="close_btn_examp">
			<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
				 width="20px" height="20px" viewBox="0 0 612.043 612.043" style="enable-background:new 0 0 612.043 612.043;"
				 xml:space="preserve" fill="white">
			<g id="cross">
				<path d="M397.503,306.011l195.577-195.577c25.27-25.269,25.27-66.213,0-91.482c-25.269-25.269-66.213-25.269-91.481,0
					L306.022,214.551L110.445,18.974c-25.269-25.269-66.213-25.269-91.482,0s-25.269,66.213,0,91.482L214.54,306.033L18.963,501.61
					c-25.269,25.269-25.269,66.213,0,91.481c25.269,25.27,66.213,25.27,91.482,0l195.577-195.576l195.577,195.576
					c25.269,25.27,66.213,25.27,91.481,0c25.27-25.269,25.27-66.213,0-91.481L397.503,306.011z"/>
			</g>
			</svg>
		</div>
		<div class="request_price_wrapp req_price_left">
			<span>Сколько стоит такой</span>
		</div>
		<div class="request_price_wrapp req_price_right">
			<span>Сколько стоит такой</span>
		</div>
	</div>
	
	<div class="examp_btns">
		<div role="button" class="img_like_cont">
			<svg height="30px" class="svg_like" style="enable-background:new 0 0 140 130;" version="1.1" viewBox="0 0 140 130" width="30px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
			<path d="M72.2,122.6C86.3,99.2,97,93.9,118.9,77.9c19.2-14.2,19.2-36.9,8.1-50.5C112.6,10.1,84,11.3,72.2,33.2  c-11.8-21.9-40.3-23.2-54.7-5.8C6.4,41,6.4,63.7,25.6,77.9C47.5,93.9,58.2,99.2,72.2,122.6L72.2,122.6L72.2,122.6z"/>
			</svg>
			<span>Добавить <br> в избранное</span>
		</div>
		<div role="button" class="img_like_cont like_cont_940">
			<svg height="30px" class="svg_like" style="enable-background:new 0 0 140 130;" version="1.1" viewBox="0 0 140 130" width="30px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
			<path d="M72.2,122.6C86.3,99.2,97,93.9,118.9,77.9c19.2-14.2,19.2-36.9,8.1-50.5C112.6,10.1,84,11.3,72.2,33.2  c-11.8-21.9-40.3-23.2-54.7-5.8C6.4,41,6.4,63.7,25.6,77.9C47.5,93.9,58.2,99.2,72.2,122.6L72.2,122.6L72.2,122.6z"/>
			</svg>
			<span>Добавить <br> в избранное</span>
		</div>
		<div class="cont_left_right">
			<span class="chechAutoCont">
				<input type="checkbox" checked>
				<span>авто</span>
			</span>
			<div class="count_img_cont">
				<span><span>1</span> из <span><?php echo count($arr); ?></span></span>
			</div>
			<div role="button" class="btns_left_right examp_btn_left">
				<svg version="1.1" id="Capa_1" width="20px"  height="20px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
					 viewBox="0 0 16.9 16.9" style="enable-background:new 0 0 16.9 16.9;" xml:space="preserve">
				<g>
					<path style="fill: white;"  d="M7.658,2.036c-0.781,0.779-0.781,2.047,0,2.828L9.244,6.45H2c-1.104,0-2,0.895-2,2
						c0,1.104,0.896,2,2,2h7.244l-1.586,1.586c-0.781,0.779-0.781,2.047,0,2.828c0.391,0.391,0.902,0.586,1.414,0.586
						c0.512,0,1.023-0.195,1.414-0.586L16.9,8.45l-6.414-6.414C9.705,1.255,8.439,1.255,7.658,2.036z"/>
				</g>
				</svg>
			</div>
			<div role="button" class="btns_left_right examp_btn_right">
				<svg version="1.1" id="Capa_1" width="20px" height="20px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
					 viewBox="0 0 16.9 16.9" style="enable-background:new 0 0 16.9 16.9;" xml:space="preserve">
				<g>
					<path style="fill: white;"  d="M7.658,2.036c-0.781,0.779-0.781,2.047,0,2.828L9.244,6.45H2c-1.104,0-2,0.895-2,2
						c0,1.104,0.896,2,2,2h7.244l-1.586,1.586c-0.781,0.779-0.781,2.047,0,2.828c0.391,0.391,0.902,0.586,1.414,0.586
						c0.512,0,1.023-0.195,1.414-0.586L16.9,8.45l-6.414-6.414C9.705,1.255,8.439,1.255,7.658,2.036z"/>
				</g>
				</svg>
			</div>
		</div>
	</div>
</div>