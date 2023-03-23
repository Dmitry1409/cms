
	<?php
		$query = "все";
		$hashsSelect = ['#все'];
		include "exampWorkFoto.php";
		include "listRouts.php";
	?>
	

	<div id="techSectionIdAnch" style="display: flex; justify-content: center; margin-top: 100px;">
		<div class="vert_line"></div>
	</div>
	<div class="heder_present" style="position: relative; z-index: 2;">
		<span>Установим любой вид<br>потолка</span>
	</div>
	<div style="position: relative;">
		<div class="padd_tech"></div>
		<div class="tech_grid">
			<div class="tech_elem">				
				<picture class="tech_picture">
					<source srcset="img/mainPage/webp/svetovie_line.webp" type="image/webp">
					<img class="img_skew" src="img/mainPage/jpg/svetovie_line.jpg" alt="Световые линии">
				</picture>				
				<div class="tech_mask"></div>
				<div href="/cms/" class="skew_revers">
					<h3 class="tech_header">Световые линии</h3>
					<a href='<?php echo $listRout["svetLine"]?>' class="btn_tech">Узнать подробнее</a>
				</div>
			</div>
			<div class="tech_elem">				
				<picture class="tech_picture">
					<source srcset="img/mainPage/webp/svet_line.webp" type="image/webp">
					<img class="img_skew" src="img/mainPage/jpg/svet_line.jpg" alt="Парящие теневые потолки">
				</picture>	
				<div class="tech_mask"></div>
				<div class="skew_revers">
					<h3 class="tech_header">Парящие<br>Теневые<br>Подсветка</h3>
					<a href='<?php echo $listRout["shadProf"]?>' class="btn_tech">Узнать подробнее</a>
				</div>
			</div>
			<div class="tech_elem">				
				<picture class="tech_picture">
					<source srcset="img/mainPage/webp/two_level.webp" type="image/webp">
					<img class="img_skew" src="img/mainPage/jpg/two_level.jpg" alt="Многоуровневые конструкции">
				</picture>
				<div class="tech_mask"></div>
				<div class="skew_revers">
					<h3 class="tech_header">Многоуровневые</h3>
					<a href='<?php echo $listRout["multiLev"]?>' class="btn_tech">Узнать подробнее</a>
				</div>
			</div>
			<div class="tech_elem">
				<picture class="tech_picture">
					<source srcset="img/mainPage/webp/gardin.webp" type="image/webp">
					<img class="img_skew" src="img/mainPage/jpg/gardin.jpeg" alt="Ниша в потолке">
				</picture>				
				<div class="tech_mask"></div>
				<div class="skew_revers">
					<h3 class="tech_header">Ниши<br>Гардины</h3>
					<a href='<?php echo $listRout["hidCur"]?>' class="btn_tech">Узнать подробнее</a>
				</div>
			</div>
			<div class="tech_elem">
				<picture class="tech_picture">
					<source srcset="img/mainPage/webp/glyanc2.webp" type="image/webp">
					<img class="img_skew" src="img/mainPage/jpg/glyanc2.jpg" alt="Глянцевый вместе с матовым полотном">
				</picture>				
				<div class="tech_mask"></div>
				<div class="skew_revers">
					<h3 class="tech_header">Фактура<br>Цвет</h3>
					<a href='<?php echo $listRout["textCol"]?>' class="btn_tech">Узнать подробнее</a>
				</div>
			</div>
			<div class="tech_elem">
				<picture class="tech_picture">
					<source srcset="img/mainPage/webp/3d_print.webp" type="image/webp">
					<img class="img_skew" src="img/mainPage/jpg/3d_print.jpg" alt="Фотопечать на полотне">
				</picture>			
				<div class="tech_mask"></div>
				<div class="skew_revers">
					<h3 class="tech_header">Double Vision<br>Фотопечать</h3>
					<a href='<?php echo $listRout["dublVis"]?>' class="btn_tech">Узнать подробнее</a>
				</div>
			</div>
			<div class="tech_elem">
				<picture class="tech_picture">
					<source srcset="img/mainPage/webp/reznie.webp" type="image/webp">
					<img class="img_skew" src="img/mainPage/jpg/reznie.jpg" alt="Резные полотна">
				</picture>			
				<div class="tech_mask"></div>
				<div class="skew_revers">
					<h3 class="tech_header">Резные</h3>
					<a href='<?php echo $listRout["carCell"]?>' class="btn_tech">Узнать подробнее</a>
				</div>
			</div>
			<div class="tech_elem">
				<picture class="tech_picture">
					<source srcset="img/mainPage/webp/6064505d189c41d3b73f639711059891.webp" type="image/webp">
					<img class="img_skew" src="img/mainPage/jpg/6064505d189c41d3b73f639711059891.jpg" alt="Световые ниши">
				</picture>				
				<div class="tech_mask"></div>
				<div class="skew_revers">
					<h3 class="tech_header">Световые ниши</h3>
					<a href='<?php echo $listRout["ligNich"]?>' class="btn_tech">Узнать подробнее</a>
				</div>
			</div>
			

			<div class="tech_elem">
				<picture class="tech_picture">
					<source srcset="img/mainPage/webp/night_sky.webp" type="image/webp">
					<img class="img_skew" src="img/mainPage/jpg/night_sky.jpg" alt="Звезды в потолке">
				</picture>				
				<div class="tech_mask"></div>
				<div class="skew_revers">
					<h3 class="tech_header">Звездное небо</h3>
					<a href='<?php echo $listRout["starSky"]?>' class="btn_tech">Узнать подробнее</a>
				</div>
			</div>
			<div class="tech_elem">
				<picture class="tech_picture">
					<source srcset="img/mainPage/webp/light.webp" type="image/webp">
					<img class="img_skew" src="img/mainPage/jpg/light.jpg" alt="Светильники">
				</picture>				
				<div class="tech_mask"></div>
				<div class="skew_revers">
					<h3 class="tech_header">Споты</h3>
					<a href='<?php echo $listRout["lighting"]?>' class="btn_tech">Узнать подробнее</a>
				</div>
			</div>
		</div>
	</div>

	

	<div class="presents">
		<div style="display: flex; margin-top: 50px; justify-content: center;">
			<div class="vert_line"></div>
		</div>
		<div class="heder_present">
			<span>За что нас выбирают</span>
			<span>Поcмотрите сами</span>
		</div>
		<div class="cont_grid_pres">
			<div class="grid_item_pres">
				<div class="present_icon">
					<img src="img/mainPage/piggy.webp">
				</div>
				<div class="present_text_block">
					<div class="pres_hed">В среднем дешевле на 20%</div>
					<div class="pres_desc">у нас дешевле чем у других</div>
				</div>
			</div>
			<div class="grid_item_pres">
				<div class="present_icon">
					<img src="img/mainPage/guarante.webp">
				</div>
				<div class="present_text_block">
					<div class="pres_hed">100%</div>
					<div class="pres_desc">гарантия на все выполнениые работы</div>
				</div>
			</div>
			<div class="grid_item_pres">
				<div class="present_icon">
					<img src="img/mainPage/service.webp">
				</div>
				<div class="present_text_block">
					<div class="pres_hed">10 лет</div>
					<div class="pres_desc">гарантия на все полотна</div>
				</div>
			</div>
			<div class="grid_item_pres">
				<div class="present_icon">
					<img src="img/mainPage/production.webp">
				</div>
				<div class="present_text_block">
					<div class="pres_hed">Свое производство</div>
					<div class="pres_desc">что позволяет делать всё в короткие сроки</div>
				</div>
			</div>
			<div class="grid_item_pres">
				<div class="present_icon">
					<img src="img/mainPa	ge/zamer.webp">
				</div>
				<div class="present_text_block">
					<div class="pres_hed">Бесплатный замер</div>
					<div class="pres_desc">по всей нижегородской области</div>
				</div>
			</div>
			<div class="grid_item_pres">
				<div class="present_icon">
					<img src="img/mainPage/timer.webp">
				</div>
				<div class="present_text_block">
					<div class="pres_hed">48 часов</div>
					<div class="pres_desc">от выезда замерщика до монтажа</div>
				</div>
			</div>	
		</div>
	</div>

	<?php
		include "clientFeedBack.php";
	?>

	<div id="expressCalc" class="calculate_cont">
		<div class="padd_calcult"></div>
		<div style="display: flex; justify-content: center; position: relative;">
			<div class="vert_line"></div>
		</div>
		<div class="heder_present" style="position: relative; z-index: 2; margin-bottom: unset;">
			<span>Экспресс расчет</span>
		</div>
		<?php
			$res = $GLOBALS['db']->query("SELECT id, name, price FROM priceForCalcult WHERE id IN (1, 2, 3, 4, 6)");
			$val = [];
			while($r = $res->fetchArray(SQLITE3_ASSOC)){
				$val[$r['id']] = $r;
			}
			
		?>
		<div class="calcul_body">
			<form data-price-spot="<?php echo $val[3]['price']?>"
				  data-price-lamp="<?php echo $val[2]['price']?>"
				  data-price-foil="<?php echo $val[1]['price']?>"
				  data-price-minorder="<?php echo $val[4]['price'] ?>"
				  data-price-discount="<?php echo $val[6]['price']?>" class="flex_input">
				<input type="number" autocomplete="off" name="count_room" placeholder="Количество помещений">
				<input type="number" autocomplete="off" name="count_svet" placeholder="Точек освещения">
				<input type="number" autocomplete="off" name="count_square" placeholder="Общая площадь м2">
			</form>
			<div role="button" class="calc_btn expresCalculBtn">
				<div class="btn_animate"></div>
				<div class="call_me_load_anim display_none"></div>
				<div class="call_me_load_anim call_me_load_anim2 display_none"></div>
			Рассчитать</div>
		</div>
	</div>

	<div id="vendorsSectionId" style="display: flex; justify-content: center; position: relative; margin-top: 50px;">
		<div class="vert_line"></div>
	</div>
	<div class="heder_present" style="position: relative; z-index: 2; margin-bottom: 50px;">
		<span>Наши поставщики</span>
	</div>

	<div  class="vendorSection">
		<?php
			$res = $GLOBALS['db']->query("SELECT * FROM product WHERE id > 52 AND id < 60");
			$val = [];
			while($r= $res->fetchArray(SQLITE3_ASSOC)){
				$val[$r['id']] = $r;
			}		
		?>
		<div>
			<div class="vendorItem">
				<div>
					<img src="img/mainPage/msdvendorskkgwgkw.jpg" alt="logo-msd">
				</div>
				<div class="vendorDescriptCont">
					<div>MSD-premium-classic</div>
					<div>
						<span>Матовое, глянцевое и сатиновое плотно ПВХ. Гарантия 12 лет</span>
						<span class="vendorPriseCont">от <span><?php echo $val[53]['price']?></span> руб/м2</span>
						<a href='<?php echo $listRout["MSD"]?>'>Подробнее</a>
					</div>
				</div>
			</div>

			<div class="vendorItem">
				<div>
					<img src="img/mainPage/bauffwmw02fggs.jpg" alt="logo-BAUF">
				</div>
				<div class="vendorDescriptCont">
					<div>BAUF</div>
					<div>
						<span>Фактуры: глянцевый потолок, сатин, мат, полупрозрачная, ПВХ (Германия)</span>
						<span class="vendorPriseCont">от <span><?php echo $val[57]['price']?></span> руб/м2</span>
						<a href='<?php echo $listRout["BAUF"]?>'>Подробнее</a>
					</div>
				</div>
			</div>
		</div>
		<div>
			<div class="vendorItem">
				<div>
					<img src="img/mainPage/pongskwpmmpwv.jpg" alt="logo-Pongs">
				</div>
				<div class="vendorDescriptCont">
					<div>Pongs</div>
					<div>
						<span>Полотна: матовое, глянцевое, сатиновое, ПВХ (Германия). Гарантия 15 лет</span>
						<span class="vendorPriseCont"><span><?php echo $val[59]['price']?></span> руб/м2</span>
						<a href='<?php echo $listRout["Pongs"]?>'>Подробнее</a>
					</div>
				</div>
			</div>

			<div class="vendorItem">
				<div>
					<img src="img/mainPage/teqtum-logomwpmmwf.jpg" alt="logo-Teqtum">
				</div>
				<div class="vendorDescriptCont">
					<div>Teqtum</div>
					<div>
						<span>Полотна: глянец, сатин, мат, ПВХ (Германия). Класс KM2, негорючие</span>
						<span class="vendorPriseCont"><span><?php echo $val[58]['price']?></span> руб/м2</span>
						<a href='<?php echo $listRout["Teqtum"]?>'>Подробнее</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="certificate_cont">
		<div class="certif_940">
			<div class="aferta_container">
				<div style="display: flex; justify-content: center; position: relative;">
					<div class="vert_line"></div>
				</div>
				<div class="heder_present" style="position: relative; z-index: 2;">
					<span>Ежемесячная акция</span>
				</div>
				<div class="aferta_block">
					<div class="sale_flag">50000 руб.</div>
					<img style="border-radius: 4px;" src="img/mainPage/people.webp">
					<h4>Каждому 100-му клиенту мы устанавливаем потолки совершенно бесплатно!</h4>
					<span>общей суммой до 50000 рублей *</span>
					<span>Подробности по телефону</span>
					<div role="button" class="aferta_btn">Учавствовать</div>
				</div>
			</div>
			<div class="certif_doc">
				<div>
					<div style="display: flex; justify-content: center; position: relative;">
						<div class="vert_line"></div>
					</div>
					<div class="heder_present" style="position: relative; z-index: 2;">
						<span>Сертификаты</span>
						<span>экологические, противопожарные</span>
					</div>
				</div>
				<div class="img_container">
					<div class="img_row_cont">
						<div class="img_border">
							<picture>
								<source srcset="img/vendorsFoilPage/sertifikat-eckologia-msd-fsmmw.webp" type="image/webp">
								<img src="img/vendorsFoilPage/sertifikat-eckologia-msd-fsmmw.jpg">
							</picture>
						</div>
						<div class="img_border">
							<picture>
								<source srcset="img/vendorsFoilPage/jfjsp9wrjgwjgjpwgjwg.webp" type="image/webp">
								<img src="img/vendorsFoilPage/jfjsp9wrjgwjgjpwgjwg.jpg">
							</picture>
						</div>
					</div>
					<div class="img_row_cont">
						<div class="img_border">
							<picture>
								<source srcset="img/vendorsFoilPage/sfpwwpewimf.webp" type="image/webp">
								<img src="img/vendorsFoilPage/sfpwwpewimf.jpg">
							</picture>
						</div>
						<div class="img_border">
							<picture>
								<source srcset="img/vendorsFoilPage/sgpwjwpwpfwf.webp" type="image/webp">
								<img src="img/vendorsFoilPage/sgpwjwpwpfwf.jpg">
							</picture>
						</div>
					</div>
				</div>
				<div role="button" class="cert_btn_cont">
					<a href='<?php echo $listRout["certificates"]?>' class="all_doc_btn">Все документы</a>
					<!-- <div class="prise_btn"><div class="btn_animate"></div>Получить прайс лист</div> -->
				</div>
			</div>
		</div>
	</div>
	