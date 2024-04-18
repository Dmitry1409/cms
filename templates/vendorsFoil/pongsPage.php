<div class="padd_calcult"></div>
<div style="display: flex; justify-content: center; position: relative; margin-top: 50px;">
	<div class="vert_line"></div>
</div>
<?php
	$v = $GLOBALS['db']->querySingle("SELECT price FROM product WHERE id = 59");
?>
<div class="heder_present" style="position: relative; z-index: 2; margin-bottom: 50px;">
	<h1>Pongs <?php echo $v?> руб/м2</h1>
</div>

<div class="text_cont">	
	<p>Продукция компании Pongs (Понгс) – эталон качества натяжных потолков. Модельный ряд представлен матовыми, глянцевыми и сатиновыми фактурами.</p>

	<p>Возможно нанесение фотопечати.</p>

	<p>Вся пленка проходит серьезную экологическую проверку, что подтверждается сертификатами RoHS, EN71-3, REACH.</p>

	<p>Полотно от производителя Pongs - это не только немецкое качество, но и эксклюзивная деталь вашего будущего интерьера: натяжные одноуровневые или многоуровневые потолки по индивидуальному проекту будут радовать вас долгие годы.</p>

	<?php
		$text_offer = "Заказать цена от 480 р/м2";
		include "templates/zakaz_offer_block.php";
	?>

	<h2>Преимущества и особенности</h2>

	<p>Контроль качества продукции происходит всё время – пока сырьё перерабатывается в готовое полотно.</p>

	<p>Плёнка демонстрирует отличные стандартные качества, такие как:</p>

	<div class="note_defise">
		<div class="green_defise"></div>
		<p>Толщина полотна – 0.15 – 0.16 мм. Максимальная ширина – 3.25 м. Позволяет без швов перекрывать площадь до 3 метров.</p>
	</div>
	<div class="note_defise">
		<div class="green_defise"></div>
		<p>Варианты исполнения: матовый, глянцевый, сатиновый.</p>
	</div>
	<div class="note_defise">
		<div class="green_defise"></div>
		<p>Потолок может быть не только белый, но и цветной. Число цветов и оттенков превышает 150 шт.</p>
	</div>

	<p>В итоге немецкие натяжные потолки выигрывают у своих конкурентов. Кроме хорошей звукоизоляции, покрытие:</p>

	<div class="note_defise">
		<div class="green_defise"></div>
		<p>Без запаха, не выделяет токсинов, не горит.</p>
	</div>
	<div class="note_defise">
		<div class="green_defise"></div>
		<p>Прочное, надёжное. Удерживает до 100 л воды на 1м2, что подтверждает его долговечность.</p>
	</div>
	<div class="note_defise">
		<div class="green_defise"></div>
		<p>Не распространяет грибок и плесень. Легко моется.</p>
	</div>

</div>

<?php
	$query = "все";
	$hashsSelect = ['#все'];
	include "templates/exampWorkFoto.php";
?>

