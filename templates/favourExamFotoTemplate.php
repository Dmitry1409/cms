<?php

$arr = [];

$id_img = $_SESSION['favourImg'];
	
$q = "SELECT * FROM imageObj WHERE id IN (";
for($i=0; $i<count($id_img); $i++){
	$q = $q.$id_img[$i];
	if(count($id_img) - 1 == $i){
		$q = $q.")";
	}else{
		$q = $q.',';
	}
}
$res = $GLOBALS['db']->query($q);

while ($r = $res->fetchArray(SQLITE3_ASSOC)){
	$arr[] = $r;
}



$hash = $GLOBALS['db']->query("SELECT * FROM hashTags");
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

?>
<div class="examle_flex">
	<div class="shell_price">
		<div class="example_img_cont">
			<?php
				for($i=0; $i<count($arr); $i++){
					if(count($arr) == 1){
						echo "<picture class='examp_action'>";
					}
					if(count($arr) > 1){
						if($i == 0){
							echo "<picture class='examp_action'>";
						}
						if($i == 1){
							echo "<picture class='examp_right'>";
						}
						if($i == 2){
							echo "<picture class='examp_right_940'>";
						}
						if($i > 2){
							echo "<picture class='examp_none'>";
						}
					}
						$webp = $arr[$i]['webp'];
						$jpg = $arr[$i]['jpg'];
						$id = $arr[$i]['id'];
						$p = $arr[$i]['prise'];
						$hashName = $arr[$i]['hashName'];
						$s_hash = "";
						echo "<div class='priseFoto'>$p руб.</div>";
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
		<div role="button" class="request_price_wrapp req_price_left req_price_left_action">
			<span>Отправить на расчет</span>
		</div>
	</div>
	
	<div class="examp_btns">
		<div role="button" class="img_like_cont">
			<svg height="30px" class="svg_like" style="enable-background:new 0 0 140 130;" version="1.1" viewBox="0 0 140 130" width="30px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
			<path d="M72.2,122.6C86.3,99.2,97,93.9,118.9,77.9c19.2-14.2,19.2-36.9,8.1-50.5C112.6,10.1,84,11.3,72.2,33.2  c-11.8-21.9-40.3-23.2-54.7-5.8C6.4,41,6.4,63.7,25.6,77.9C47.5,93.9,58.2,99.2,72.2,122.6L72.2,122.6L72.2,122.6z"/>
			</svg>
			<span>Убрать из<br>коллекции</span>
		</div>
		<div role="button" class="img_like_cont like_cont_940">
			<svg height="30px" class="svg_like" style="enable-background:new 0 0 140 130;" version="1.1" viewBox="0 0 140 130" width="30px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
			<path d="M72.2,122.6C86.3,99.2,97,93.9,118.9,77.9c19.2-14.2,19.2-36.9,8.1-50.5C112.6,10.1,84,11.3,72.2,33.2  c-11.8-21.9-40.3-23.2-54.7-5.8C6.4,41,6.4,63.7,25.6,77.9C47.5,93.9,58.2,99.2,72.2,122.6L72.2,122.6L72.2,122.6z"/>
			</svg>
			<span>Убрать из<br>коллекции</span>
		</div>
		<div class="cont_left_right">
			<div class="count_img_cont">
				<span><span>1</span> из <span><?php echo count($arr); ?></span></span>
			</div>
			<div class="btns_left_right fav_lft_btn">
				<svg version="1.1" id="Capa_1" width="20px"  height="20px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
					 viewBox="0 0 16.9 16.9" style="enable-background:new 0 0 16.9 16.9;" xml:space="preserve">
				<g>
					<path style="fill: white;"  d="M7.658,2.036c-0.781,0.779-0.781,2.047,0,2.828L9.244,6.45H2c-1.104,0-2,0.895-2,2
						c0,1.104,0.896,2,2,2h7.244l-1.586,1.586c-0.781,0.779-0.781,2.047,0,2.828c0.391,0.391,0.902,0.586,1.414,0.586
						c0.512,0,1.023-0.195,1.414-0.586L16.9,8.45l-6.414-6.414C9.705,1.255,8.439,1.255,7.658,2.036z"/>
				</g>
				</svg>
			</div>
			<div class="btns_left_right fav_rgt_btn">
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