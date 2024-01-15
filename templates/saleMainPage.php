<div style="display: flex; margin-top: 50px; justify-content: center; position: relative;">
	<div class="vert_line"></div>
</div>
<div class="heder_present" style="position: relative; z-index: 2;">
	<span class="sale_anim">Акция</span>
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

	<div class="aferta_block sales_block">
		<div class="sale_flag">8500 руб. <br> под ключ</div>
		<div class="cont_img_sales">
			<img style="border-radius: 4px;" src="img/sales/Q5yfRA34DK4.jpg">
		</div>
		<h4>Матовый потолок 14 м2 за 8500 руб. с установкой</h4>
		
		<div class="serv_cont_saleMainPage">
			<div>
				<svg width="15px" height="15px" id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" xml:space="preserve" fill="white" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><style type="text/css">
				</style><g><polygon points="434.8,49 174.2,309.7 76.8,212.3 0,289.2 174.1,463.3 196.6,440.9 196.6,440.9 511.7,125.8 434.8,49     "/></g>
				</svg>
				<span class="text_sale_cart">Установка люстры</span>
			</div>
			<div>
				<svg width="15px" height="15px" id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" xml:space="preserve" fill="white" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><style type="text/css">
				</style><g><polygon points="434.8,49 174.2,309.7 76.8,212.3 0,289.2 174.1,463.3 196.6,440.9 196.6,440.9 511.7,125.8 434.8,49     "/></g>
				</svg>
				<span class="text_sale_cart">Установка полотна</span>
			</div>
			<div>
				<svg width="15px" height="15px" id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" xml:space="preserve" fill="white" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><style type="text/css">
				</style><g><polygon points="434.8,49 174.2,309.7 76.8,212.3 0,289.2 174.1,463.3 196.6,440.9 196.6,440.9 511.7,125.8 434.8,49     "/></g>
				</svg>
				<span class="text_sale_cart">Обвод трубы</span>
			</div>
			<div>
				<svg width="15px" height="15px" id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" xml:space="preserve" fill="white" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><style type="text/css">
				</style><g><polygon points="434.8,49 174.2,309.7 76.8,212.3 0,289.2 174.1,463.3 196.6,440.9 196.6,440.9 511.7,125.8 434.8,49     "/></g>
				</svg>
				<span class="text_sale_cart">Маскировочная лента</span>
			</div>
			<div>
				<svg width="15px" height="15px" id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" xml:space="preserve" fill="white" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><style type="text/css">
				</style><g><polygon points="434.8,49 174.2,309.7 76.8,212.3 0,289.2 174.1,463.3 196.6,440.9 196.6,440.9 511.7,125.8 434.8,49     "/></g>
				</svg>
				<span class="text_sale_cart">Полотно матовое</span>
			</div>
		</div>
		<span>Акция действует до <?php echo $tar_date;?></span>
		<div role="button" class="aferta_btn sales_btn_click">Оставить заявку</div>
	</div>