<div style="display: flex; justify-content: center; margin-top: 50px;">
	<div class="vert_line"></div>
</div>
<div class="heder_present" style="position: relative; z-index: 2;">
	<span>Звездное небо</span>
	<span>это атмосферно</span>
</div>

<div class="starsVideoHederWrapp">
	
	<video poster="posterSky.jpg" autoplay muted loop>
	  <source src="starsSkyzip.mp4" type='video/mp4' />
	  <source src="skyVidWebm.webm" type='video/webm; codecs="vp8, vorbis"' />
	</video>
	<div class="starsHederTextblock">
		<p>Потолок "Звездное небо" оригинальный способ украсить ваш потолок и понаблюдать за звездами, ведь смотреть на ночное небо нравиться многим, а в наше время полюбоваться космосом можно прямо у себя дома. Это стало возможно благодаря технологии "Звездное небо". Такой вид отделки можно встретить в интерьерах кафе и ресторанов, бассейнов м развлекательных центров а также в квартирах и домах причем усыпать потолок звездами можно в любой комнате.</p>
		<p>Добиться реалистичного эффекта светящихся звезд можно двумя способами:</p>
		<div>
			<div class="starNote"><div class="green_defice_star"></div><div>С использованием светопроводящий булавок - более бюджетный вариант.</div></div>
			<div class="starNote"><div class="green_defice_star"></div><div>С использованием оптоволоконных нитей - более реалистичный вариант.</div></div>
		</div>
	</div>
</div>





<div style="display: flex; justify-content: center; margin-top: 50px;">
	<div class="vert_line"></div>
</div>
<div class="heder_present" style="position: relative; z-index: 2;">
	<span>Варианты исполнения</span>
</div>
<p class="variExecutStarsparag">Конечный вид потолка зависит от нескольких факторов:</p>
<div class="variExecBlockStars">
	<div style="display: flex;">	
		<div class="starNote">
			<div class="green_defice_star"></div>
			<div>Полотно с фотопечатью или без, глянец, матовый или узорчатая фактура.</div>
		</div>
		<a class="vatiImagesLink"href="../dubleVisionPrint#anchorFotoPrint">Вырианты изображений</a>
	</div>
	<div class="starNote"><div class="green_defice_star"></div><div>Выбор контроллера с монохромным свечением или же мультиколор с мерцанием и с эффектом падающих комет.</div></div>
	<div class="starNote"><div class="green_defice_star"></div><div>Размещение дополнительный областей засветки с возможностью регулировки свечения. Например светящиеся планета или полумесяц.</div></div>
	<div class="starNote"><div class="green_defice_star"></div><div>Колличество звезд.</div></div>
	<div class="starNote"><div class="green_defice_star"></div><div>Случайное расположение звезд или вымеренное.</div></div>
</div>

<div style="display: flex; justify-content: center; margin-top: 50px;">
	<div class="vert_line"></div>
</div>
<div class="heder_present" style="position: relative; z-index: 2;">
	<span>Примеры работ</span>
</div>

<?php
	$query = "SELECT id_img FROM hashTags WHERE name = 'звездное небо'";
	$key_session = 'staryySky';
	$hashsSelect = ['#звездное небо'];
	include "../templates/exampWorkFoto.php";
?>



<div class="ofertBlockStarrysky">
	<div class="aferta_block">
		<div class="sale_flag">скидка 50%</div>
		<img style="border-radius: 4px;" src="../img/people.webp">
		<h4>Обратитесь к нашему технологу прямо сейчас и получите контроллер со скидкой 50%.</h4>
		<span>наш технолог подберет для вас наиболее подходящий вариант исполнения потолка "звездное небо".</span>
		<span>Обращайтесь по телефону 8(831)-413-53-94</span>
		<div class="aferta_btn">Отправить заявку</div>
	</div>

	<div class="price_section">
		<div class="vert_line_cont device_vert margin_top_unset">
			<div class="vert_line"></div>
		</div>
		<div class="heder_present" style="position: relative; z-index: 2;">
			<span>Цены</span>
		</div>

		<div class="price_table">
			<?php ?>
			<table>
				<thead>
					<tr>
						<td>Наименование</td>
						<td>Ед.изм</td>
						<td>Цена руб.</td>
					</tr>
				</thead>
				<tbody>
					<?php
						$res = $db->query("SELECT * FROM product WHERE id BETWEEN 40 AND 52");
						while($r = $res->fetchArray(SQLITE3_ASSOC)){
							echo "<tr>";
								echo "<td>$r[name]</td>";
								echo "<td>$r[ед]</td>";
								echo "<td>$r[price]</td>";
							echo "</tr>";	
						}
					?>
				</tbody>
			</table>
			<div class="update_price">
				<span>Обновлено <?php $r = $db->query("SELECT date FROM UpdatePriseData WHERE namePrise = 'staryySky'");
				 echo $r->fetchArray(SQLITE3_ASSOC)['date']; ?></span>
			</div>
		</div>
	</div>
</div>