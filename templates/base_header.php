<body>
	<div class="background_menu"></div>
	<div class="modal_call_me">
		<div class="modal_backgraund"></div>
		<div class="call_me_cont">
			<div class="close_modal">&#10006;</div>
			<form>
				<label>Оставить заявку</label>
				<label>*наш менеджер свяжется с вами в ближайшее время</label>
				<input type="text" name="call_me_name" placeholder="Ваше имя">
				<input type="text" name="call_me_phone" placeholder="Телефон">
				<div class="call_me_checkbox">
					<input checked type="checkbox">
					<span>Ознакомлен с <a href="#">ползовательским соглашением</a></span>
				</div>
			</form>
			<div role="button" class="call_me_btn_cont">
				<div class="call_me_send">
					<div class="btn_animate"></div>
					<div class="display_none call_me_load_anim"></div>
					<div class="display_none call_me_load_anim call_me_load_anim2"></div>
				Отправить</div>
			</div>
		</div>
	</div>
	<div class="modal_report">
		<div class="report_box">
			<h2>Ваше сообщение доставлено!</h2>
			<p>с вами свяжутся в течении не более 30 минут в рабочее время.</p>
			<div class="calc_btn"><div class="btn_animate"></div>Ок</div>
		</div>
	</div>
	<div class="menu_btn">
		<div class="btn_line"></div>
		<div class="btn_line"></div>
		<div class="btn_line"></div>
	</div>
	<div role="button" class="virt_btn_menu">
	</div>
	<div role="banner" class="header_wrapp">
		<div class="backgrWrappHeader">
			<div class="cap_container header_padding">
				<div class="combo_header">
					<a class="logo_header" href=<?php echo $GLOBALS['root_dir']?>>
						<img src=<?php echo $GLOBALS['root_dir']."img/0001-0250.gif"?>>
					</a>
					<div class="name_company">
						<a href=<?php echo $GLOBALS['root_dir']?>><?php echo $GLOBALS['COMPANY_NAME']?></a>
						<span>Производство и установка натяжных потолков</span>
					</div>
				</div>
				<div class="header_kont_call">
					<div class="call_me_container">
						<span>Заказать звонок</span>
						<svg version="1.1" xmlns="http://www.w3.org/2000/svg"
							 width="20px" fill="rgb(255 255 255/90%)" viewBox="0 0 485.227 485.227" xml:space="preserve">
							<path d="M438.3,443.723l-32.161,32.165c-5.745,5.713-22.561,9.325-23.069,9.325c-101.816,0.858-199.839-39.124-271.88-111.175
								C38.943,301.806-1.082,203.396,0.031,101.285c0-0.061,3.687-16.407,9.418-22.094L41.61,46.998
								c11.803-11.784,34.399-17.116,50.227-11.845l6.781,2.28c15.831,5.273,32.371,22.745,36.753,38.825l16.202,59.44
								c4.396,16.108-1.515,39.031-13.299,50.82l-21.501,21.499c21.085,78.154,82.376,139.424,160.484,160.543l21.501-21.497
								c11.789-11.789,34.77-17.684,50.876-13.296l59.439,16.228c16.051,4.354,33.524,20.871,38.826,36.72l2.254,6.781
								C455.419,409.336,450.089,431.938,438.3,443.723z M485.218,64.327L420.887,0L316.583,104.307l-43.65-43.656V212.28h151.629
								l-43.651-43.651L485.218,64.327z"/>
						</svg>
					</div>
					<div class="cont_tel_call">
						<div class="container_tel">
							<div class="tel-rel">
								<?php
									if(!array_key_exists('maskTelClick', $_SESSION)){
										echo '<div class="mask-tel">
												<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="rgba(255, 255,255, 0.8)" x="0px" y="0px"
													 width="60%" height="60%" viewBox="0 0 535.5 535.5" style="enable-background:new 0 0 535.5 535.5;" xml:space="preserve"
													>
													<g>
														<path d="M162.9,198.9v-22.95c-22.95-15.3-38.25-42.075-38.25-70.763c0-47.812,38.25-86.062,86.062-86.062
															c47.812,0,86.062,38.25,86.062,86.062c0,17.212-5.737,34.425-15.3,47.812c1.913,0,3.825,0,5.737,0c5.738,0,11.476,0,15.301,1.913
															c7.649-15.3,13.387-32.513,13.387-49.725C315.9,47.812,268.087,0,210.713,0c-57.375,0-105.188,47.812-105.188,105.188
															C105.525,145.35,128.475,181.688,162.9,198.9z"/>
														<path d="M277.65,105.188c0-36.337-30.6-66.938-66.937-66.938s-66.938,30.6-66.938,66.938c0,19.125,7.65,34.425,19.125,45.9v-45.9
															c0-26.775,21.038-47.812,47.812-47.812s47.812,21.038,47.812,47.812v45.9C270,139.612,277.65,124.312,277.65,105.188z"/>
														<path d="M440.212,210.375c-15.3,0-28.688,13.388-28.688,28.688v42.075v5.737H392.4v-43.987v-22.95
															c0-15.3-13.387-28.688-28.688-28.688c-15.3,0-28.688,13.388-28.688,28.688v19.125v28.688H315.9v-28.688v-38.25
															c0-15.3-13.387-28.688-28.688-28.688c-15.3,0-28.688,13.388-28.688,28.688v36.337v49.725H239.4v-47.812V105.188
															c0-15.3-13.388-28.688-28.688-28.688c-15.3,0-28.688,13.388-28.688,28.688v196.987c-40.163-42.075-91.8-87.975-112.837-66.938
															C48.15,256.275,103.613,313.65,178.2,439.875c34.425,57.375,76.5,95.625,149.175,95.625c78.412,0,143.438-65.025,143.438-143.438
															V328.95v-89.888C468.9,223.763,455.513,210.375,440.212,210.375z"/>
													</g>
												</svg>
											</div>';
									}
								?>							
								<a href='<?php echo "tel:".$GLOBALS["comp_telef1"]?>'><?php echo $GLOBALS['comp_telef1']?></a>
								<a href='<?php echo "tel:".$GLOBALS["comp_telef2"]?>'><?php echo $GLOBALS['comp_telef2']?></a>
							</div>
							<span><?php echo $_SESSION['cityHeader'];?></span>
						</div>
					</div>
				</div>
			</div>
			<div class="container_menu">
				<div role ="navigation" class="menu_flex_wrap">
					<a class="menu_item" href=<?php echo $GLOBALS['root_dir']?>>Главная</a>
					<div class="line_butt"></div>
					<div class="cont_940">
						<div class="menu_item sub_menu_btn"><span>Технологии</span><span></span></div>
						<div role="menu" class="sub_menu">
							<a class="menu_item" href=<?php echo $GLOBALS['root_dir'].$GLOBALS['listRout']['svetLine']?>>Световые линии</a>
							<a class="menu_item" href=<?php echo $GLOBALS['root_dir'].$GLOBALS['listRout']['tenevoy']?>>Теневой</a>
							<a class="menu_item" href=<?php echo $GLOBALS['root_dir'].$GLOBALS['listRout']['shadProf']?>>Парящий & Подсветка</a>
							<a class="menu_item" href=<?php echo $GLOBALS['root_dir'].$GLOBALS['listRout']['multiLev']?> >Многоуровневый</a>
							<a class="menu_item" href=<?php echo $GLOBALS['root_dir'].$GLOBALS['listRout']['hidCur']?>>Ниши & Гардины</a>
							<a class="menu_item" href=<?php echo $GLOBALS['root_dir'].$GLOBALS['listRout']['simpleCeil']?>>Простой потолок</a>
							<a class="menu_item" href=<?php echo $GLOBALS['root_dir'].$GLOBALS['listRout']['textCol']?>>Фактура & Цвет</a>
							<a class="menu_item" href=<?php echo $GLOBALS['root_dir'].$GLOBALS['listRout']['dublVis']?>>Double Vision & Фотопечать</a>
							<a class="menu_item" href=<?php echo $GLOBALS['root_dir'].$GLOBALS['listRout']['carCell']?>>Резной</a>
							<a class="menu_item" href=<?php echo $GLOBALS['root_dir'].$GLOBALS['listRout']['ligNich']?>>Световые ниши</a>
							<a class="menu_item" href=<?php echo $GLOBALS['root_dir'].$GLOBALS['listRout']['starSky']?>>Звездное небо</a>
						</div>
					</div>
					<div class="line_butt"></div>
					<a class="menu_item" href=<?php echo $GLOBALS['root_dir'].$GLOBALS['listRout']['lighting']?>>Свето-техника</a>			
					<div class="line_butt"></div>
					<div class="cont_940">
						<div class="menu_item sub_menu_btn"><span>Производители ПВХ</span><span></span></div>
						<div role="menu" class="sub_menu">
							<a class="menu_item" href=<?php echo $GLOBALS['root_dir'].$GLOBALS['listRout']['MSD']?>>MSD</a>
							<a class="menu_item" href=<?php echo $GLOBALS['root_dir'].$GLOBALS['listRout']['BAUF']?> >BAUF</a>
							<a class="menu_item" href=<?php echo $GLOBALS['root_dir'].$GLOBALS['listRout']['Pongs']?>>Pongs</a>
							<a class="menu_item" href=<?php echo $GLOBALS['root_dir'].$GLOBALS['listRout']['Teqtum']?>>Teqtum</a>
						</div>
					</div>	
					<div class="line_butt"></div>
					<div id="expressCalcBtnId" class="menu_item">Экспресс расчет</div>
					<div class="line_butt"></div>
					<div id="feedBackBtnId"  class="menu_item">Отзывы</div>
					<div class="line_butt"></div>
					<div id="workExampBtnId"  class="menu_item">Примеры работ</div>
					<div class="line_butt"></div>
					<div id="questAnswerBtnId" class="menu_item">Ответы на вопросы</div>
					<div class="line_butt"></div>
					<?php
						if(array_key_exists("favourImg", $_SESSION) or array_key_exists('buyProducts', $_SESSION)){
							$c = null;
							if(array_key_exists("favourImg", $_SESSION)){
								$c = count($_SESSION['favourImg']);
							}
							if(array_key_exists("buyProducts", $_SESSION)){
								$c = $c + count($_SESSION['buyProducts']);
							}
							echo "<a class='menu_item favourIndex' href=".$GLOBALS['root_dir'].$GLOBALS['listRout']['favourites'].">Избранное<span class='favour_count_menu'>$c</span></a>";
						}else{
							echo "<a class='menu_item favourIndex' href=".$GLOBALS['root_dir'].$GLOBALS['listRout']['favourites'].">Избранное<span></span></a>";
						}
					?>
					<div class="line_butt"></div>
					<div id="kontaktBtnId"  class="menu_item">Контакты</div>

					
				</div>
			</div>
		</div>
		<?php
			$idRow = 1;
			$pathArr = [["lighting", 2],["textureColor", 4], ["hiddenCurtain", 3]];

			// если в пути содержится один из трех ваиантов выбираем банер под него
			$uri = $_SERVER['REQUEST_URI'];
			for($i = 0; $i<count($pathArr); $i++){
				if(strpos($uri, $pathArr[$i][0]) or strpos($uri, $pathArr[$i][0]) === 0){
					$idRow = $pathArr[$i][1];
					break;
				}
			}

			$a = $GLOBALS['db']->query("SELECT * FROM headerBanner WHERE id = $idRow")->fetchArray(SQLITE3_ASSOC);

		?>

		<div class="header_lozung">
			<div class="header_title_wrapp">
				<span class="textBanner">				
					<span class="banner_active"><?php echo $a["mainText"]?></span>
					<span class="banner_opac_z"></span>
				</span>
				<span class="textBanner">
					<span class="banner_active"><?php echo $a['secText']?></span>
					<span class="banner_dis_none banner_opac_z"></span>
				</span>
				<a class="header_padding" role="button"><div class="btn_animate"></div>Оставить заявку</a>
			</div>
			<div class="header_gradient"></div>
			<div class="headerControlCont">
				<div class="headerContrlItem letfButBan">
					<div></div>
				</div>
				<div class="bannPoint"></div>
				<div class="headerContrlItem rightButBan">
					<div></div>
				</div>
			</div>
			<?php
				$id = $a['id'];
				$m = $a['mainText'];
				$t2 = $a['secText'];
				$jp = $GLOBALS['root_dir']."img/rekHeader/jpg/".$a["imgSrc"];
				$w = explode(".", $a["imgSrc"])[0].".webp";
				$w = $GLOBALS['root_dir']."img/rekHeader/webp/".$w;
				echo "<picture class='headerPicture banner_active' idRow=$id maintext='$m' sectext='$t2'>";
					echo "<source srcset='$w' type='image/webp'/>";
					echo "<img src=$jp>";
				echo "</picture>";
			?>

			
		</div>

		<div class="svg_triangle">
			<svg width="100%" height="100%" viewBox="0 0 100 50" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
			  <path fill="white" d="M0 0 L 100 50 L 0 50 Z"/>
			</svg>
		</div>
	</div>

	<div role="main" id="main_section_id">
	