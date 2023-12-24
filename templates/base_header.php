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
							<a class="menu_item" href=<?php echo $GLOBALS['root_dir'].$GLOBALS['listRout']['shadProf']?>>Парящие & Теневые & Подсветка</a>
							<a class="menu_item" href=<?php echo $GLOBALS['root_dir'].$GLOBALS['listRout']['multiLev']?> >Многоуровневые</a>
							<a class="menu_item" href=<?php echo $GLOBALS['root_dir'].$GLOBALS['listRout']['hidCur']?>>Ниши & Гардины</a>
							<a class="menu_item" href=<?php echo $GLOBALS['root_dir'].$GLOBALS['listRout']['textCol']?>>Фактура & Цвет</a>
							<a class="menu_item" href=<?php echo $GLOBALS['root_dir'].$GLOBALS['listRout']['dublVis']?>>Double Vision & Фотопечать</a>
							<a class="menu_item" href=<?php echo $GLOBALS['root_dir'].$GLOBALS['listRout']['carCell']?>>Резные</a>
							<a class="menu_item" href=<?php echo $GLOBALS['root_dir'].$GLOBALS['listRout']['ligNich']?>>Световые ниши</a>
							<a class="menu_item" href=<?php echo $GLOBALS['root_dir'].$GLOBALS['listRout']['starSky']?>>Звездное небо</a>
						</div>
					</div>
					<div class="line_butt"></div>
					<a class="menu_item" href=<?php echo $GLOBALS['root_dir'].$GLOBALS['listRout']['lighting']?>>Споты</a>			
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
			$yandGroup = ["5366403762"=>3, "5366403756"=>4, "5153947638"=>4, "5153947644"=>3];
			$pathArr = [["lighting", 2],["textureColor", 4], ["hiddenCurtain", 3]];
			$fl = false;

			//если есть группы яндекса директа выбираем банеры под него
			if(array_key_exists("idGroup", $_GET)){
				if(array_key_exists($_GET['idGroup'], $yandGroup)){
					$idRow = $yandGroup[$_GET['idGroup']];
					$fl = true;
				}
			}
			// если в пути содержится один из трех ваиантов выбираем банер под него
			if(!$fl){
				$uri = $_SERVER['REQUEST_URI'];
				for($i = 0; $i<count($pathArr); $i++){
					if(strpos($uri, $pathArr[$i][0]) or strpos($uri, $pathArr[$i][0]) === 0){
						$idRow = $pathArr[$i][1];
						break;
					}
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
	