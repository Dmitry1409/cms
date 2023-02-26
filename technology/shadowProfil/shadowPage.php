
	
<div class="vert_line_cont device_vert">
	<div class="vert_line"></div>
</div>
<div class="heder_present" style="position: relative; z-index: 2;">
	<span>Теневой с подсветкой</span>
</div>


<div class="lightsLines_flex">
	<div class="lights_img_cont">
		<picture>
			<source srcset="../../img/a9e89e81-915e-4292-a88a-069c649eaa7b.webp" type="image/webp">
			<img src="../../img/a9e89e81-915e-4292-a88a-069c649eaa7b.jpg" alt="Парящие и теневые потолки">
		</picture>
	</div>
	<div class="lights_text">
		<span>Благодаря наличию большой разновидности всевозможный стеновых профилей можно создавать
			декоративную подсветку примыкание потолка к стене и теневой зазор, что придает объем потолку.
			Выбирая наш парящий профиль вы получаете два в одном и декоративную подсветку и теневой профиль.
			Также есть профиля просто теневые, без возможности установки светодиодной ленты. Они отлично
			подходят практически для всех помещений. Это хорошо смотрится когда поверхность стены
			имеет декоративную текстуру или же это может быть стена с красивыми обоями или допустим глянцевая
			плитка в ванной.</span>
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
	include "../../templates/exampWorkFoto.php";
?>


<div class="vert_line_cont device_vert">
	<div class="vert_line"></div>
</div>
<div class="heder_present" style="position: relative; z-index: 2;">
	<span>Виды профилей</span>
</div>

<div class="types_prof_cont">
	<div class="types_row">
		<picture>
			<?php
				$res = $db->query('SELECT * FROM product WHERE id = 1')->fetchArray(SQLITE3_ASSOC);
			?>
			<p>Теневой</p>
			<source type="image/webp" srcset=<?php echo "../../".$res['webp'];?> >
			<img alt="Профиль теневой" src=<?php echo '../../'.$res['jpg'];?> >
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
				$res = $db->query('SELECT * FROM product WHERE id = 2')->fetchArray(SQLITE3_ASSOC);
			?>
			<p>Парящий</p>
			<source type="image/webp" srcset=<?php echo "../../".$res['webp']; ?> >
			<img alt="Парящий профиль" src=<?php echo "../../".$res['jpg'];?> >
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
				$res = $db->query('SELECT * FROM product WHERE id = 3')->fetchArray(SQLITE3_ASSOC);
			?>
			<p>Контурный</p>
			<source type="image/webp" srcset=<?php echo "../../".$res['webp']; ?> >
			<img alt="Контурный профиль" src=<?php echo "../../".$res['jpg'];?> >
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
				$res = $db->query('SELECT * FROM product WHERE id = 4')->fetchArray(SQLITE3_ASSOC);
			?>
			<p>Контурный-теневой</p>
			<source  type="image/webp" srcset=<?php echo "../../".$res['webp']; ?>>
			<img alt="Контурно-теневой профиль" src=<?php echo "../../".$res['jpg'];?> >
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
					$res = $db->query("SELECT * FROM product WHERE id IN (1,2,3,4,6,7,12,13,14,15)");
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
			<span>Обновлено <?php $r = $db->query("SELECT date FROM UpdatePriseData WHERE namePrise = 'shadowProf'");
			 echo $r->fetchArray(SQLITE3_ASSOC)['date']; ?></span>
		</div>
	</div>
</div>
