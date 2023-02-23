
<body>
	<div class="background_menu"></div>
	<div class="modal_call_me">
		<div class="modal_backgraund"></div>
		<div class="call_me_cont">
			<div class="close_modal">&#10006;</div>
			<form>
				<label>Перезвоните мне</label>
				<input type="text" name="call_me_name" placeholder="Ваше имя">
				<input type="text" name="call_me_phone" placeholder="Телефон">
				<div class="call_me_checkbox">
					<input type="checkbox">
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
			<p>с вами свяжутся в течении не более 30 минут.</p>
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
		<div class="cap_container">
			<div class="combo_header">
				<a class="logo_header" href=<?php echo $root_dir?>>
					<img src=<?php echo $root_dir."img/0001-0250.gif"?>>
				</a>
				<div class="name_company">
					<a href=<?php echo $root_dir?>><?php echo $COMPANY_NAME?></a>
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
					<div class="svg_icon">
						<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
							 width="20.001px" fill="white" height="20.001px" viewBox="0 0 512.001 512.001"
							 xml:space="preserve">
							<path d="M462.491,468.206l-33.938,33.937c-6.062,6.031-23.812,9.844-24.343,9.844c-107.435,0.905-210.869-41.279-286.882-117.31
								C41.097,318.46-1.136,214.619,0.036,106.872c0-0.063,3.891-17.312,9.938-23.312l33.937-33.968
								c12.453-12.437,36.295-18.062,52.998-12.5l7.156,2.406c16.703,5.562,34.155,23.999,38.78,40.967l17.093,62.717
								c4.64,17-1.594,41.186-14.031,53.623l-22.687,22.687c22.25,82.467,86.919,147.121,169.339,169.402l22.687-22.688
								c12.438-12.438,36.687-18.656,53.687-14.031l62.718,17.125c16.937,4.594,35.374,22.03,40.968,38.748l2.375,7.156
								C480.552,431.926,474.928,455.769,462.491,468.206z M287.996,255.993h31.999c0-35.343-28.655-63.998-63.998-63.998v31.999
								C273.636,223.994,287.996,238.368,287.996,255.993z M415.992,255.993c0-88.373-71.623-159.996-159.995-159.996v32
								c70.591,0,127.996,57.436,127.996,127.996H415.992z M255.997,0v31.999c123.496,0,223.993,100.497,223.993,223.994h31.999
								C511.989,114.622,397.368,0,255.997,0z"/>
						</svg>
					</div>
					<div class="container_tel">
						<div class="tel-rel">							
							<a href='<?php echo "tel:$comp_telef1"?>'><?php echo $comp_telef1?></a>
							<a href='<?php echo "tel:$comp_telef2"?>'><?php echo $comp_telef2?></a>
						</div>
						<span>Нижний Новгород и обл.</span>
					</div>
				</div>
			</div>
		</div>
		<div class="container_menu">
			<div role ="navigation" class="menu_flex_wrap">
				<a class="menu_item" href=<?php echo $root_dir?> >Главная</a>
				<div class="line_butt"></div>
				<div class="cont_940">
					<div class="menu_item sub_menu_btn"><span>Технологии</span><span></span></div>
					<div role="menu" class="sub_menu">
						<a class="menu_item" href=<?php echo $root_dir."technology/lightLines"?>>Световые линии</a>
						<a class="menu_item" href=<?php echo $root_dir."technology/shadowProfil"?>>Парящие & Теневые & Подсветка</a>
						<a class="menu_item" href=<?php echo $root_dir."technology/multiLevel"?> >Многоуровневые</a>
						<a class="menu_item" href=<?php echo $root_dir."technology/hiddenCurtain"?>>Ниши & Гардины</a>
						<a class="menu_item" href=<?php echo $root_dir."technology/textureColor"?>>Фактура & Цвет</a>
						<a class="menu_item" href=<?php echo $root_dir."technology/dubleVisionPrint"?>>Double Vision & Фотопечать</a>
						<a class="menu_item" href=<?php echo $root_dir."technology/carvedCelling"?>>Резные</a>
						<a class="menu_item" href=<?php echo $root_dir."technology/ligthNiches"?>>Световые ниши</a>
						<a class="menu_item" href=<?php echo $root_dir."technology/starsSky"?>>Звездное небо</a>
					</div>
				</div>
				<div class="line_butt"></div>
				<a class="menu_item" href=<?php echo $root_dir."lighting"?>>Споты</a>			
				<div class="line_butt"></div>
				<div class="cont_940">
					<div class="menu_item sub_menu_btn"><span>Производители ПВХ</span><span></span></div>
					<div role="menu" class="sub_menu">
						<a class="menu_item" href=<?php echo $root_dir."vendorsFoil/MSD"?>>MSD</a>
						<a class="menu_item" href=<?php echo $root_dir."vendorsFoil/BAUF"?> >BAUF</a>
						<a class="menu_item" href=<?php echo $root_dir."vendorsFoil/Pongs"?>>Pongs</a>
						<a class="menu_item" href=<?php echo $root_dir."vendorsFoil/Teqtum"?>>Teqtum</a>
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
						$c = count($_SESSION['favourImg']) + count($_SESSION['buyProducts']);

						echo "<a class='menu_item favourIndex' href=".$root_dir."favourites>Избранное<span class='favour_count_menu'>$c</span></a>";
					}else{
						echo "<a class='menu_item favourIndex' href=".$root_dir."favourites>Избранное<span></span></a>";
					}
				?>
				<div id="kontaktBtnId"  class="menu_item">Контакты</div>

				
			</div>
		</div>
		<div class="header_lozung">
			<span>Натяжные потолки всего за 200 руб/м2</span>
			<span>оставьте заявку и получите доп. скидку 1000 руб.</span>
			<a role="button"><div class="btn_animate"></div>Оставить заявку</a>
		</div>
		<div class="svg_triangle">
			<svg width="100%" height="100%" viewBox="0 0 100 50" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
			  <path fill="white" d="M0 0 L 100 50 L 0 50 Z"/>
			</svg>
		</div>
	</div>

	<div role="main" id="main_section_id">
	