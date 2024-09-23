
<div id="feedBackId" class="feedback_section">
	<div style="display: flex; justify-content: center;">
		<div class="vert_line"></div>
	</div>
	<div class="heder_present" style="position: relative; z-index: 2;">
		<h1>Настоящие отзывы</h1>
		<span>Убедитесь сами: настоящие отзывы от наших клиентов</span>
	</div>

	<div class="feedBackSortCont">
		<span>Сортировать по: </span>
		<div class="sortFeedbackFoto feedSortFotoActiv"><span>С фото</span></div>
		<div>
			<span>Дата:</span>
			<svg id="blue_copy" class="svg_sortdata_feedBack" version="1.1" viewBox="17 21 60 60" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<g id="Layer_4_copy">
					<path d="M31.356,25.677l38.625,22.3c1.557,0.899,1.557,3.147,0,4.046l-38.625,22.3c-1.557,0.899-3.504-0.225-3.504-2.023V27.7   C27.852,25.902,29.798,24.778,31.356,25.677z"/>
					<path d="M69.981,47.977l-38.625-22.3c-0.233-0.134-0.474-0.21-0.716-0.259l37.341,21.559c1.557,0.899,1.557,3.147,0,4.046   l-38.625,22.3c-0.349,0.201-0.716,0.288-1.078,0.301c0.656,0.938,1.961,1.343,3.078,0.699l38.625-22.3   C71.538,51.124,71.538,48.876,69.981,47.977z"/>
					<path d="M31.356,25.677l38.625,22.3c1.557,0.899,1.557,3.147,0,4.046   l-38.625,22.3c-1.557,0.899-3.504-0.225-3.504-2.023V27.7C27.852,25.902,29.798,24.778,31.356,25.677z" style="stroke-miterlimit:10;"/>
				</g>
			</svg>
		</div>
		<div>
			<span>Оценка:</span>
			<svg id="blue_copy" class="svg_sortdata_feedBack svg_sort_rotate_down" version="1.1" viewBox="17 21 60 60" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<g id="Layer_4_copy">
					<path d="M31.356,25.677l38.625,22.3c1.557,0.899,1.557,3.147,0,4.046l-38.625,22.3c-1.557,0.899-3.504-0.225-3.504-2.023V27.7   C27.852,25.902,29.798,24.778,31.356,25.677z"/>
					<path d="M69.981,47.977l-38.625-22.3c-0.233-0.134-0.474-0.21-0.716-0.259l37.341,21.559c1.557,0.899,1.557,3.147,0,4.046   l-38.625,22.3c-0.349,0.201-0.716,0.288-1.078,0.301c0.656,0.938,1.961,1.343,3.078,0.699l38.625-22.3   C71.538,51.124,71.538,48.876,69.981,47.977z"/>
					<path d="M31.356,25.677l38.625,22.3c1.557,0.899,1.557,3.147,0,4.046   l-38.625,22.3c-1.557,0.899-3.504-0.225-3.504-2.023V27.7C27.852,25.902,29.798,24.778,31.356,25.677z" style="stroke-miterlimit:10;"/>
				</g>
			</svg>
		</div>
	</div>
	<div id="feedBackContId" class="feed_main_cont">

		<?php
			$db = $GLOBALS['db'];
			$res = $db->query("SELECT * FROM feedBackClient WHERE foto_file_name_arr NOT NULL AND scope = 5");
			$scope5 = [];
			while($r = $res->fetchArray(SQLITE3_ASSOC)){
				$scope5[] = $r;
			}

			shuffle($scope5);

			$res = $db->query("SELECT * FROM feedBackClient WHERE foto_file_name_arr NOT NULL AND scope < 5 ORDER BY scope DESC");
			$a = [];
			while($r = $res->fetchArray(SQLITE3_ASSOC)){
				$a[] = $r;
			}

			$res = $db->query("SELECT * FROM feedBackClient WHERE foto_file_name_arr IS NULL ORDER BY scope DESC");
			$b = [];
			while($r = $res->fetchArray(SQLITE3_ASSOC)){
				$b[] = $r;
			}
			$backarr = array_slice($b, -6);
			array_splice($b, -6);
			$arr = array_merge($backarr,$scope5, $a, $b);

			$_SESSION['allComents'] = $arr;



			for($i=0; $i<15; $i++){
				if($i<5){
					echo "<div class='feedback_cont feedback_none'>";
				}
				if($i==5){
					echo "<div class='feedback_cont feedback_left'>";
				}
				if($i==6){
					echo "<div class='feedback_cont feedback_action'>";
				}
				if($i==7){
					echo "<div class='feedback_cont feedback_right'>";
				}
				if($i==8){
					echo "<div class='feedback_cont feedback_740'>";
				}
				if($i==9){
					echo "<div class='feedback_cont feedback_940'>";
				}						
				if($i>9){
					echo "<div class='feedback_cont feedback_none'>";
				}
					echo "<div class=feed_back_avatar>";
					if($arr[$i]['avatar_file_name']){
						$p = $GLOBALS['root_dir']."upload_img/avatars/400x400/".$arr[$i]['avatar_file_name'];
					}else{
						$p = $GLOBALS['root_dir']."img/empty_avatar.png";
					}
						echo "<img src=$p>";
					echo"</div>";
					echo "<div class=feedback_heder_color></div>";
					$n = $arr[$i]['name_client'];
					echo "<h3>$n</h3>";
					$p = $arr[$i]['text_review'];
					echo "<p>$p</p>";

					if($arr[$i]['foto_file_name_arr']){
						echo "<div class='feed4countWrapp'>";
						$js = json_decode($arr[$i]['foto_file_name_arr']);
						$rand = rand();
						for($j=0; $j<count($js); $j++){
								$dir = $GLOBALS['root_dir']."upload_img/foto_review/100x100/";
								$p = $dir.$js[$j];
								echo "<a data-fancybox='gallery".$rand."'"." href=".$GLOBALS['root_dir']."upload_img/foto_review/800x800/".$js[$j].">";					
								echo "<img src=$p>";
								echo "</a>";
						}
						echo "</div>";
					}

					echo "<div class='feedScopeDateCont'>";
						echo "<div class='scope_feedback'>";
							echo "<span>Оценка: </span>";
							echo "<div>";
							$scope = $arr[$i]['scope'];
								for($j=0; $j<5; $j++){
									if($scope > $j){
										$cls = "scope_svg_action";
									}else{
										$cls = null;
									}
									echo "<svg class='all_feed_back_svg' version='1.1' id='Layer_1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' x='0px' y='0px'
						 				viewBox='0 0 426.667 426.667' xml:space='preserve'>
												<polygon class='polygon_scope $cls' points='213.333,10.441 279.249,144.017 426.667,165.436 320,269.41 345.173,416.226 213.333,346.91 
													81.485,416.226 106.667,269.41 0,165.436 147.409,144.017 '/>
										</svg>";
								}
							echo "</div>";
						echo "</div>";
						$date = $arr[$i]['timestamp'];
						$date = date('d/m/y', $date)."г.";
						echo "<span>$date</span>";
					echo "</div>";

				echo "</div>";
			}
		?>

	</div>

	<div class="feedback_btns_contein">
		<div class="count_img_cont">
			<span><span>1</span> из <span><?php echo count($arr)?></span></span>
		</div>
		<div class="cont_left_right">				
			<div role="button" class="feed_left">
				<svg version="1.1" id="Capa_1" width="20px" style="transform: rotateZ(180deg);" height="20px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
					 viewBox="0 0 16.9 16.9" style="enable-background:new 0 0 16.9 16.9;" xml:space="preserve">
				<g>
					<path style="fill: white;"  d="M7.658,2.036c-0.781,0.779-0.781,2.047,0,2.828L9.244,6.45H2c-1.104,0-2,0.895-2,2
						c0,1.104,0.896,2,2,2h7.244l-1.586,1.586c-0.781,0.779-0.781,2.047,0,2.828c0.391,0.391,0.902,0.586,1.414,0.586
						c0.512,0,1.023-0.195,1.414-0.586L16.9,8.45l-6.414-6.414C9.705,1.255,8.439,1.255,7.658,2.036z"/>
				</g>
				</svg>
			</div>
			<div role="button" class="feed_right">
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

<div class="dopWrapFeedback">
	<div class="add_feedback_section">
		<div style="display: flex; justify-content: center; position: relative;">
			<div class="vert_line"></div>
		</div>
		<div class="heder_present" style="position: relative; z-index: 2; margin-bottom: unset;">
			<span>Оставить отзыв</span>
		</div>

		<form>
			<input type="text" name="name_client" placeholder="Ваше имя">
			<textarea type="text" name="feedback_text" placeholder="Отзыв"></textarea>
			<div>
				<div class="scope_cont">
					<span>Оценка: </span>
					<div>
						<svg class="feedback_scope_item" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
							 viewBox="0 0 426.667 426.667" xml:space="preserve">
						<polygon class="polygon_scope" points="213.333,10.441 279.249,144.017 426.667,165.436 320,269.41 345.173,416.226 213.333,346.91 
							81.485,416.226 106.667,269.41 0,165.436 147.409,144.017 "/>
						</svg>
						<svg class="feedback_scope_item" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
							 viewBox="0 0 426.667 426.667" xml:space="preserve">
						<polygon class="polygon_scope" points="213.333,10.441 279.249,144.017 426.667,165.436 320,269.41 345.173,416.226 213.333,346.91 
							81.485,416.226 106.667,269.41 0,165.436 147.409,144.017 "/>
						</svg>
						<svg class="feedback_scope_item" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
							 viewBox="0 0 426.667 426.667" xml:space="preserve">
						<polygon class="polygon_scope" points="213.333,10.441 279.249,144.017 426.667,165.436 320,269.41 345.173,416.226 213.333,346.91 
							81.485,416.226 106.667,269.41 0,165.436 147.409,144.017 "/>
						</svg>
						<svg class="feedback_scope_item" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
							 viewBox="0 0 426.667 426.667" xml:space="preserve">
						<polygon class="polygon_scope" points="213.333,10.441 279.249,144.017 426.667,165.436 320,269.41 345.173,416.226 213.333,346.91 
							81.485,416.226 106.667,269.41 0,165.436 147.409,144.017 "/>
						</svg>
						<svg class="feedback_scope_item" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
							 viewBox="0 0 426.667 426.667" xml:space="preserve">
						<polygon class="polygon_scope" points="213.333,10.441 279.249,144.017 426.667,165.436 320,269.41 345.173,416.226 213.333,346.91 
							81.485,416.226 106.667,269.41 0,165.436 147.409,144.017 "/>
				
						</svg>
					</div>
				</div>
				<div class="inputs_file_cont">				
					<label>Аватарка</label> 
					<input type="file" accept="image/*" name="image_avatar">
				</div>
				<div class="inputs_file_cont">					
					<label>Фотографии</label>
					<input type="file" accept="image/*" multiple="multiple" name="image_review">
				</div>		
			</div>
		</form>
		<div role="button" class="calc_btn">
			<div class="btn_animate"></div>
			<div class="call_me_load_anim display_none"></div>
			<div class="call_me_load_anim call_me_load_anim2 display_none"></div>
		Отправить</div>
	</div>
</div>

<div role="button" class="add_feedback_btn_open_cont">
	<div>
		<span>Оставить отзыв</span>
		<div></div>
	</div>
</div>