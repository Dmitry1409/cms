<div class="vert_line_cont">
	<div class="vert_line"></div>
</div>
<div class="heder_present" style="position: relative; z-index: 2;">
	<h1>Световой потолок</h1>
	<span>современное решение для вашего интерьера</span>
</div>

<div class="lightsLines_flex">
	<div class="lights_img_cont">
		<picture>
			<source srcset="../img/svetovoyPotolokPage/svetovoyPotolok.webp" type="image/webp">
			<img src="../img/svetovoyPotolokPage/svetovoyPotolok.jpg" alt="фото светового потолка">
		</picture>
	</div>
	<div class="lights_text">
		<span>Хотите вызывать восторг у всех гостей вашего дома? Хотите ли вы самое современное решение в качестве основного или декоративного освещения? Тогда световой потолок точно оправдает ваши ожидания. Он отлично впишется в любой интерьер и будет выполнять свои функции с 15 летней гарантией от нашей компании.</span>
		<?php
			$text_offer = "Заказать цена от 2550 р/м2";
			include "templates/zakaz_offer_block.php";
		?>
		<p class="green_defice">Преимущества: </p>
		<div class="advan_cont">
			<span>
				<span class="green_defice">&mdash;</span> <span>&nbsp;Равномерный свет на всей площади помещения</span>
			</span>
			<span>
				<span class="green_defice">&mdash;</span> <span>&nbsp;Возможна регулировка яркости света</span>
			</span>
			<span>
				<span class="green_defice">&mdash;</span> <span>&nbsp;Можно комбинировать с другими технологиями потолков</span>
			</span>
			<span>
				<span class="green_defice">&mdash;</span> <span>&nbsp;Гарантия 15 лет на свет</span>
			</span>
			<span>
				<span class="green_defice">&mdash;</span> <span>&nbsp;Такого точно ни у кого нет :-)</span>
			</span>
		</div>
	</div>
</div>

<div class="vert_line_cont device_vert">
	<div class="vert_line"></div>
</div>
<div class="heder_present" style="position: relative; z-index: 2;">
	<h1>Световое окно</h1>
	<span>c фотопечатью, duble Vision</span>
</div>

<div class="lightsLines_flex row-reverse">
	<div class="lights_img_cont">
		<picture>
			<source srcset="../img/svetovoyPotolokPage/svetovoyPotolokNebo.webp" type="image/webp">
			<img src="../img/svetovoyPotolokPage/svetovoyPotolokNebo.jpg" alt="Световой потолок с фотопечатью">
		</picture>
	</div>
	<div class="lights_text">
		<span>Благодаря возможности напечатать на светопропускном полотне практически любого изображения в высоком разрешении позволяет создавать не повторимую атмосферу для любого помещения совмещая при этом основной источнык света без использования спотов и люстр. Изображение остаеться в хорошем качестве на весь срок службы потолка радуя вас своими насыщенными цветами.</span>

		<?php
			$text_offer = "Заказать цена от 2750 р/м2";
			include "templates/zakaz_offer_block.php";
		?>

		<p class="green_defice">Преимущества: </p>
		<div class="advan_cont">
			<span>
				<span class="green_defice">&mdash;</span> <span>&nbsp;Огромный католог изображений</span>
			</span>
			<span>
				<span class="green_defice">&mdash;</span> <span>&nbsp;Многокрано увеличивает объем помещения</span>
			</span>
			<span>
				<span class="green_defice">&mdash;</span> <span>&nbsp;Высокое качество изоброжения</span>
			</span>
		</div>
	</div>
</div>

<?php

	$query = "SELECT id_img FROM hashTags WHERE name = 'световой потолок'";
	// $key_session = 'ligthLineImg';
	$hashsSelect = ['#световой потолок'];
	include "templates/exampWorkFoto.php";
?>