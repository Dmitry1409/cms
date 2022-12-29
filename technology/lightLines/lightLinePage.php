
	<div class="vert_line_cont">
		<div class="vert_line"></div>
	</div>
	<div class="heder_present" style="position: relative; z-index: 2;">
		<span>Световые линии</span>
		<span>это современно</span>
	</div>
	
	<div class="lightsLines_flex">
		<div class="lights_img_cont">
			<picture>
				<source srcset="../../img/fe0wj0.webp" type="image/webp">
				<img src="../../img/fe0wj0.jpeg" alt="Световые линии это круто">
			</picture>
		</div>
		<div class="lights_text">
			<span>Натяжные потолки со световыми линиями – новый подход в организации потолочного декора. Это инновационная технология, которая выглядит необычно, интересно и даже в чем-то сюрреалистично. На самом же деле этот смелый дизайн можно воспроизвести в любой квартире и без особых крупных затрат. Чтобы идти в ногу со временем, нужно всего лишь сделать натяжные потолки и снабдить их LED-освещением.</span>
			<p class="green_defice">Преимущества: </p>
			<div class="advan_cont">
				<span>
					<span class="green_defice">&mdash;</span> <span>&nbsp;Стильный элемент для преображения интерьера</span>
				</span>
				<span>
					<span class="green_defice">&mdash;</span> <span>&nbsp;Использование различных геометрических форм линий</span>
				</span>
				<span>
					<span class="green_defice">&mdash;</span> <span>&nbsp;Уникальный неповторимы дизайн освещения</span>
				</span>
				<span>
					<span class="green_defice">&mdash;</span> <span>&nbsp;Возможность комбинации различных фактур</span>
				</span>
				<span>
					<span class="green_defice">&mdash;</span> <span>&nbsp;Ничего лишнего</span>
				</span>
			</div>
		</div>
	</div>

	<div class="vert_line_cont device_vert">
		<div class="vert_line"></div>
	</div>
	<div class="heder_present" style="position: relative; z-index: 2;">
		<span>Устройство</span>
		<span>световых линий</span>
	</div>

	<div class="device_cont">
		<div class="device_img_cont">
			<picture>
				<source srcset='<?php echo $root_dir."img/rendered/webp/fsdfsf3reb3b.webp"?>' type="image/webp">
				<img src='<?php echo $root_dir."img/rendered/jpg/fsdfsf3reb3b.jpg"?>' alt="Устройство световых линий">
			</picture>
		</div>
		<div class="lights_text device_text">
			<p><span class="green_defice">&mdash;</span>&nbsp;Алюминиевый профиль</p>
			<span>Главным элементов конструкции световые линии является алюминиевый профиль.
				<br>В него устанавливается ПВХ полотно натяжного потолка и светодиодная лента.
				<br>Основным критерием подбора профиля является ширина световой линии.
				<br>Варианты ширины 15мм, 30мм, 40мм, 50мм.</span>
			<p><span class="green_defice">&mdash;</span>&nbsp;Светодиодная лента</p>
			<span>В зависимости от ширины подобранного профиля можно установить одну или несколько светодиодных лент. Так же можно комбинировать мощность, световое свечение лент между собой и таким образом получать различные варианты освещенности. Ничего не мешает установить и многоцветную ленту совместно с монохромной лентой основного освещения.</span>
			<p><span class="green_defice">&mdash;</span>&nbsp;Фактура полотна</p>
			<span>Благодаря тому что алюминиевый профиль делит комнату на множество отдельных полотен есть вариант подобрать цвет и фактуру каждого полотна по отдельности и таким образом создать не повторимый дизайн вашего помещения.</span>
		</div>
	</div>

	<?php

		$query = "SELECT id_img FROM hashTags WHERE name = 'световые линии'";
		$key_session = 'ligthLineImg';
		$hashsSelect = ['#световые линии'];
		include "../../templates/exampWorkFoto.php";
	?>


	<div class="price_section">
		<div class="vert_line_cont device_vert">
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
						$res = $db->query("SELECT * FROM product WHERE id IN (5,6,7,8,9,10,11,12,13)");
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
				<span>Обновлено <?php $r = $db->query("SELECT date FROM UpdatePriseData WHERE namePrise = 'svet_line'");
				 echo $r->fetchArray(SQLITE3_ASSOC)['date']; ?></span>
			</div>
		</div>
	</div>

