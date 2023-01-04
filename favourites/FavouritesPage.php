<div style="display: flex; justify-content: center; margin-top: 50px;">
	<div class="vert_line"></div>
</div>
<div class="heder_present" style="position: relative; z-index: 2;">
	<span>Выбранные товары</span>
</div>

<?php

if(array_key_exists('buyProducts', $_SESSION)){
	$arr_prod = $_SESSION['buyProducts'];

	$q = "SELECT * FROM ToledoProducts WHERE code in (";

	for($i=0; $i<count($arr_prod); $i++){
		$q = $q."'".$arr_prod[$i]->code."'";
		if($i == count($arr_prod)-1){
			$q = $q.')';
		}else{
			$q = $q.",";
		}
	}

	$res = $db->query($q);
	$val = [];
	while($r = $res->fetchArray(SQLITE3_ASSOC)){
		for($j=0; $j<count($arr_prod); $j++){
			if($r['code'] == $arr_prod[$j]->code){
				$r['amount'] = $arr_prod[$j]->amount;
				break;
			}
		}
		$val[] = $r;
	}

	echo "<div class='grid_ware'>";

		for($i=0; $i<count($val); $i++){
			$cat = $val[$i]['category'];
			echo "<div data-category-prod=$cat class='catalogProdItem'>";
				echo '<svg version="1.1" class="delProdSvgBtn" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="15px" height="15px" viewBox="0 0 612.043 612.043" style="enable-background:new 0 0 612.043 612.043;" xml:space="preserve" fill="rgba(138, 212, 17, 0.60)">
					<g id="cross">
					<path d="M397.503,306.011l195.577-195.577c25.27-25.269,25.27-66.213,0-91.482c-25.269-25.269-66.213-25.269-91.481,0
					L306.022,214.551L110.445,18.974c-25.269-25.269-66.213-25.269-91.482,0s-25.269,66.213,0,91.482L214.54,306.033L18.963,501.61
					c-25.269,25.269-25.269,66.213,0,91.481c25.269,25.27,66.213,25.27,91.482,0l195.577-195.576l195.577,195.576
					c25.269,25.27,66.213,25.27,91.481,0c25.27-25.269,25.27-66.213,0-91.481L397.503,306.011z"></path>
					</g>
					</svg>';
				echo "<div>";
					echo "<div class='catalogImgCont'>";
						$p = '../img/lightingPage/product/'.$val[$i]['src'];
						echo "<img src=$p>";
					echo "</div>";
					echo "<div class='catalDescriptCont'>";
						echo "<div class='brand-cont'>";
							echo "<span>Код: ".$val[$i]['code']."</span>";
							echo "<span>".$val[$i]['brand']."</span>";
						echo "</div>";
						echo "<div class='name-cont'>";
							echo $val[$i]['name'];
						echo "</div>";
					echo "</div>";
				echo "</div>";

				echo "<div>";
					echo "<div class='prise-cont'>";
						echo "<div>";
							echo "<span>".$val[$i]['prise']."</span>";
							echo "<span>руб/".$val[$i]['ед_изм']."</span>";
						echo "</div>";
						echo "<span>".$val[$i]['наличие']."</span>";
					echo "</div>";
					echo "<div class='basket-cont'>";
						echo "<div class='count-cont'>";
							echo "<span>&ndash;</span>";
							echo "<input type='text' maxlength='4' value=".$val[$i]['amount'].">";
							echo "<span>+</span>";
						echo "</div>";
						$sum = $val[$i]['prise']*$val[$i]['amount'];
						if($val[$i]['ед_изм'] == "м.п."){
							$sum = ($val[$i]['prise']*5)*$val[$i]['amount'];
						}
						echo "<div class='sum-ware'><span>".$sum."</span>";
							echo "<span><br>руб.</span>";
						echo "</div>";
					echo "</div>";
				echo "</div>";
			echo "</div>";
		}
	echo "</div>";

	echo "<div class=zakazCont>";
		echo "<div role='button' class=zakazWrapp>";
			echo "<h3>Заказать все товары</h3>";
			echo "<div class=calc_btn><div class=btn_animate></div>Отправить</div>";
		echo "</div>";
	echo "</div>";
}else{
	echo "<h2>Пусто</h2>";
}

?>
<div style="display: flex; justify-content: center; margin-top: 50px;">
	<div class="vert_line"></div>
</div>
<div class="heder_present" style="position: relative; z-index: 2;">
	<span>Вам понравилось</span>
</div>

<?php

if(array_key_exists("favourImg", $_SESSION)){
	if(count($_SESSION['favourImg'])>0){
		include "favourExamFotoTemplate.php";
	}else{
		echo "<h2>Пусто</h2>";
	}
}else{
	echo "<h2>Пусто</h2>";
}

?>