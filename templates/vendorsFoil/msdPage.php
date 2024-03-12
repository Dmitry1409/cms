<div class="padd_calcult"></div>
<div style="display: flex; justify-content: center; position: relative; margin-top: 50px;">
	<div class="vert_line"></div>
</div>
<?php
	$v = $GLOBALS['db']->querySingle("SELECT price FROM product WHERE id = 54");
?>
<div class="heder_present" style="position: relative; z-index: 2; margin-bottom: 50px;">
	<h1>MSD-Premium <?php echo $v?> руб/м2</h1>
</div>

<div class="text_cont">	
	<p>MSD-Premium – ПВХ-пленка для натяжных потолков от одного из крупнейших производителей натяжных полотен – MSD. Завод-изготовитель расположен в Китае и оснащен современным европейским и японским оборудованием. Однако производство сырья для потолочной пленки МСД линейки Премиум организовано в Тайвани, что обусловлено повышенными требованиями к экологичности полотна.</p>
</div>
<div class="img_cont">
	<img src="../img/vendorsFoilPage/msdPremium.jpg">
</div>
<div class="text_cont">
	<h2>О заводе MSD</h2>
	<p>Компания MSD присутствует на рынке производителей натяжных потолков с 2002 года. За это время  изготовитель заслужил авторитет и теперь вполне способен составить конкуренцию многим старейшим изготовителям. Вся продукция подвергается строгому контролю качества, организованному по европейским стандартам.</p>

	<div class="note_defise">
		<div class="green_defise"></div>
		<p>Потолки марки Pongs изготавливаются именно на заводе MSD. Что лишний раз говорит о высочайшем качестве продукции этого производителя.</p>
	</div>

	<p>Пленка MSD Premium изготавливается из особого сырья с использованием специального экологичного пластификатора DOTP. Такой потолок не выделяет запаха после установки и безопасен для здоровья, что подтверждается успешным прохождением сертификаций REACH, RoHS, EN-71. То есть разрешена установка в детских и медицинских организациях.</p>

	<div class="note_defise">
		<div class="green_defise"></div>
		<p>Натяжные потолки из пленки MSD-Premium разрешено устанавливать в детских и медицинских учреждениях.</p>
	</div>

	<p>Главными же преимуществами полотен MSD серии Premium является ширина, достигающая 5,1 метра и внушительный выбор цветов (более 120 расцветок) и охват самых популярных фактур: матовой, сатиновой и глянцевой. Такими сочетанием характеристик могут похвастаться далеко не все европейские производители.</p>

	<h2>Характеристики</h2>

	<div class="note_defise">
		<div class="green_defise"></div>
		<p>Ширина полотна от 1,4 до 5,1 м.</p>
	</div>
	<div class="note_defise">
		<div class="green_defise"></div>
		<p>Толщина до 0,18 - 0,21 мм</p>
	</div>
	<div class="note_defise">
		<div class="green_defise"></div>
		<p>Температурный диапазон эксплуатации от +3 до +50С.</p>
	</div>
	<div class="note_defise">
		<div class="green_defise"></div>
		<p>Выдерживает до 100 л воды на 1 м2 при затоплении.</p>
	</div>
	<div class="note_defise">
		<div class="green_defise"></div>
		<p>Не теряет свойств при длительной эксплуатации.</p>
	</div>
	<div class="note_defise">
		<div class="green_defise"></div>
		<p>Более 120 расцветок (только для модели МСД Premium).</p>
	</div>
	<div class="note_defise">
		<div class="green_defise"></div>
		<p>ПВХ смола 75%.</p>
	</div>
	<div class="note_defise">
		<div class="green_defise"></div>
		<p>Пластификатор DOTP 24,5%.</p>
	</div>
	<div class="note_defise">
		<div class="green_defise"></div>
		<p>Антибактериальные и противогрибковые добавки 0,5%</p>
	</div>
	<div class="note_defise">
		<div class="green_defise"></div>
		<p>Хорошая эластичность.</p>
	</div>
	<div class="note_defise">
		<div class="green_defise"></div>
		<p>Класс пожаробезопасности КМ4.</p>
	</div>

	<h2>Сертификат соответствия</h2>
	<div class="img_cont">
		<img src="../img/vendorsFoilPage/sertifikat-eckologia-msd-fsmmw.jpg">
	</div>

	<h2>Отличия Premium от Classic</h2>
	<div class="price_table">
		<table>
			<thead>
				<tr>
					<td>MSD Premium</td>
					<td>MSD Classic</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Сырье производится в Тайване</td>
					<td>Сырье производится в Китае</td>
				</tr>
				<tr>
					<td>Зеркальность глянцевых полотен - 95-99%</td>
					<td>Зеркальность глянцевых полотен - 91-94%</td>
				</tr>
				<tr>
					<td>Матовость фактур Мат и Сатин - 4-4,5%</td>
					<td>Матовость фактур Мат и Сатин - 3,5-3,9%</td>
				</tr>
				<tr>
					<td>Толщина полотен до 0,20 мм (зависит от фактуры)</td>
					<td>Толщина полотен до 0,20 мм в (зависит от фактуры)</td>
				</tr>
				<tr>
					<td>Средний ценовой сегмент</td>
					<td>Самые дешевые</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>

<?php
	$query = "все";
	$hashsSelect = ['#все'];
	include "templates/exampWorkFoto.php";
?>