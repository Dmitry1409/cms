<div style="display: flex; margin-top: 50px; justify-content: center; position: relative;">
	<div class="vert_line"></div>
</div>
<div class="heder_present" style="position: relative; z-index: 2;">
	<h1 class="sale_anim">Выбери акцию</h1>
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
			$m_text ="Мая";
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

	<div class="aferta_block sales_block">
		<div class="contr_sale_mp">
			<div class="sale_ContrlItem left_btn_sale">
				<div></div>
			</div>
			<div class="bannPoint_sale sale_point_id">
				<div class="banPointAct_sale"></div>
			</div>
			<div class="sale_ContrlItem right_btn_sale">
				<div></div>
			</div>
		</div>
		<div class="cont_img_sales">
			<img class="img_absol_sale_mp" style="border-radius: 4px;" src="img/sales/dfgdge24g2rgg2.jpg">
			<img class="img_hiden_sale_mp" style="border-radius: 4px;" src="img/sales/dfgdge24g2rgg2.jpg">
		</div>
		<div style="position: relative; height: 110px; margin-bottom: 20px;">
			<h2 class="zagolov_sale_mp">Каждый третий потолок в подарок</h2>
		</div>

		<span style="margin-bottom: 20px;">Подробности уточняете по телефону. Записывайтесь на бесплатный замер.</span>
		<span style="color: white;">Акции действуют до <?php echo $tar_date;?></span>
		<div role="button" class="aferta_btn sales_btn_click">Оставить заявку</div>
	</div>