
<div class="vert_line_cont device_vert">
	<div class="vert_line"></div>
</div>
<div class="heder_present" style="position: relative; z-index: 2;">
	<span>Делаем все виды<br> конструкций</span>
</div>

<div class="choiceConfSection">

	<div class="choiseCofpagWrapp">
		<p>Существует большой выбор вариантов исполнения перехода с одного уровня на другой.
			Можно применить специальные профили для конструкции, а можно обойтись и без них.
			Есть три основных вида исполнения профиля это без щелевой переход, теневой переход и переход с подсветкой.
			Далее приведены краткое описание и вид этих профилей.
		</p>
	</div>

	<?php

		$query = "SELECT id_img FROM hashTags WHERE name = 'двухуровневый'";
		$key_session = 'multiLevImg';
		$hashsSelect = ['#двухуровневый'];
		include "templates/exampWorkFoto.php";
	?>


	<h3 style="margin-top: 100px;">Без щелевой переход</h3>
	<div class="noChelCont">
		<div class="NoChelRow">
			<picture>
				<source srcset='<?php echo $GLOBALS["root_dir"]."img/rendered/webp/jsjjwjldvnvnsnl.webp" ?>' type="image/webp">
				<img src='<?php echo $GLOBALS["root_dir"]."img/rendered/jpg/jsjjwjldvnvnsnl.jpg"?>' alt="Без щелевой профиль">
			</picture>
		</div>
		<div class="NoChelRow">
			<p>Особенность этого профиля заключается в том, что переход с одного уровня на другой
			 выполнен без каких либо зазоров и теневых щелей. Все выглядит аккуратно эстетично.
			Такой вид перехода можно выполнить только при помощи этого спец. профиля.</p>
			<div>
				<span>
					<span class="green_defice">&mdash;</span> <span>&nbsp;Аккуратный ровный переход</span>
				</span>

				<span>
					<span class="green_defice">&mdash;</span> <span>&nbsp;Нет лишних элементов</span>
				</span>
				<span>
					<span class="green_defice">&mdash;</span> <span>&nbsp;Менее затратный</span>
				</span>
			</div>
		</div>			
	</div>

	<div class="padd_calcult"></div>

	<h3>Теневой переход</h3>
	<div class="noChelCont row-rewers">
		<div class="NoChelRow">
			<picture>
				<source srcset='<?php echo $GLOBALS["root_dir"]."img/rendered/webp/vnwowonb.webp" ?>' type="image/webp">
				<img src='<?php echo $GLOBALS["root_dir"]."img/rendered/jpg/vnwowonb.jpg" ?>' alt="Без щелевой профиль">
			</picture>
		</div>
		<div class="NoChelRow">
			<p>В этом варианте исполнения особенностью является наличие теневого зазора между уровнями.
			Зазор получается около 2 см. Этот зазор предает отличный объем потолку, потолок как бы зависает
			в воздухе.</p>
			
			<div>
				<span>
					<span class="green_defice">&mdash;</span> <span>&nbsp;Придает объем</span>
				</span>

				<span>
					<span class="green_defice">&mdash;</span> <span>&nbsp;Современный вид</span>
				</span>
				<span>
					<span class="green_defice">&mdash;</span> <span>&nbsp;Эффект парящего потолка</span>
				</span>
			</div>
		</div>		
	</div>
	

	<h3>Переход с подсветкой</h3>
	<div class="noChelCont">
		<div class="NoChelRow">
			<picture>
				<source srcset='<?php echo $GLOBALS["root_dir"]."img/rendered/webp/gfdgdfdg.webp" ?>' type="image/webp">
				<img src='<?php echo $GLOBALS["root_dir"]."img/rendered/jpg/gfdgdfdg.jpg" ?>' alt="Без щелевой профиль">
			</picture>
		</div>
		<div class="NoChelRow">
			<p>Этот профиль практически такой же что и с теневым переходом, за исключением, что у него есть специальное
			место для размещения светодиодной монохромной или мульти-колорной ленты. Соответственно это профиль является 
			и теневым.</p>
			
			<div>
				<span>
					<span class="green_defice">&mdash;</span> <span>&nbsp;Придает объем</span>
				</span>
				<span>
					<span class="green_defice">&mdash;</span> <span>&nbsp;Эффект парящего потолка</span>
				</span>
				<span>
					<span class="green_defice">&mdash;</span> <span>&nbsp;Декоративная подсветка</span>
				</span>
			</div>
		</div>			
	</div>

	
</div>



<div class="vert_line_cont device_vert">
	<div class="vert_line"></div>
</div>
<div class="heder_present" style="position: relative; z-index: 2;">
	<span>Форма</span>
	<span>вид сверху</span>
</div>
<div class="wrapp_cont_svg">

	<div class="cont_svg">
		<div class="item_svg">
			<svg width="200" height="200" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>
				 
				<rect x='10' y="10" fill="url(#Pattern)" width="180" height="180" class="stroke_level" fill="none"/>
				<rect class="stroke_level" fill="white" x="96.5" y="32.5" width="55" height="115" rx="9.27" ry="9.27"/>
				<rect class="stroke_level" fill="white" x="32.09" y="32.67" width="39.77" height="39.85" rx="7.27" ry="7.27"/>
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="200" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>
				 
				<rect x='10' y="10" fill="url(#Pattern)" width="180" height="180" class="stroke_level" fill="none"/>
				<path class="stroke_level" fill="white" transform="translate(0, -1)" d="M130.5,190c29-36.2,16.07-70.82-1-107.6-14-30.17,8-71.4,8-71.4h-67s-22,41.23-8,71.4c17.07,36.78,30,71.4,1,107.6v.5h67"/>
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="200" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>
				 
				<rect x='10' y="10" width="180" height="180" class="stroke_level" fill="none"/>
				<path class="stroke_level" fill="url(#Pattern)" d="M10 50 L 75 190 H 10 z"/>
				<path class="stroke_level" fill="url(#Pattern" d="M 86 10 L 102 190 H 190 V 10 z" />
				
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="200" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>
				 
				<rect x='10' y="10" width="180" height="180" class="stroke_level" fill="url(#Pattern)"/>
				<path fill="white"class="stroke_level" d="M10.5,18.5a83,83,0,0,1,0,166"/>
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="200" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>
				 
				<rect x='10' y="10" width="180" height="180" class="stroke_level" fill="white"/>
				<path  class="stroke_level" fill="url(#Pattern)" d="M43.5,10c-12.78,16.72-9.82,26.7-9,29,5.94,16.71,39.17,22.95,63,15,17.63-5.88,19.77-16.07,36-17,11.13-.64,27.21,3.18,35,16,4.57,7.51,7.85,20.7,2,30-13.36,21.23-58.21-3.41-85,21-13.81,12.58-19.89,35.51-12,49,12.74,21.78,57.81,11.92,62,11,30.27-6.62,48.91-26.53,54-35 H190 V190 H10 V10 z" />
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="200" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>
				 
				<rect x='10' y="10" width="180" height="180" class="stroke_level" fill="white"/>
				<path fill="url(#Pattern)" class="stroke_level" d="M46.5,72c8.07-26.34,48.68-34.89,66-19,7.48,6.86,4.58,12.74,15,27.33,14.06,19.7,26.22,18.62,29,30.89,2.87,12.66-6.63,29-17,36.84-23.69,17.8-63.25-.74-82-30.89C53.28,110.36,40.86,90.39,46.5,72Z"/>
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="200" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>
				 
				<rect x='10' y="10" width="180" height="180" class="stroke_level" fill="url(#Pattern)"/>
				<polygon transform="translate(10, 10)" fill="white" class="stroke_level" points="113.76 30.48 31.03 114.58 140.15 144.55 113.76 30.48"/>
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="200" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>
				 
				<rect x='10' y="10" width="180" height="180" class="stroke_level" fill="url(#Pattern)"/>
				<rect class="stroke_level" fill="white" x="36.34" y="36.4" width="127" height="126.94" transform="translate(-40.92 103.1) rotate(-46.16)"/>
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="200" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>
				 
				<rect x='10' y="10" width="180" height="180" class="stroke_level" fill="white"/>
				<path class="stroke_level"fill="url(#Pattern)"d="M 10 10 h 90 L 10 100 z"/>
				<path class="stroke_level" fill="url(#Pattern)" d="M190 190 v-90 L100 190z"/>
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="200" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
			<defs>
			    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
			      <path d="M 30 0 L 0 30" class="fillPattern"/>
			    </pattern>
			</defs>

			 <rect x='10' y="10" width="180" height="180" fill="transparent" class="stroke_level"/>
			 <path fill="url(#Pattern)" class="stroke_level" d="M 100 10 v 20 q 0 15 -20 15 H 65 q -18 0 -20 15 v 70 q 0 15 -20 15 H 10 V 10 z" />
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="200" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>
				    <path id="path" transform="rotate(180)" class="stroke_level" d="M 100 10 v 20 q 0 15 -20 15 H 65 q -18 0 -20 15 v 70 q 0 15 -20 15 H 10 V 10 z" />
				    <path id="path2" class="stroke_level" d="M 100 10 v 20 q 0 15 -20 15 H 65 q -18 0 -20 15 v 70 q 0 15 -20 15 H 10 V 10 z" />
				</defs>
				<rect x='10' y="10" width="180" height="180" fill="transparent" class="stroke_level"/>
				<use  x="200" y="200" xlink:href="#path" fill="url(#Pattern)"/>
				<use  x="0" y="0" xlink:href="#path2" fill="url(#Pattern)"/>
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="200" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>
				</defs>
				 
				<rect x='10' y="10" width="180" height="180" fill="url(#Pattern)" clip-path="url(#clip)" class="stroke_level"/>
				<rect x="45" y="45" rx="10" ry ="10" width="110" height="110" class="stroke_level" fill="white"/>
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="200" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>
				</defs>		 
				<rect x='10' y="10" width="180" height="180" fill="url(#Pattern)" class="stroke_level"/>
				<rect transform-origin="center" transform="rotate(20)" x="50" y="50" rx="25" ry ="25" width="100" height="100" class="stroke_level" fill="white"/>
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="200" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>
				</defs>
				 
				<rect x='10' y="10" width="180" height="180" fill="url(#Pattern)" class="stroke_level"/>
				<rect transform-origin="center" transform="skewX(10) skewY(4)" x="45" y="45" rx="20" ry ="30" width="110" height="110" class="stroke_level" fill="white"/>
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="200" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>
				    <path id="path3" fill="url(#Pattern)" class="stroke_level" d="M35.18,51.53a9.09,9.09,0,0,1,6.37-.07q.38.15.75.33C47.85,54.54,60.74,66.56,61.5,76.5c1,13-14,28-8,46,5,15,5.14,15.66,18,21,11.67,4.85,35.48,1.85,47-5,11.21-6.67,24-13,32-3s10,20,0,36S133.92,187,133.92,187L10.5,186.5V60.5Z"/>
				</defs>
				 
				<rect x='10' y="10" width="180" height="180" class="stroke_level" fill="transparent"/>
				<use x="0" y="3" xlink:href="#path3" />
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="200" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>
				    
				</defs>
				 
				<rect x='10' y="10" width="180" height="180" class="stroke_level" fill="transparent"/>
				<path transform="translate(0, 3)" id="path" fill="url(#Pattern)" class="stroke_level" d="M117.36,7S124.5,39.5,85.5,64.5s-19,50-19,50,17,28,47,16c16.22-6.49,53-20,57,16s-4.11,40.5-4.11,40.5L10.5,186.5V6.5Z"/>
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="200" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>
				    
				</defs>
				 
				<rect x='10' y="10" width="180" height="180" class="stroke_level" fill="transparent"/>
				<path  id="path" fill="url(#Pattern)" class="stroke_level" d="M75.82,10 c-3.9,18.61-6.09,44.22-6.13,62.06-.23,18.35,1.7,28.92,1.68,29.11.32.06,4.86,17.28,19.95,20.86,14.11,5.28,38.75-3.07,56.76-14.82,35.18-22,42.07-12.94,42.43-14.34 V 180 10 z"/>
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="200" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>
				    
				</defs>
				 
				<rect x='10' y="10" width="180" height="180" class="stroke_level" fill="url(#Pattern)"/>
				<path transform="translate(0, 4)" fill="white" class="stroke_level" d="M154.1,101.21C152.69,108,143.65,112.93,141,119c-2.9,6.64-1,15.41-5.17,20.52-4.71,5.8-13.87,6.45-19.24,10.06-6,4-10.67,11.81-17,12s-11-7.43-17-11.25c-5.36-3.45-14.48-3.78-19.2-9.66-4.22-5.19-2.33-14.32-5.26-21.14-2.65-6.22-11.73-11.3-13.18-18.42s5.95-14.42,7-21c1.15-7.28-4.33-15.59-.8-21.64,4.1-6.92,16.65-9.1,23.7-13.11C82.63,40.81,89.24,32.82,99.45,33s16.82,8.44,24.64,13.16c7,4.2,19.56,6.76,23.65,13.63,3.54,6-1.89,13.92-.72,21C148.09,87.24,155.52,94.33,154.1,101.21Z"/>
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="200" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>
				    
				</defs>
				 
				<rect x='10' y="10" width="180" height="180" class="stroke_level" fill="url(#Pattern)"/>
				<path transform="translate(0, 4)" fill="white" class="stroke_level" d="M139.4,174.48c-4,4-6.87,2.26-9.61.29-2.41-1.73-5.93-3.27-9.07-5.8-2.58-2.08-5-5.49-9.05-5.92-4.24-.44-7.4,1.22-9.9,1.1-3.62-.17-6.08-2-9.7-2.18-2.5-.12-5.66,1.54-9.89,1.1-3.59-.37-6.49-1.71-8.62-.95-3.62,1.29-5.32,5.18-7.42,5.21-1.7,0-2.69-2.74-5.38-6.88s-6.5-6.09-8.21-8.52c-2.66-3.78-2.41-7-2.87-11.2-.31-2.83-2-6.42-1.48-11.63s3.45-8.57,4.79-11.59c1.8-4.08,2.3-7.69,4.11-11.77,1.33-3,4.23-6.23,4.79-11.59S59.93,85,58.78,81.69c-1.47-4.25-2-8.11-3.45-12.37-1.15-3.31-3.63-7-3.06-12.49.55-5.32,2.85-9,3.53-12.37.94-4.57.66-8.62,3.39-12.33,2-2.72,6.15-4.43,10-8.25,4-4,6.67-5.05,9.41-3,2.39,1.78,3.59,6.32,6.71,8.88,2.58,2.12,6.37,2.24,10.43,2.66,4.25.44,6.95,2.8,9.41,3.34,3.53.78,6.39-.22,9.92.55,2.47.54,5.16,2.9,9.41,3.34,3.85.4,6.46-2.29,8.91-3.67,3.26-1.84,6.5-2.82,8.67-4.06,2.38-1.36,4.9-2.41,8,2.32,3.2,4.9,2.24,8.39,1.71,11a33.91,33.91,0,0,1-3.89,10.59c-1.5,2.71-4.58,5.56-5.08,10.37-.54,5.23.8,9.17.29,12.22-.74,4.4-3.3,7.16-4,11.56-.51,3.05.83,7,.29,12.22-.56,5.39-2.3,9.28-1.83,12.52.64,4.4,3.77,7.3,4.92,11.73.83,3.21-.25,7.34.12,12.64.36,5.07,3,8.76,3.66,12.08,1,4.93-.08,8.39-1.27,12.22C144,166.37,143.44,170.43,139.4,174.48Z"/>
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="200" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>
				 
				<rect x='10' y="10" width="180" height="180" class="stroke_level" fill="none"/>
				<ellipse class="stroke_level"  cx="114.5" cy="140.5" rx="33" ry="22" transform-origin="center" transform="rotate(40)" fill="url(#Pattern)"/>
				<ellipse class="stroke_level"  cx="114.5" cy="55.5" rx="33" ry="22" transform-origin="center" transform="rotate(-40)" fill="url(#Pattern)"/>
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="200" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>
				 
				<rect x='10' y="10" width="180" height="180" class="stroke_level" fill="none"/>
				<path fill="url(#Pattern)" class="stroke_level" d="M54.5,10c-1.06,4.3-7.16,30.56,7,44.58,3.63,3.59,13.14,7.61,16,7.42,31-2,39.33-20.49,63-14,4.68,1.28,8.95,3.13,13,13,4.57,11.13-6.91,30.54-6,51.63.3,7-.22,29.45,7,36.37,12.35,11.84,35.85,4.49,37,4 H190 V 10 z"/>
				<path fill="url(#Pattern)" class="stroke_level" d="M10,117.5c19.26-8.1,40.08-4.14,50,8,13.33,16.31,8.42,49.15-19,65 V 190 H 10 z"/>
			</svg>
		</div>	
		<div class="item_svg">
			<svg width="200" height="200" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>			 
				<rect x='10' y="10" width="180" height="180" class="stroke_level" fill="url(#Pattern)"/>
				<path class="stroke_level" fill="white" d="M52.77,127c10.9,28.48,43.85,43.2,72.33,32.26,27.32-10.49,42.17-41.4,33.25-69.3A56.44,56.44,0,0,0,125.7,55V55C102,79,77,103,52.93,127" />
				<path class="stroke_level" fill="white" d="M44.33,118.38C69,95,93,70,117.05,46.42h0C85.3,33.8,48.67,53.51,41.68,86.94a56.35,56.35,0,0,0,2.49,31.5" />
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="200" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>			 
				<rect x='10' y="10" width="180" height="180" class="stroke_level" fill="url(#Pattern)"/>
				<path class="stroke_level" fill="white" d="M171.2,126.84s-13.12-3.75-16.46-7.33S160,92.19,138.19,92s-27.27-29.69-29.92-29.58S90.12,86.05,60.7,38.78h0a70.66,70.66,0,1,0,110.5,88.07" />
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="200" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>			 
				<rect x='10' y="10" width="180" height="180" class="stroke_level" fill="url(#Pattern)"/>
				<path class="stroke_level" fill="white" d="M190,61.67s-19.5-8.17-31.5-9.17-28-17-55-13-45-10-53,11C43.23,69.59,33.28,68,32.29,74.56,31,83.11,38,90.69,42.5,95.5c2.78,3,14.4,14.64,30.44,13.83,8-.4,13.64-3.73,20.56-7.83,15.32-9.06,17-17.59,29-20a29.16,29.16,0,0,1,15,1c10.74,3.75,15.68,13.56,19.3,19,2.84,4.27,4.41,9.66,8.7,23,4.53,14.09,10.7,18.43,15.72,19.27A13.91,13.91,0,0,0,190,142"/>
			</svg>
		</div>
	</div>
	<div class="cont_svg">
		<div class="item_svg">
			<svg width="200" height="360" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>			 
				<rect x='10' y="10" width="180" height="340" class="stroke_level" fill="white"/>
				<path class="stroke_level" fill="url(#Pattern)" d="M10,79.5H39.79S61,79.5,61,92.5v171s-2.83,13-24,13H10 z"/>
				<path class="stroke_level" fill="url(#Pattern)" d="M190,276.5H162.74s-21.21,0-21.21-13V92.5s2.83-13,24-13H190 z"/>
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="360" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>			 
				<rect x='10' y="10" width="180" height="340" class="stroke_level" fill="white"/>
				<path class="stroke_level" fill="url(#Pattern)" d="M190,174.5h-27c-16,0-17-13-17-13v-12c0-19-11-18-11-18h-63c-16,0-17-13-17-13v-12c0-19-11-18-11-18h-34 V10 H 190z"/>
				<path class="stroke_level" fill="url(#Pattern)" d="M190,278.5h-27c-16,0-17-13-17-13v-12c0-19-11-18-11-18h-63c-16,0-17-13-17-13v-12c0-19-11-18-11-18h-34 V350 H 190 z"/>
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="360" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>			 
				<rect x='10' y="10" width="180" height="340" class="stroke_level" fill="white"/>
				<path class="stroke_level" fill="url(#Pattern)" d="M190,81.5h-23s-17-2-17,18v28s0,13-18,13h-62c-18,0-18-13-18-13v-28c0-20-17-18-17-18h-25V10H190z "/>
				<path class="stroke_level" fill="url(#Pattern)" d="M190,265.44h-23s-17,2-17-18v-28s0-13-18-13h-62c-18,0-18,13-18,13v28c0,20-17,18-17,18h-25V350H190z"/>
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="360" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>			 
				<rect x='10' y="10" width="180" height="340" class="stroke_level" fill="url(#Pattern)"/>
				<path class="stroke_level" fill="white"  d="M190,157.5h-64s-27,0-27-28V10H190z"/>
				<path class="stroke_level" fill="white" d="M10,202.5h64s27,0,27,28V350H10z"/>
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="360" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>			 
				<rect x='10' y="10" width="180" height="340" class="stroke_level" fill="url(#Pattern)"/>
				<path class="stroke_level" fill="white" d="M190,273H151.06S134,273,134,223V10H190z"/>
				<path class="stroke_level" fill="white" d="M10,79h39S68,79,68,130.52V350H10z"/>
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="360" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>			 
				<rect x='10' y="10" width="180" height="340" class="stroke_level" fill="white"/>
				<path class="stroke_level" fill="url(#Pattern)"  d="M190,246.21c-24,16.07-53,24-84,18.79-30-6-56-25-66-54-1-4-2-9-3-13a131,131,0,0,1,0-28h0c3-12,2-27-9-35a36.7,36.7,0,0,0-18-7V350H190z"/>
				<path class="stroke_level" fill="url(#Pattern)" d="M10,81.62A112,112,0,0,1,46,82c30,6,56,25,66,54,1,4,2,8,3,13,3,16-2,30-1,45,1,18,21,27,38,25a81.05,81.05,0,0,0,39-15.54V10H10z"/>
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="360" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>			 
				<rect x='10' y="10" width="180" height="340" class="stroke_level" fill="url(#Pattern)"/>
				<rect class="stroke_level" fill="white" x="50" y="50" rx="10" ry="10" width="100" height="260" />		 
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="360" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>			 
				<rect x='10' y="10" width="180" height="340" class="stroke_level" fill="url(#Pattern)"/>
				<rect class="stroke_level" fill="white" x="50" y="50" rx="10" ry="10" width="100" height="110" />
				<rect class="stroke_level" fill="white" x="50" y="200" rx="10" ry="10" width="100" height="110" />		 
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="360" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>			 
				<rect x='10' y="10" width="180" height="340" class="stroke_level" fill="white"/>
				<path class="stroke_level" fill="url(#Pattern)" d="M10,153.5h28s16,0,16,19v122s0,18,29,18h22s22,1,22,18v19 H 10 z"/>
				<path class="stroke_level" fill="url(#Pattern)" d="M190,78.5h-24s-16,1-16,21v114s0,17,20,17h20 z" />		 
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="360" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>			 
				<rect x='10' y="10" width="180" height="340" class="stroke_level" fill="url(#Pattern)"/>
				<path fill="white" transform="translate(-1,0)" class="stroke_level" d="M11.5,89.5s24-6,34-3,2,23,22,26,40-6,42-6,35-8,21,24c-7,15.89-20.43,22.64-43.55,46.4-2.49,2.56-6.61,6.92-6.45,12.6.23,8.28,9.42,14,11,15,8,5,15.19,4.33,22,5,23.28,2.28,45.55,20.17,44.61,30.31-.37,4-5.18,7.88-16.61,11.69-39,13-71,56-94,35-6-5.48-20.82-2.55-36-10 z" />	 
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="360" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>			 
				<rect x='10' y="10" width="180" height="340" class="stroke_level" fill="url(#Pattern)"/>
				<ellipse class="stroke_level" fill="white" cx="100" cy="180" rx="60" ry="120"/> 
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="360" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>			 
				<rect x='10' y="10" width="180" height="340" class="stroke_level" fill="url(#Pattern)"/>
				<path fill="white" class="stroke_level" d="M158.5,181c0-65.45-25.07-118.5-56-118.5H64A17.5,17.5,0,0,0,46.5,80V181c0,65.45,25.07,118.5,56,118.5H141A17.5,17.5,0,0,0,158.5,282Z"/>
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="360" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>			 
				<rect x='10' y="10" width="180" height="340" class="stroke_level" fill="url(#Pattern)"/>
				<path class="stroke_level" fill="white" d="M153,205c16-32,21-71,3-104-1-1,0-3-1-4-4-5-7-10-11-15-3-2-4-5-7-7-6-5-13-10-21-11a218.62,218.62,0,0,0-51-3c-6,0-9,5-11,10,12,20,15,44,7,66-5,14-13,27-18,41-8,27-9,57,6,83,1,1,0,3,1,4,4,5,7,10,11,15,3,2,4,5,7,7,6,5,13,10,21,11a218.62,218.62,0,0,0,51,3c6,0,9-5,11-10-17-26-13-60,2-86Z"/>
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="360" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>			 
				<rect x='10' y="10" width="180" height="340" class="stroke_level" fill="url(#Pattern)"/>
				<path class="stroke_level" fill="white" d="M116,223c-11,4-22,7-30,17-5,7-8,14-7,22,1,3,0,6,1,9,2,5,2,11,5,16,4,5,6,11,9,17,1,2,1,6-1,6-11,3-20-5-29-11a98.74,98.74,0,0,1-28-33c-12-23-15-50-6-75,2-4,3-7,5-11,14-28,44-38,71-47,11-7,19-19,18-32-1-3,0-6-1-9-2-5-2-11-5-16-4-5-6-11-9-17-1-2-1-6,1-6,11-3,20,5,29,11a98.74,98.74,0,0,1,28,33c12,23,15,50,6,75-2,4-3,7-5,11-11,20-31,33-52,40Z"/>
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="360" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>			 
				<rect x='10' y="10" width="180" height="340" class="stroke_level" fill="url(#Pattern)"/>
				<path class="stroke_level" fill="white" d="M132.32,294.44,74.24,158.31l-.92.39A74,74,0,0,0,131.4,294.83 z"/>
				<path class="stroke_level" fill="white" d="M129.68,203.3,71.6,67.17A74,74,0,0,1,129.68,203.3Z"/>
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="360" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>			 
				<rect x='10' y="10" width="180" height="340" class="stroke_level" fill="white"/>
				<path class="stroke_level" fill="url(#Pattern)" d="M58.5,10.5s-15,21,0,43,58,11,59,7,67-19,24,23-21,65-21,65,14,20,36-7,35-8,35-8 H190 V10 z"/>
				<path class="stroke_level" fill="url(#Pattern)" d="M190,195.5s-11-16-34-6c-15.5,6.74-29.63,3.49-36,10.44-6.12,6.7-3.44,17.29-3,19.56,2.48,13.23,12.86,17,13,30a19.45,19.45,0,0,1-2,10c-8,14.63-40.34,17.34-54,6a84.63,84.63,0,0,0-14-10c-5-2.8-7.48-4.2-10-4s-4.6,1.37-17,12c-3.72,3.19-4.09,3.52-5.1,3.66-8.82,1.29-17.9-19.66-17.9-19.66 V350 H190 z"/>
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="360" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>			 
				<rect x='10' y="10" width="180" height="340" class="stroke_level" fill="white"/>
				<path class="stroke_level" fill="url(#Pattern)" d="M 10 195 L 90 350 H 10 z"/>
				<path class="stroke_level" fill="url(#Pattern)" d="M 110 350 L 190 105 V 350 z"/>
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="360" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>			 
				<rect x='10' y="10" width="180" height="340" class="stroke_level" fill="white"/>
				<path class="stroke_level" fill="url(#Pattern)" d="M 65 10 L 190 240 V 10 z"/>
				<path class="stroke_level" fill="url(#Pattern)" d="M10 120 L 130 350 H10 z"/>
			</svg>
		</div>	
		<div class="item_svg">
			<svg width="200" height="360" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>			 
				<rect x='10' y="10" width="180" height="340" class="stroke_level" fill="white"/>
				<path class="stroke_level" fill="url(#Pattern)" d="M190,202.89c-32.31,28.27-65.22,68.85-87.93,101.94C79.27,276.38,44.89,236.25,10,205V350H190z"/>
				<path class="stroke_level" fill="url(#Pattern)" d="M10,196.36c11.66-9,24.23-20,37-31.72C18.33,136.78,29.92,98.26,60.6,63.55,75.62,46.89,90,38,104.19,41c14.2,2.45,28.28,16.68,42.09,35.07,26.59,36.45,34.36,64.23,8.9,88,12.46,12,24.63,22.29,35,29.52V10H10z"/>
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="360" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>			 
				<rect x='10' y="10" width="180" height="340" class="stroke_level" fill="white"/>
				<path class="stroke_level" fill="url(#Pattern)" d="M159,133.17v84.66c0,5.62-6.41,10.17-14.32,10.17H136a15,15,0,0,0-15,15v52.82c0,5.62-6.41,10.17-14.32,10.17H66.32C58.41,306,52,301.45,52,295.83V211.17C52,205.55,58.41,201,66.32,201H75a15,15,0,0,0,15-15V170a15,15,0,0,0-15-15H70.54c-7.91,0-14.32-4.55-14.32-10.17V60.17C56.22,54.55,62.63,50,70.54,50h40.35c7.91,0,14.32,4.55,14.32,10.17V108a15,15,0,0,0,15,15h4.46C152.59,123,159,127.55,159,133.17Z"/>
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="360" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>			 
				<rect x='10' y="10" width="180" height="340" class="stroke_level" fill="white"/>
				<path class="stroke_level" fill="url(#Pattern)" transform="translate(-1,0)" d="M73.45,350c-2.06-4.93-4-9.83-5.28-14.18L27.09,190.29c-2.86-9.37,4.37-25.3,16.17-24.15a37.51,37.51,0,0,1,12.8,3.7c12,6,21,2.56,20-14.55l-2.25-32.46c-1-16.57-14.6-40.17-30.48-43.8a46.38,46.38,0,0,0-8.44-1.12c-9-.71-17.82-.36-23.9-2.21V350z"/>
				<path class="stroke_level" fill="url(#Pattern)" d="M190,190.65l-19.32,94.59c-2.86,13.59-12.94,29.28-22.53,25.73a39.36,39.36,0,0,1-10.68-5.5c-10.4-7.19-19.6-3.74-20.55,13.51l-2.11,31H190z"/>
				<path class="stroke_level" fill="url(#Pattern)" d="M149.68,10l-3,34.91c-1.27,16.76,12.18,39.16,30,38.18a48.27,48.27,0,0,0,9.74-1.69c1.56-.41,3.08-.83,3-1.25V10z"/>
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="360" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>			 
				<rect x='10' y="10" width="180" height="340" class="stroke_level" fill="white"/>
				<path class="stroke_level" fill="url(#Pattern)" d="M190,311.25a20.13,20.13,0,0,1-5.45.75H97.75c-13.18,0-23.86-12.83-23.86-28.66v-1.42c0-5.28-3.56-9.55-8-9.55H58.86C45.68,272.37,35,259.53,35,243.7V138.25c0-15.83,10.68-28.66,23.86-28.66h0c4.39,0,8-4.28,8-9.55V27.84A32.32,32.32,0,0,1,72,10H10V350H190z"/>
				<path class="stroke_level" fill="url(#Pattern)" d="M136.6,10a30.79,30.79,0,0,1,4.59,16.48V123.9c0,14.62-9.47,26.48-21.15,26.48h0c-3.89,0-7,4-7,8.83v49c0,4.87,3.16,8.83,7,8.83H190V10z"/>
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="360" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>			 
				<rect x='10' y="10" width="180" height="340" class="stroke_level" fill="url(#Pattern)"/>
				<path class="stroke_level" fill="white" d="M152,155.19V300.48C152,314,144.09,325,134.34,325H120.66c-9.76,0-17.66-11-17.66-24.52v-18c0-4.86-2.84-8.79-6.33-8.79h-4c-9.76,0-17.66-11-17.66-24.52h0c0-4.86-2.84-8.79-6.33-8.79h-6c-9.76,0-17.66-11-17.66-24.52V70.52C45,57,52.91,46,62.66,46H76.34C86.09,46,94,57,94,70.52h0c0,4.86,2.84,8.79,6.33,8.79h6c9.76,0,17.66,11,17.66,24.52v18c0,4.86,2.84,8.79,6.33,8.79h4C144.09,130.67,152,141.65,152,155.19Z"/>
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="360" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>			 
				<rect x='10' y="10" width="180" height="340" class="stroke_level" fill="white"/>
				<path class="stroke_level" fill="url(#Pattern)" d="M95.5,350C79.5,337.5,73,318,67,298c-1-6-6-11-13-12-8-7-11-17-13-27-1-10,3-19,0-28-10-2-14-12-14-21,1-10,4-18,8-27,11-19,23-36,35-55,10-18,13-38,10-59C77,52,69,38,61,23c-1.5-3.75-4.12-9.19-3.23-12.94 H10V350z"/>
				<path class="stroke_level" fill="url(#Pattern)" d="M97.22,10c13.36,9,19.15,24.43,28.78,37.56a19,19,0,0,0,13,5c25,18,19,52,18,79a4,4,0,0,0,2,4c9,2,11,12,11,19a42.82,42.82,0,0,1-6,22h0c-3,9-9,16-13,24-8,12-16,23-24,36-10,18-13,38-10,59,3,17,11,31,19,46a45.21,45.21,0,0,1,2.66,8 H190V10z"/>
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="360" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>			 
				<rect x='10' y="10" width="180" height="340" class="stroke_level" fill="url(#Pattern)"/>
				<path class="stroke_level" fill="white" d="M102.07,170.13c6.89,22,13.78,45.21,11.48,69.75-1.15,19.38-4.59,36.17-14.93,53-5.74,7.75-11.48,19.38-21.82,16.79q-5.17-3.88-6.89-11.63c-1.15-15.5-2.3-32.29-3.44-47.79-2.3-25.83-6.89-50.38-18.37-72.34-10.33-36.17-11.48-73.63-2.3-109.79,2.3-6.46,4.59-12.92,10.33-15.5C66.47,50,78,50,88.29,50c5.74,0,12.63,5.17,10.33,11.63a175.15,175.15,0,0,0,3.44,108.5Z"/>
			</svg>
		</div>	
	</div>
	<div class="cont_svg">
		<div class="item_svg">
			<svg width="200" height="300" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>			 
				<path class="stroke_level" fill="url(#Pattern)" d="M10 10 H190 V 160 H 120 V 290 H10 z" />
				<path class="stroke_level" fill="white" d="M165,64.2v38.59c0,9.78-7.2,17.71-16.07,17.71H91.48l-.51.2a9.68,9.68,0,0,0-5.84,9.1V231.72c0,8.72-6.41,15.78-14.33,15.78H61.33c-7.91,0-14.33-7.07-14.33-15.78V87.28c0-8.72,6.41-15.78,14.33-15.78h8.1c3.66,0,6.62-3.27,6.62-7.3h0c0-4.44,7.2-17.7,16.07-17.7h56.81C157.8,46.5,165,54.43,165,64.2Z"/>
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="300" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>			 
				<path class="stroke_level" fill="url(#Pattern)" d="M10 10 H190 V 160 H 120 V 290 H10 z" />
				<rect class="stroke_level" fill="white" x="44" y="44" width="111" height="78" rx="9.49" ry="9.49"/>
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="300" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>			 
				<path class="stroke_level" fill="url(#Pattern)" d="M10 10 H190 V 160 H 120 V 290 H10 z" />
				<path class="stroke_level" fill="white" d="M149.78,45.61q3.61,39,3.7,77.57c0,8.12-4.63,15.76-10.18,16.93A404.71,404.71,0,0,1,89.18,149a1.15,1.15,0,0,0-1.06,1.11q.38,43.85.82,89.08c0,5.91-3.56,9-8,7.74a58.54,58.54,0,0,0-20.68-2.16c-4.41.35-9-3.33-10.21-9A543.84,543.84,0,0,1,39,136.93c-.09-5.37,4.68-9.12,10.56-8.89h0a1,1,0,0,0,1.05-.89q0-15.2.86-30.15c.26-4.63,4.67-8,9.76-8.34Q100.14,86.14,139.06,42C144.13,36.08,149,37.36,149.78,45.61Z"/>
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="300" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>			 
				<path class="stroke_level" fill="url(#Pattern)" d="M10 10 H190 V 160 H 120 V 290 H10 z" />
				<ellipse class="stroke_level" fill="white" cx="100" cy="80" rx="60" ry="35.5"/>
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="300" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>			 
				<path class="stroke_level" fill="url(#Pattern)" d="M10 10 H190 V 160 H 120 V 290 H10 z" />
				<path class="stroke_level" fill="white" d="M162,85.06c0,22.68-26.86,41.06-60,41.06h-.12c-5.53,0-9.69,5.85-8.44,12.07A192.73,192.73,0,0,1,97,175.87C97,221.23,82.67,258,65,258s-32-36.77-32-82.13c0-27,5.06-50.92,12.89-65.88a11.45,11.45,0,0,0-.15-10.63A29.76,29.76,0,0,1,42,85.06C42,62.38,68.86,44,102,44S162,62.38,162,85.06Z"/>
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="300" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>			 
				<path class="stroke_level" fill="none" d="M10 10 H190 V 160 H 120 V 290 H10 z" />
				<path class="stroke_level" fill="url(#Pattern)" d="M120,239.08A42,42,0,0,1,100.5,244C65.43,244,37,198.11,37,141.5S65.43,39,100.5,39,164,84.89,164,141.5a165,165,0,0,1-1,18.5 H120 z"/>
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="300" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>			 
				<path class="stroke_level" fill="url(#Pattern)" d="M10 10 H190 V 160 H 120 V 290 H10 z" />
				<path class="stroke_level" fill="white" d="M144.5,159.57a34.9,34.9,0,0,0,6-30.7c-5-18-3-63.52-25-61.4s-19-34.93-49,9.53-46,6.35-29,62.46-26,46.58-4,68.81,33,29.64,51,13.76,25-22.23,25-22.23 V160 z"/>
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="300" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>			 
				<path class="stroke_level" fill="white" d="M10 10 H190 V 160 H 120 V 290 H10 z" />
				<path class="stroke_level" fill="url(#Pattern)" d="M 10 230 L 190 49 V160 H120 V290 H10 z"/>
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="300" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>			 
				<path class="stroke_level" fill="white" d="M10 10 H190 V 160 H 120 V 290 H10 z" />
				<path class="stroke_level" fill="url(#Pattern)" d="M190 50 L 100 100 L 10 50 V30 H190 z " />
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="300" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>			 
				<path class="stroke_level" fill="white" d="M10 10 H190 V 160 H 120 V 290 H10 z" />
				<path class="stroke_level" fill="url(#Pattern)" d="M10.5,56.5s24,100,110,104 V290 H10 z"/>
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="300" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>			 
				<path class="stroke_level" fill="white" d="M10 10 H190 V 160 H 120 V 290 H10 z" />
				<path class="stroke_level" fill="url(#Pattern)" d="M10,84.5s1,104,110,128 V290 H10 z"/>
				<path class="stroke_level" fill="url(#Pattern)" d="M10,22.5s124,13,135,138 H190 V10 H10 z"/>
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="300" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>			 
				<path class="stroke_level" fill="url(#Pattern)" d="M10 10 H190 V 160 H 120 V 290 H10 z" />
				<path class="stroke_level" fill="white" d="M120,239H63.83A12.33,12.33,0,0,1,51.5,226.67V71.83A12.33,12.33,0,0,1,63.83,59.5h72.34A12.33,12.33,0,0,1,148.5,71.83V160 H120z"/>
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="300" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>			 
				<path class="stroke_level" fill="white" d="M10 10 H190 V 160 H 120 V 290 H10 z" />
				<path class="stroke_level" fill="url(#Pattern)" d="M10,215.35a249.62,249.62,0,0,0,110-11V290 H10 z"/>
				<path class="stroke_level" fill="url(#Pattern)" d="M190,99.78c-4-2.3-12.07-4.33-20.38-5.86-39.11-6.44-70.69-27.17-87.57-55.65-4.58-8.09-10.58-8.51-15.14-.14L10.5,146.74 V10 H190 z"/>
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="300" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>			 
				<path class="stroke_level" fill="url(#Pattern)" d="M10 10 H190 V 160 H 120 V 290 H10 z" />
				<rect class="stroke_level" fill="white" x="27" y="36" width="64" height="97" rx="11.73" ry="11.73"/>
				<rect class="stroke_level" fill="white" x="108" y="36" width="64" height="97" rx="11.73" ry="11.73"/>
				<rect class="stroke_level" fill="white" x="27" y="159" width="64" height="97" rx="11.73" ry="11.73"/>
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="300" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>			 
				<path class="stroke_level" fill="white" d="M10 10 H190 V 160 H 120 V 290 H10 z" />
				<path class="stroke_level" fill="url(#Pattern)" d="M73.62,289.68c.26-7.86,1.14-18.3,1.92-28.26,4.08-48.73-6.8-67.61-18.54-104.15-1.42-4.5-4.13-8.52-7-10.43-7.93-5.11-17.46-18.72-26.79-38.33C18.65,99,14.1,87.93,10,76.77 V290 z"/>
				<path class="stroke_level" fill="url(#Pattern)" d="M80.11,10c11.5,11.92,20.56,23.78,28.95,32.87,9.38,10.65,17.9,17.76,25.69,26.41,16,16.58,23.68,37.43,14.29,42.35-6.57,3.9-18.34,2.51-29.36,3.92-11.21,1.1-21.66,5-29.86,12.32-2.79,2.24-4.38,6.73-4.11,10.49,1.86,28.5,8.26,54.13,4.85,102.77-.88,15.41-4.91,35.6-8.93,48.56 H120 V 160 H190 V 10 z" />
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="300" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>			 
				<path class="stroke_level" fill="url(#Pattern)" d="M10 10 H190 V 160 H 120 V 290 H10 z" />
				<path class="stroke_level" fill="white" d="M120,201.73a57.2,57.2,0,0,1-6.49-5.59l-.39-.39a10.93,10.93,0,0,0-15.65,0l-.39.39c-16.55,16.55-39.83,20.12-52,8s-8.59-35.44,8-52l.39-.39a10.93,10.93,0,0,0,0-15.65l-.39-.39c-16.55-16.55-20.12-39.83-8-52s35.43-8.59,52,8l.38.39a11,11,0,0,0,15.66,0l.38-.39c16.55-16.55,39.83-20.12,52-8s8.58,35.43-8,52l-.39.38a11,11,0,0,0,0,15.66l.39.38a58.11,58.11,0,0,1,6.29,7.46 H120 z"/>
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="300" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>			 
				<path class="stroke_level" fill="url(#Pattern)" d="M10 10 H190 V 160 H 120 V 290 H10 z" />
				<path class="stroke_level" fill="white" d="M120,237H48.54c-3.72,0-6-7.61-4.09-13.56l14.72-45.33a5,5,0,0,0,.05-2.72l-22-79.5c-1.58-5.72.93-12.5,4.47-12.1L65.17,86.5c1.43.17,2.15-3.15,1.06-4.89h0C63.5,77.23,64.36,69,67.77,67L141,23.47c3.41-2,6.73,3.68,5.93,10.15l-5.33,43c-.32,2.59,1.29,4.47,2.39,2.79l.14-.22c2.86-4.36,7.22-1.48,7.78,5.12L158,160 H120 z"/>
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="300" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>			 
				<path class="stroke_level" fill="url(#Pattern)" d="M10 10 H190 V 160 H 120 V 290 H10 z" />
				<path class="stroke_level" fill="white" d="M120,191.56A62.47,62.47,0,1,1,156.89,160 H120 z"/>
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="300" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>			 
				<path class="stroke_level" fill="white" d="M10 10 H190 V 160 H 120 V 290 H10 z" />
				<path class="stroke_level" fill="url(#Pattern)" d="M10 36 L 190 60 V10 H 10 z" />
				<path class="stroke_level" fill="url(#Pattern)" d="M190 90 L 10 180 V290 H120 V160 H190z"/>
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="300" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>			 
				<path class="stroke_level" fill="white" d="M10 10 H190 V 160 H 120 V 290 H10 z" />
				<path class="stroke_level" fill="url(#Pattern)" d="M10,48.5s31-23,60-12a123.8,123.8,0,0,0,25.71,6.89c27.58,4.16,35.09-7.58,54.29-1.89,1.52.45,23.85,7.42,30,27,.57,1.8,3.91,13-1,24-12.39,27.75-70.38,38.67-94,18-24-21-15-18-28,3s-23,38,27,74-20,74-20,74-23.33,0-39.11-17.41A54.81,54.81,0,0,1,10,208.5 V290 H120 V160 H190 V10 H10 z"/>
			</svg>
		</div>
		<div class="item_svg">
			<svg width="200" height="300" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
				    <pattern id="Pattern" x="0" y="0" width="30" height="30" patternUnits="userSpaceOnUse">
				      <path d="M 30 0 L 0 30" class="fillPattern"/>
				    </pattern>		    
				</defs>			 
				<path class="stroke_level" fill="white" d="M10 10 H190 V 160 H 120 V 290 H10 z" />
				<path class="stroke_level" fill="url(#Pattern)" d="M120,216.5H98a2.5,2.5,0,0,0-2.5,2.5h0A11.5,11.5,0,0,1,84,230.5H60A11.5,11.5,0,0,1,48.5,219V195A11.5,11.5,0,0,1,60,183.5h6a2.5,2.5,0,0,0,2.5-2.5V159a2.5,2.5,0,0,0-2.5-2.5H47A11.5,11.5,0,0,1,35.5,145V121A11.5,11.5,0,0,1,47,109.5H66a2.5,2.5,0,0,0,2.5-2.5V93A2.5,2.5,0,0,0,66,90.5H65A11.5,11.5,0,0,1,53.5,79V55A11.5,11.5,0,0,1,65,43.5H89A11.5,11.5,0,0,1,100.5,55v2a2.5,2.5,0,0,0,2.5,2.5h13a2.5,2.5,0,0,0,2.5-2.5V35A11.5,11.5,0,0,1,130,23.5h24A11.5,11.5,0,0,1,165.5,35V59A11.5,11.5,0,0,1,154,70.5H144a2.5,2.5,0,0,0-2.5,2.5V91a2.5,2.5,0,0,0,2.5,2.5h5A11.5,11.5,0,0,1,160.5,105v24A11.5,11.5,0,0,1,149,140.5h-5a2.5,2.5,0,0,0-2.5,2.5v17H190V10H10V290H120z"/>
			</svg>
		</div>
	</div>
</div>





<div style="display: flex; justify-content: center; position: relative; margin-top: 50px;">
	<div class="vert_line"></div>
</div>
<div class="heder_present" style="position: relative; z-index: 2;">
	<span>Действует акция</span>
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

<div class="design">
	<div class="aferta_container">
		<div class="aferta_block">
			<div class="sale_flag">-30%</div>

			<img src='<?php echo $GLOBALS["root_dir"]."img/gde-najti-indiv.jpg"?>' alt="Наш дизайн">
			<h4>Каждый третий погонный метр перехода бессплатно</h4>
			<span>Акция действует до <?php echo $tar_date?></span>
			<span>Подробности по телефону</span>
			<div role="button" class="aferta_btn">Отправить</div>
		</div>
	</div>
	<div class="calculate_cont">
		<div style="display: flex; justify-content: center; position: relative;">
			<div class="vert_line"></div>
		</div>
		<div class="heder_present" style="position: relative; z-index: 2; margin-bottom: unset;">
			<span>Экспресс расчет</span>
		</div>

		<?php
			$res = $GLOBALS['db']->query("SELECT id, name, price FROM priceForCalcult WHERE id IN (1, 2, 3, 4, 5, 6)");
			$val = [];
			while($r = $res->fetchArray(SQLITE3_ASSOC)){
				$val[$r['id']] = $r;
			}	
		?>

		<div class="calcul_body">
			<form class="flex_input" data-price-spot="<?php echo $val[3]['price']?>"
									 data-price-lamp="<?php echo $val[2]['price']?>"
									 data-price-foil="<?php echo $val[1]['price']?>"
									 data-price-minorder="<?php echo $val[4]['price'] ?>"
									 data-price-multilevel="<?php echo $val[5]['price']?>"
									 data-price-discount="<?php echo $val[6]['price']?>">
				<input type="number" name="count_space" placeholder="Площадь помещения м2">
				<input type="number" name="perimetr" placeholder="Периметр перехода м.п.">
				<input type="number" name="light_points" placeholder="Точек освещения">
			</form>
			<div role="button" class="calc_btn expresCalculBtn">
				<div class="btn_animate"></div>
				<div class="call_me_load_anim display_none"></div>
				<div class="call_me_load_anim call_me_load_anim2 display_none"></div>
			Рассчитать</div>
		</div>
	</div>
</div>




