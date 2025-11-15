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
							<a class="menu_item" href=<?php echo $GLOBALS['root_dir'].$GLOBALS['listRout']['simpleCeil']?>>Простой потолок</a>
							<a class="menu_item" href=<?php echo $GLOBALS['root_dir'].$GLOBALS['listRout']['hidCur']?>>Ниши & Гардины</a>
							<a class="menu_item" href=<?php echo $GLOBALS['root_dir'].$GLOBALS['listRout']['svetovoyPotolok']?>>Световой потолок</a>
							<a class="menu_item" href=<?php echo $GLOBALS['root_dir'].$GLOBALS['listRout']['textCol']?>>Фактура & Цвет</a>
							<a class="menu_item" href=<?php echo $GLOBALS['root_dir'].$GLOBALS['listRout']['dublVis']?>>Double Vision & Фотопечать</a>
							<a class="menu_item" href=<?php echo $GLOBALS['root_dir'].$GLOBALS['listRout']['carCell']?>>Резной</a>
							<a class="menu_item" href=<?php echo $GLOBALS['root_dir'].$GLOBALS['listRout']['multiLev']?> >Многоуровневый</a>
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
	<div class='messenger_layout'>
		<a href="https://t.me/79965673762" class="m_l_row">
			<span>Написать в</span>
			<svg width="35" height="35" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M24 48C37.2548 48 48 37.2548 48 24C48 10.7452 37.2548 0 24 0C10.7452 0 0 10.7452 0 24C0 37.2548 10.7452 48 24 48Z" fill="url(#paint0_linear)"/>
				<path d="M8.93822 25.174C11.7438 23.6286 14.8756 22.3388 17.8018 21.0424C22.836 18.919 27.8902 16.8324 32.9954 14.8898C33.9887 14.5588 35.7734 14.2351 35.9484 15.7071C35.8526 17.7907 35.4584 19.8621 35.188 21.9335C34.5017 26.4887 33.7085 31.0283 32.935 35.5685C32.6685 37.0808 30.774 37.8637 29.5618 36.8959C26.6486 34.9281 23.713 32.9795 20.837 30.9661C19.8949 30.0088 20.7685 28.6341 21.6099 27.9505C24.0093 25.5859 26.5539 23.5769 28.8279 21.0901C29.4413 19.6088 27.6289 20.8572 27.0311 21.2397C23.7463 23.5033 20.5419 25.9051 17.0787 27.8945C15.3097 28.8683 13.2479 28.0361 11.4797 27.4927C9.89428 26.8363 7.57106 26.175 8.93806 25.1741L8.93822 25.174Z" fill="white"/>
				<defs>
					<linearGradient id="paint0_linear" x1="18.0028" y1="2.0016" x2="6.0028" y2="30" gradientUnits="userSpaceOnUse">
					<stop stop-color="#37AEE2"/>
					<stop offset="1" stop-color="#1E96C8"/>
					</linearGradient>
				</defs>
			</svg>
		</a>
		<a href="whatsapp://send?phone=79965673762" class="m_l_row">
			<span>Написать в</span>
			<svg height="35" style="isolation:isolate" viewBox="-4480 -384 512 512" width="35" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<g><linearGradient gradientTransform="matrix(512,0,0,512,-4480,-384)" gradientUnits="userSpaceOnUse" id="_lgradient_2" x1="0" x2="1" y1="0.5" y2="0.5"><stop offset="1.7391304347826086%" stop-opacity="1" style="stop-color:rgb(164,251,150)"/><stop offset="47.82608695652174%" stop-opacity="1" style="stop-color:rgb(127,217,113)"/><stop offset="98.26086956521739%" stop-opacity="1" style="stop-color:rgb(99,181,86)"/></linearGradient><path d=" M -4334.08 -384 L -4113.92 -384 C -4033.3846 -384 -3968 -318.6154 -3968 -238.08 L -3968 -17.92 C -3968 62.6154 -4033.3846 128 -4113.92 128 L -4334.08 128 C -4414.6154 128 -4480 62.6154 -4480 -17.92 L -4480 -238.08 C -4480 -318.6154 -4414.6154 -384 -4334.08 -384 Z " fill="url(#_lgradient_2)"/><linearGradient gradientTransform="matrix(275,0,0,275.0006,-4361.5,-265.5003)" gradientUnits="userSpaceOnUse" id="_lgradient_3" x1="0" x2="1" y1="0.5" y2="0.5"><stop offset="0%" stop-opacity="1" style="stop-color:rgb(255,255,255)"/><stop offset="100%" stop-opacity="1" style="stop-color:rgb(230,229,229)"/></linearGradient><path d=" M -4147.8708 -51.8705 C -4168.2056 -31.5356 -4195.2424 -20.3369 -4223.9998 -20.3369 C -4240.8384 -20.3369 -4256.9596 -24.1149 -4271.9172 -31.5655 L -4271.9172 -31.5655 C -4277.2541 -34.2241 -4286.8191 -35.1429 -4293.2637 -33.616 L -4306.6431 -30.4461 C -4316.3099 -28.1557 -4322.5309 -34.196 -4320.5265 -43.9261 L -4317.6184 -58.0432 C -4316.2821 -64.53 -4317.3318 -73.9766 -4319.9611 -79.1254 L -4319.9611 -79.1254 C -4327.726 -94.3323 -4331.6631 -110.7764 -4331.6631 -128.0002 C -4331.6631 -156.7583 -4320.4644 -183.7945 -4300.1296 -204.13 C -4279.9764 -224.2831 -4252.4987 -235.6642 -4223.9979 -235.6642 C -4195.2404 -235.6635 -4168.2049 -224.4648 -4147.8701 -204.1306 C -4127.5352 -183.7958 -4116.3365 -156.7596 -4116.3358 -128.0022 C -4116.3365 -99.5007 -4127.7176 -72.0229 -4147.8708 -51.8705 L -4147.8708 -51.8705 Z  M -4230.7224 -265.3399 C -4303.9414 -261.8537 -4361.7215 -200.8764 -4361.4994 -127.5745 C -4361.4317 -105.2486 -4356.0419 -84.1758 -4348.353 -69.1187 C -4347.349 -67.1526 -4346.6087 -63.7655 -4346.701 -61.5598 L -4348.4253 -20.3369 C -4348.4253 -8.6298 -4344.6753 -0.6298 -4331.6631 -0.6298 L -4292.1922 -4.2235 C -4288.3448 -4.5738 -4282.4135 -3.4597 -4278.9554 -1.7371 C -4267.382 4.0279 -4247.3448 9.1605 -4226.1388 9.4841 C -4151.302 10.6271 -4088.9012 -48.7953 -4086.5686 -123.6042 C -4084.0683 -203.7945 -4150.2517 -269.1723 -4230.7224 -265.3399 L -4230.7224 -265.3399 Z  M -4157.2687 -98.1813 L -4183.9024 -105.8288 C -4187.4039 -106.8339 -4191.1747 -105.8407 -4193.726 -103.2409 L -4200.239 -96.6052 C -4202.9854 -93.8072 -4207.1526 -92.9081 -4210.7874 -94.3787 C -4223.3865 -99.4775 -4249.8896 -123.042 -4256.6579 -134.8289 C -4258.6106 -138.229 -4258.2877 -142.4797 -4255.8902 -145.5821 L -4250.2039 -152.9385 C -4247.976 -155.8208 -4247.506 -159.6916 -4248.9793 -163.0234 L -4260.1846 -188.3668 C -4262.8687 -194.437 -4270.6256 -196.204 -4275.6932 -191.9181 C -4283.1265 -185.6311 -4291.9463 -176.0773 -4293.0185 -165.4932 C -4294.9088 -146.8326 -4286.9059 -123.3092 -4256.6427 -95.0636 C -4221.6805 -62.4321 -4193.6829 -58.121 -4175.4539 -62.5368 C -4165.1144 -65.0411 -4156.8517 -75.0809 -4151.6368 -83.3013 C -4148.0816 -88.906 -4150.8889 -96.3493 -4157.2687 -98.1813 Z " fill="url(#_lgradient_3)" fill-rule="evenodd"/>
				</g>
			</svg>
		</a>

	</div>

	<div role="main" id="main_section_id">
	