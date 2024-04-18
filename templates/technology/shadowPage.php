
	
<div class="vert_line_cont device_vert">
	<div class="vert_line"></div>
</div>
<div class="heder_present" style="position: relative; z-index: 2;">
	<h1>Установим парящий<br>потолок</h1>
</div>


<div class="lightsLines_flex">
	<div class="lights_img_cont">
		<picture>
			<source srcset="../img/flying/18246695-pariashchii-potolok-84.webp" type="image/webp">
			<img src="../img/flying/18246695-pariashchii-potolok-84.jpg" alt="Парящие потолки и потолки с подсветкой">
		</picture>
	</div>
	<div class="lights_text">
		<span>Благодаря наличию большой разновидности всевозможный стеновых профилей можно создавать
			декоративную подсветку примыкание потолка к стене и теневой зазор, что придает объем потолку.
			Выбирая наш парящий профиль вы получаете два в одном и декоративную подсветку и теневой профиль.
			Также есть профиля просто теневые, без возможности установки светодиодной ленты. Они отлично
			подходят практически для всех помещений. Это хорошо смотрится когда поверхность стены
			имеет декоративную текстуру или же это может быть стена с красивыми обоями или допустим глянцевая
			плитка в ванной.
		</span>
		<?php
			$text_offer = "Заказать цена от 250 р/м.п";
			include "templates/zakaz_offer_block.php";
		?>
		<p>
			Подсветка по периметру может выполнять роль зонирования помещения, может служит ночником или
			приглушенным светом при просмотре телевизора. Еще в нашем арсенале имеется профиль подсветки по
			периметру принципиально другой конфигурации. Он больше похож на световые линии прям рядом со стеной.  
		</p>
	</div>
</div>

<?php
	$query = "SELECT id_img FROM hashTags WHERE name in ('теневой','контурная подсветка','парящий')";
	$hashsSelect = ['#теневой', '#контурная подсветка', '#парящий'];
	include "templates/exampWorkFoto.php";
?>


<div class="vert_line_cont device_vert">
	<div class="vert_line"></div>
</div>
<div class="heder_present" style="position: relative; z-index: 2;">
	<h1>Виды профилей</h1>
</div>

<div class="types_prof_cont">
	<div class="types_row">
		<picture>
			<?php
				$res = $GLOBALS['db']->query('SELECT * FROM product WHERE id = 1')->fetchArray(SQLITE3_ASSOC);
			?>
			<p>Теневой</p>
			<source type="image/webp" srcset=<?php echo "../".$res['webp'];?> >
			<img alt="Профиль теневой" src=<?php echo "../".$res['jpg'];?> >
			<div class="types_featur">
				<?php
					$s = explode(";",$res['feature']);
					for($i = 0; $i < count($s); $i++){
						echo "<span>$s[$i]</span>";
					}
				?>
			</div>
		</picture>
		<picture>
			<?php
				$res =  $GLOBALS['db']->query('SELECT * FROM product WHERE id = 2')->fetchArray(SQLITE3_ASSOC);
			?>
			<p>Парящий</p>
			<source type="image/webp" srcset=<?php echo "../".$res['webp']; ?> >
			<img alt="Парящий профиль" src=<?php echo "../".$res['jpg'];?> >
			<div class="types_featur">
				<?php
					$s = explode(";",$res['feature']);
					for($i = 0; $i < count($s); $i++){
						echo "<span>$s[$i]</span>";
					}
				?>
			</div>
		</picture>
	</div>
	<div class="types_row">
		<picture>
			<?php
				$res =  $GLOBALS['db']->query('SELECT * FROM product WHERE id = 3')->fetchArray(SQLITE3_ASSOC);
			?>
			<p>Контурный</p>
			<source type="image/webp" srcset=<?php echo "../".$res['webp']; ?>>
			<img alt="Контурный профиль" src=<?php echo "../".$res['jpg'];?> >
			<div class="types_featur">
				<?php
					$s = explode(";",$res['feature']);
					for($i = 0; $i < count($s); $i++){
						echo "<span>$s[$i]</span>";
					}
				?>
			</div>
		</picture>
		<picture>
			<?php
				$res =  $GLOBALS['db']->query('SELECT * FROM product WHERE id = 4')->fetchArray(SQLITE3_ASSOC);
			?>
			<p>Контурный-теневой</p>
			<source  type="image/webp" srcset=<?php echo "../".$res['webp']; ?>>
			<img alt="Контурно-теневой профиль" src=<?php echo "../".$res['jpg'];?> >
			<div class="types_featur">
				<?php
					$s = explode(";",$res['feature']);
					for($i = 0; $i < count($s); $i++){
						echo "<span>$s[$i]</span>";
					}
				?>
			</div>
		</picture>		
	</div>
</div>

<div class="vert_line_cont device_vert">
	<div class="vert_line"></div>
</div>
<div class="heder_present" style="position: relative; z-index: 2;">
	<h1>Парящий<br>с рассеивателем</h1>
</div>


<div class="lightsLines_flex">
	<div class="lights_img_cont">
		<picture>
			<source srcset="../img/flying/xnr78gbuk0w0dcpzax1h73k0.webp" type="image/webp">
			<img src="../img/flying/xnr78gbuk0w0dcpzax1h73k0.jpg" alt="Парящий потолок с рассеивателем">
		</picture>
	</div>

	<div class="lights_text">
		<div class="flex_col">
			<span>
				<div class="big_green_defice"></div><span>Равномерный свет</span>
			</span>
			<span>
				<div class="big_green_defice"></div> <span>Дополнительная изоляция</span>
			</span>
			<span>
				<div class="big_green_defice"></div><span>Легкий доступ</span>
			</span>
		</div>
		<?php
			$text_offer = "Заказать цена от 350 р/м.п";
			include "templates/zakaz_offer_block.php";
		?>
	</div>
</div>


<div class="price_section">
	<div class="vert_line_cont device_vert">
		<div class="vert_line"></div>
	</div>
	<div class="heder_present" style="position: relative; z-index: 2;">
		<h1>Цены</h1>
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
					$res =  $GLOBALS['db']->query("SELECT * FROM product WHERE id IN (1,2,3,4,6,7,12,13,14,15)");
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
			<span>Обновлено <?php $r =  $GLOBALS['db']->query("SELECT date FROM UpdatePriseData WHERE namePrise = 'shadowProf'");
			 echo $r->fetchArray(SQLITE3_ASSOC)['date']; ?></span>
		</div>
	</div>
</div>
