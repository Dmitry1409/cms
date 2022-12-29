<div class="vert_line_cont device_vert">
	<div class="vert_line"></div>
</div>
<div class="heder_present" style="position: relative; z-index: 2;">
	<span>Световые ниши</span>
	<span>ультро-современное решение</span>
</div>
<div class="slott_cont">
	<picture class="slott_item">
		<source srcset="../../img/lightNichesPage/tild3538-3932-4331-a231-636536356563__photo.webp" type="image/webp">
		<img src="../../img/lightNichesPage/tild3538-3932-4331-a231-636536356563__photo.jpg" alt="Световые ниши">
	</picture>
	<picture class="slott_item">
		<source srcset="../../img/lightNichesPage/profili-slott-1024x768.webp" type="image/webp">
		<img src="../../img/lightNichesPage/profili-slott-1024x768.jpg" alt="Световые ниши черно белый пофиль">
	</picture>
</div>

<p class="intro_slott_text">Световые ниши- современное эстетическое решение для оформления потолка и освещения. Наши ниши могут выполнять три задачи: добавляют интересные формы вашему потолку, придают объем и глубину. Переход с профиля на пвх полотно выполнен при помощи демпферной системы и выглядит очень аккуратно не используя лишних элементов. При использовании различных вариантов светодиодной ленты и контроллеров можно регулировать освещенность, световую температуру, RGB свет, анимацию.</p>

<div class="vert_line_cont device_vert">
	<div class="vert_line"></div>
</div>
<div class="heder_present" style="position: relative; z-index: 2;">
	<span>Варианты исполнения</span>
</div>

<div class="veri_exe_cont">
	<div class="veri_item">
		<h3>Белый</h3>
		<picture class="veri_pict">
			<source srcset="../../img/lightNichesPage/slot-white-1.webp" type="image/webp">
			<img src="../../img/lightNichesPage/slot-white-1.jpg" alt="Белый профиль световые ниши">
		</picture>
	</div>
	<div class="veri_item">
		<h3>Темный</h3>
		<picture class="veri_pict">
			<source srcset="../../img/lightNichesPage/slot-black-1.webp" type="image/webp">
			<img src="../../img/lightNichesPage/slot-black-1.jpg" alt="Черный профиль световые ниши">
		</picture>
	</div>
	<div class="veri_item">
		<h3>Тёмно-белый</h3>
		<picture class="veri_pict">
			<source srcset="../../img/lightNichesPage/slot-white-black-1.webp" type="image/webp">
			<img src="../../img/lightNichesPage/slot-white-black-1.jpg" alt="Темно-белый профиль световые ниши">
		</picture>
	</div>
</div>

<?php

	$query = "SELECT id_img FROM hashTags WHERE name = 'световые ниши'";
	$hashsSelect = ['#световые ниши'];
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
					$res = $db->query("SELECT * FROM product WHERE id IN (16,17,13,12,9,8,7,6)");
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
			<span>Обновлено <?php $r = $db->querySingle("SELECT date FROM UpdatePriseData WHERE namePrise = 'lightNiches'"); echo $r;?></span>
		</div>
	</div>
</div>




