<div style="display: flex; margin-top: 50px; justify-content: center; position: relative;">
	<div class="vert_line"></div>
</div>
<div class="heder_present" style="position: relative; z-index: 2;">
	<h1>Спец. предложения</h1>
</div>


<?php
	$s = $GLOBALS['db']->query("SELECT * FROM cart_sale_offert");
	$ar = [];
	while($r = $s->fetchArray(SQLITE3_ASSOC)){
		$ar[] = $r;
	}
	shuffle($ar);
	$_SESSION['simple_Ceil'] = $ar;
	$out = array_slice($ar, 0, $out_count)

?>
<div class="cart_sale_out_wr">
	<div class="cart_sale_wrapp">
		<?php foreach($out as $val): ?>
			<div class="cart_ceil_ofert cart_ceil_id">	  
			    <div class="cart_sale_prise">
			    	<?php echo $val['prise']." руб.";?>
			    </div>
			    <div class="sales_img_cont">
			    	<img src='<?php echo {$GLOBALS['root_dir']}.$val["img_src"];?>'>
			    </div>
			    <div class="elem_cart_sale">
			    	<?php
			    		$j = json_decode($val['service']);
			    		foreach($j as $ser):
			    	?>
				    	<div>
				    		<svg width="15px" height="15px" id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><style type="text/css">
				    		.st0{fill:#41AD49;}
				    		</style><g><polygon class="st0" points="434.8,49 174.2,309.7 76.8,212.3 0,289.2 174.1,463.3 196.6,440.9 196.6,440.9 511.7,125.8 434.8,49     "/></g>
				    		</svg>
				    		<span class="text_sale_cart">
				    			<?php echo $ser; ?>
				    		</span>
				    	</div>
				    <?php endforeach; ?>
			    </div>
			    <div>
			    	<div class="cart_sale_btn">Заказать</div>
			    	<?php $d = date("d"); $m = date("m"); $y=date("y"); ?>
			    	<p class="text_sale_cart">Актуально на <?php echo "{$d}.{$m}.{$y}г."; ?></p>
			    </div>
			</div>
		<?php endforeach; ?>
	</div>
	<div class="FPcountCont count_sale_id">
		<span><span><?php echo $out_count?></span> из <span><?php echo count($ar)?></span></span>
	</div>

	<div role="button" class="arrow-wrapp">	
		<div class="FPcontArrow add_cart_sale_id">
			<div class="arrow-8"></div>
		</div>
	</div>
</div>