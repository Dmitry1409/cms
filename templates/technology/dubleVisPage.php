
<div style="display: flex; justify-content: center; margin-top: 50px;">
	<div class="vert_line"></div>
</div>
<div class="heder_present" style="position: relative; z-index: 2;">
	<h1>Double Vision</h1>
	<span>новые возможности</span>
</div>
<div class="dubleVideo_wrapp">
	<video poster='<?php echo $GLOBALS["root_dir"]."img/imgDublImgPage/posterVid.webp" ?>' autoplay muted loop>
	  <source src="../img/short.mp4" type='video/mp4' />
	  <source src="../img/otherFormat.webm" type='video/webm' />
	</video>
	<div>
		<p>Double Vision- это относительно новое направление в натяжных потолках. Главная идея double vision является в изменении внешнего вида потолка при включении выключении света. Это позволяет оформить потолок совершено новым и оригинальным способом.</p>
		<p>Существует два вида фотопечати. Первый вариант двухсторонняя фотопечать. Это когда на ваш натяжной потолок наносят выбранное изображения и при выключенном свете поверхность ни чем не отличается от обычного художественного потолка. Но когда включается специальная  подсветка на полотне проявляется дополнительный скрытый рисунок. При втором варианте со скрытой фотопечатью на потолке изначально нет видимых изображений а сам рисунок расположен на изнаночной стороне полотна.</p>
	</div>
</div>

<?php
	$query = "SELECT id_img FROM hashTags WHERE name = 'фотопечать'";
	$hashsSelect = ['#фотопечать'];
	include "templates/exampWorkFoto.php";
?>

<div style="display: flex; justify-content: center; margin-top: 50px;">
	<div class="vert_line"></div>
</div>
<div class="heder_present" style="position: relative; z-index: 2;">
	<h1>Фотопечать это</h1>
</div>

<div class="presentContFP">
	<div class="presentFP">
		<div class="presentImgContFp"><img src="../img/imgDublImgPage/images_icon-icons.com_76712.png"></div>
		<div class="presentTextFP">Высокое качество изображения на полотне</div>
	</div>
	<div class="presentFP">
		<div class="presentImgContFp"><img src="../img/imgDublImgPage/globe_internet_planet_globo_10812.png"></div>
		<div class="presentTextFP">Можно подобрать любое изображение в интернете или заказать у дизайнера</div>
	</div>
	<div class="presentFP">
		<div class="presentImgContFp"><img src="../img/imgDublImgPage/photo_picture_photo_184.png"></div>
		<div class="presentTextFP">Огромный каталог изображений совершенно бесплатно</div>
	</div>
	<div class="presentFP">
		<div class="presentImgContFp"><img src="../img/imgDublImgPage/gift-icon_34411.png"></div>
		<div class="presentTextFP">Дарим вам дизайн макета в подарок</div>
	</div>
</div>



<div id="anchorFotoPrint" style="display: flex; justify-content: center; margin-top: 50px;">
	<div class="vert_line"></div>
</div>
<div class="heder_present" style="position: relative; z-index: 2;">
	<h1>Варианты изображений</h1>
</div>

<div class="FPControlPanel">
	<div role="button" class="FPActiv">все</div>
	<div role="button">абстракции</div>
	<div role="button">животные</div>
	<div role="button">архитектура</div>
	<div role="button">исскуство</div>
	<div role="button">детское</div>
	<div role="button">подводный мир</div>
	<div role="button">цветы</div>
	<div role="button">еда</div>
	<div role="button">картины</div>
	<div role="button">природа</div>
	<div role="button">орнаменты</div>
	<div role="button">небо</div>
	<div role="button">космос</div>
	<div role="button">стерео-эффект</div>
	<div role="button">текстуры</div>
	<div role="button">транспорт</div>

</div>


<div class="fotoPrintCont">
	<?php
		$allImg = [];
		include "scripts_php/collectImage.php";
		$imgDir = scandir('img/imgFantes');
		$imgDir = array_diff($imgDir, array('..', '.'));
		for($i=2; $i<count($imgDir)+2; $i++){
			$d = 'img/imgFantes/'.$imgDir[$i];
			$a = getImages($d);
			for($j=0; $j<count($a); $j++){
				$r = [];
				$p = $d.'/'.$a[$j];
				$finfo = getimagesize($p);
				$r[] = "../".$p;
				$r[] = $finfo[0];
				$r[] = $finfo[1];
				$allImg[] = $r;
			}
		}
		shuffle($allImg);
		$_SESSION['FPImgArr'] = $allImg;

		for($i=0; $i<12; $i++){
			$p = $allImg[$i][0];
			$w = $allImg[$i][1];
			$h = $allImg[$i][2];
			echo "<div class='FPwrapp'>";
			echo "<img data-width=$w data-height=$h src=$p>";
			echo "</div>";
		}	
	?>
</div>
<div class="FPcountCont fp_count_id">
	<span><span>12</span> из <span><?php echo count($allImg); ?></span></span>
</div>
<div role="button" class="FPcontArrow add_img_dub_vis_id">
	<div class="arrow-8"></div>
</div>


<div style="display: flex; justify-content: center; margin-top: 50px;">
	<div class="vert_line"></div>
</div>
<div class="heder_present" style="position: relative; z-index: 2;">
	<h1>Наше оборудование</h1>
</div>

<div class="euipWrapp">
	<div>
		<div class="equipImgCont">
			<img src="../img/imgDublImgPage/nsldfiojw.jpg">
		</div>
		<div class="equipText">
			<span>	
				<div class="green_deficeFp"></div>
				<span>Cовременное оборудование японского производства</span>
			</span>
			<span>	
				<div class="green_deficeFp"></div>
				<span>Экосольвентные чернила – ECO-SOL MAX</span>
			</span>
			<span>	
				<div class="green_deficeFp"></div>
				<span>Специальный климат в помещении</span>
			</span>
		</div>
	</div>

	<?php
	$m = date("m", time() + 172800);
	$tar_date = date('d', time() + 172800);
	$m_text = "";
	switch ($m) {
		case '01':
			$m_text ="Января";
			break;
		case '02':
			$m_text ="Февраля";
			break;
		case '03':
			$m_text ="Марта";
			break;
		case '04':
			$m_text ="Апреля";
			break;
		case '05':
			$m_text ="Майя";
			break;
		case '06':
			$m_text ="Июня";
			break;
		case '07':
			$m_text ="Июля";
			break;
		case '08':
			$m_text ="Августа";
			break;
		case '09':
			$m_text ="Сентября";
			break;
		case '10':
			$m_text ="Октября";
			break;
		case '11':
			$m_text ="Ноября";
			break;
		case '12':
			$m_text ="Декабря";
			break;
	}
	$tar_date = $tar_date." ".$m_text." 20".date('y')."г.";
	?>

	<div class="aferta_block">
		<div class="sale_flag">200 руб.</div>
		<img style="border-radius: 4px;" src="../img/people.webp">
		<h4>Оформите заявку прямо сейчас и получи скидку в 200 руб. с м2</h4>
		<span>Акция действует до <?php echo $tar_date; ?></span>
		<span>Подробности по телефону</span>
		<div role="button" class="aferta_btn">Оформить</div>
	</div>

</div>



<div class="calcWrappFP">

	<div style="display: flex; justify-content: center; margin-top: 50px;">
		<div class="vert_line"></div>
	</div>
	<div class="heder_present" style="position: relative; z-index: 2;">
		<h1>Экспресс расчет</h1>
	</div>

	<?php
		$res = $GLOBALS['db']->query("SELECT id, name, price FROM priceForCalcult WHERE id IN (1, 2, 3, 4, 5, 6, 7)");
		$val = [];
		while($r = $res->fetchArray(SQLITE3_ASSOC)){
			$val[$r['id']] = $r;
		}	
	?>

	<div class="calculate_cont">
		<div class="calcul_body">
			<form class="flex_input" data-price-spot="<?php echo $val[3]['price']?>"
									 data-price-lamp="<?php echo $val[2]['price']?>"
									 data-price-foil="<?php echo $val[1]['price']?>"
									 data-price-minorder="<?php echo $val[4]['price'] ?>"
									 data-price-print="<?php echo $val[7]['price']?>"
									 data-price-discount="<?php echo $val[6]['price']?>">
				<input type="number" name="count_space" placeholder="Площадь помещения м2">
				<input type="number" name="perimetr" placeholder="Площадь печати м2">
				<input type="number" name="light_points" placeholder="Точек освещения">
			</form>
			<div role="button" class="calc_btn expresCalculBtn">
				<div class="btn_animate"></div>
				<div class="call_me_load_anim display_none"></div>
				<div class="call_me_load_anim call_me_load_anim2 display_none"></div>
			Рассчитать</div>
		</div>
	</div>
</div>







