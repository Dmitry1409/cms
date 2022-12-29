
<div style="display: flex; justify-content: center; margin-top: 50px;">
	<div class="vert_line"></div>
</div>
<div class="heder_present" style="position: relative; z-index: 2;">
	<span>Свет</span>
</div>


	<!--  // ('споты', 'споты с подсветкой','споты влагозащищенные', 'светильники', 'лента', 'светильники с датчиками', 'влагозащитные светильники', 'трековые светильники', 'питание 12v', 'контроллеры', 'лампы')
 -->


<div class="contrBtnContLight">
	<div role="button" class="btnLighting btnActivLighting" id="BtnAll" data-category="все">все</div>
	<div role="button" class="btnLighting" data-category="споты">споты</div>
	<div role="button" class="btnLighting" data-category="споты с подсветкой">споты + подсветка</div>
	<div role="button" class="btnLighting" data-category="светильники">светильники</div>
	<div role="button" class="btnLighting" data-category="споты влагозащищенные">споты + влагозащита</div>
	<div role="button" class="btnLighting" data-category="светильники с датчиками">светильники + датчики</div>
	<div role="button" class="btnLighting" data-category="питание 12v">питание 12v</div>
	<div role="button" class="btnLighting" data-category="влагозащитные светильники">светильники + влагозащита</div>
	<div role="button" class="btnLighting" data-category="лампы">лампы</div>
	<div role="button" class="btnLighting" data-category="трековые светильники">трековые светильники</div>
	<div role="button" class="btnLighting" data-category="контроллеры">контроллеры</div>
	<div role="button" class="btnLighting" data-category="лента">светодиодная лента</div>
</div>

<div class="sortCont">
	<div role="button" class="sortItem">цены по возрастанию</div>
	<div role="button" class="sortItem">цены по убыванию</div>
</div>


<div class="catalogProductGrid">
	<?php
		$arr = [];
		$res = $db->query("SELECT * FROM toledoProducts");
		while($r = $res->fetchArray(SQLITE3_ASSOC)){
			$arr[] = $r;
		}
		shuffle($arr);
		$_SESSION['toledoAllprod'] = $arr;

		for($i=0; $i<12; $i++){
			$pr = $arr[$i]['prise'];
			if($arr[$i]['ratio_prise'][0]=="+"){
				$pr = ceil($pr + substr($arr[$i]['ratio_prise'], 2));
			}
			echo "<div class='catalogProdItem'>";
				echo "<div>";
					echo "<div class='catalogImgCont'>";
						$p = '../img/lightingPage/product/'.$arr[$i]['src'];
						echo "<img src=$p>";
					echo "</div>";
					echo "<div class='catalDescriptCont'>";
						echo "<div class='brand-cont'>";
							echo "<span>Код: ".$arr[$i]['code']."</span>";
							echo "<span>".$arr[$i]['brand']."</span>";
						echo "</div>";
						echo "<div class='name-cont'>";
							echo $arr[$i]['name'];
						echo "</div>";
					echo "</div>";
				echo "</div>";

				echo "<div>";
					echo "<div class='prise-cont'>";
						echo "<div>";
							echo "<span>$pr</span>";
							echo "<span>руб/".$arr[$i]['ед_изм']."</span>";
						echo "</div>";
						if($arr[$i]['наличие'] > 0){
							echo "<span>В наличии<br>".$arr[$i]['наличие']." шт.</span>";
						}else{
							echo "<span>Под заказ</span>";
						}
					echo "</div>";
					echo "<div class='basket-cont'>";
						echo "<div class='count-cont'>";
							echo "<span role='button'>&ndash;</span>";
							echo "<input type='text' maxlength='4' value=1>";
							echo "<span role='button'>+</span>";
						echo "</div>";
						echo "<div role='button' class='btn-basket'>В избранное</div>";
					echo "</div>";
				echo "</div>";
			echo "</div>";
		}

	?>
</div>
<div class="FPcountCont">
	<span><span>12</span> из <span><?php echo count($arr)?></span></span>
</div>

<div role="button" class="arrow-wrapp">	
	<div class="FPcontArrow">
		<div class="arrow-8"></div>
	</div>
</div>

<div class="note_ware">
	<h5>* Наличие и возможность заказа товара уточняйте у менеджера.<br>* Срок поставки товара при заказе варьируется от 5 до 10 дней и могут быть увеличены.</h5>
</div>

<?php
	$query = "все";
	$hashsSelect = ['#все'];
	include "../templates/exampWorkFoto.php";
?>
