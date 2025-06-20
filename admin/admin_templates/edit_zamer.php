<link rel="stylesheet" type="text/css" href="css/addReportStyle.css">
<script type="text/javascript" src="js/addReportZamer.js"></script>

<title>Редактировать замер №<?php echo $_GET['idZamer']?></title>

<?php
	include "admin_templates\add_edit_template_menu_zamer.php";
?>


<div style="padding-left: 10px;">

	<?php
		$json = json_decode($db->querySingle("SELECT json FROM zamer WHERE id = {$_GET['idZamer']}"));
	?>

	<div style="margin-bottom: 10px;">
		<span>Везде полотно</span>
		<select class="main_factur">
			<option value="выбрать">выбрать</option>
			<option value="бел.мат">бел.мат</option>
			<option value="бел.глян">бел.глян</option>
			<option value="бел.сатин">бел.сатин</option>
		</select>
	</div>

	<?php foreach($json->{"rooms"} as $r):?>
		<div class="room_block focus_room">
			<input style="width: 18px; height: 18px;" type="checkbox" name="focus_room_box">
			<div>Помещение</div>
			<input type="text" value="<?php echo $r->{'название комнаты'}?>" placeholder="Название" name="name_room">
			<div>	
				<div class="flex-column-alig">
					<label>A</label>
					<input value="<?php echo $r->{'стена А'}?>" class="inp_razmer" type="number" placeholder="А" name="A">
				</div>
				<div class="flex-column-alig">
					<label>B</label>
					<input value="<?php echo $r->{'стена Б'}?>" class="inp_razmer" type="number" placeholder="B" name="B">
				</div>
				<div class="flex-column-alig">
					<label>Площадь</label>
					<input value="<?php echo $r->{'площадь'}?>" class="inp_razmer" type="number" name="square">
				</div>
				<div class="flex-column-alig">
					<label>Периметр</label>
					<input value="<?php echo $r->{'перим.'}?>" class="inp_razmer" type="number" name="length">
				</div>

				<div class="flex-column-alig">
					<label>Фактура</label>
					<?php
						$f_mat = null;
						$f_glyn = null;
						$f_sat = null;
						if($r->{"полотно"} == "бел.глянец"){
							$f_glyn = "selected";
						}
						if($r->{"полотно"} == "бел.мат"){
							$f_mat = "selected";
						}
						if($r->{"полотно"} == "бел.сатин"){
							$f_sat = "selected";
						}
					?>
					<select name="factur_room" style="width: 70px;">
						<option value="фактура">фактура</option>
						<option <?php echo $f_mat ?> value="бел.мат">бел.мат</option>
						<option <?php echo $f_glyn ?> value="бел.глянец">бел.глянец</option>
						<option <?php echo $$f_sat ?> value="бел.сатин">бел.сатин</option>
					</select>
				</div>

				<div class="flex-column-alig">
					<label>Др.фактура</label>
					<input class="inp_razmer" type="text" name="alt_factur">
				</div>

				<div style="border: 1px solid grey;" class="flex-column-alig">
					<label>Мат. стены</label>


					<?php foreach($r->{"стены"} as $stKey => $stVal):?>	
						<div class="type_wall_id">
							<?php
								$st_sel = ["бетон"=>null,
											"гипс\карт"=>null,
											"гипс\блок"=>null,
											"дерево"=>null,
											"кирпич"=>null,
											"кермика"=>null,
											"гранит"=>null
										];
								$st_sel[$stKey] = "selected";
							?>

							<select style="width: 70px;">
								<option <?php echo $st_sel['бетон']?> value="бетон">бетон</option>
								<option <?php echo $st_sel['гипс\карт']?> value="гипс\карт">гипс\карт.</option>
								<option <?php echo $st_sel['гипс\блок']?> value="гипс\блок">гипс\блок</option>
								<option <?php echo $st_sel['дерево']?> value="дерево">дерево</option>
								<option <?php echo $st_sel['кирпич']?> value="кирпич">кирпич</option>
								<option <?php echo $st_sel['кермика']?> value="кермика">керамика</option>
								<option <?php echo $st_sel['гранит']?> value="гранит">гранит</option>
							</select>
							<input value="<?php echo $stVal ?>" class="inp_razmer" type="number" name="type_wall">
						</div>
					<?php endforeach; ?>
					<img class="plusImg add_dop_elem" src="../img/plus.png">
				</div>

				<input style="margin-top: 5px;" type="file" accept="image/*" name="foto">
			</div>

			<div class="insert_dopy">

				<?php if(array_key_exists("люстры", $r)):?>
					<?php foreach ($r->{"люстры"} as $k2 => $v2):?>
						<div class="column-padd lustr_id">
							<?php
								$a = ["накладная"=>null,
										"крючек"=>null];
								$a[$k2] = "selected"; 
							?>				
							<label>Люстры</label>
							<input value="<?php echo $v2?>" class="inp_razmer" type="number" name="">
							<select style="width: 70px;">
								<option <?php echo $a["накладная"] ?> value="накладная">накладная</option>
								<option <?php echo $a["крючек"] ?> value="крючек">крючек</option>
							</select>
						</div>
					<?php endforeach;?>
				<?php endif; ?>

				<?php if(array_key_exists("споты наши", $r)):?>
					<?php foreach ($r->{"споты наши"} as  $v2):?>
						<div class="column-padd spot_nah_id">		
							<label>Споты наши</label>
							<input value="<?php echo $v2->{"шт"}?>" class="inp_razmer" type="number" name="шт">
							<select name="цвет" style="width: 70px;">
								<?php
									$a = ["хром"=>null,
											"белый"=>null,
											"золото"=>null];
									$a[$v2->{"цвет"}] = "selected";
								?>
								<option value="цвет">цвет</option>
								<option <?php echo $a["хром"]?> value="хром">хром</option>
								<option <?php echo $a["белый"]?> value="белый">белые</option>
								<option <?php echo $a["золото"]?> value="золото">золото</option>
							</select>
							<select name="свечение" style="width: 70px;">
								<?php
									$a = ["теплый"=>null,
											"дневной"=>null,
											"холодный"=>null];
									$a[$v2->{"свечение"}] = "selected";
								?>
								<option value="свечение">свечение</option>
								<option <?php echo $a["теплый"]?> value="теплый">теплый</option>
								<option <?php echo $a["дневной"]?> value="дневной">дневной</option>
								<option <?php echo $a["холодный"]?> value="холодный">холодный</option>
							</select>
							<select name="мощность" style="width: 70px;">
								<?php
									$a = ["8W"=>null,
											"10W"=>null,
											"12W"=>null];
									$a[$v2->{"мощность"}] = "selected";
								?>
								<option value="мощность">мощность</option>
								<option <?php echo $a["8W"]?> value="8W">8W</option>
								<option <?php echo $a["10W"]?> value="10W">10W</option>
								<option <?php echo $a["12W"]?> value="12W">12W</option>
							</select>
						</div>

					<?php endforeach;?>
				<?php endif; ?>

				<?php if(array_key_exists("споты клиента", $r)):?>

					<?php foreach ($r->{"споты клиента"} as $k2=>$v2):?>
						<div class="column-padd spot_client_id">			
							<label>Споты клиента</label>
							<input value="<?php echo $v2 ?>" class="inp_razmer" placeholder="кол." type="number" name="count_client_spot">
							<input value="<?php echo $k2 ?>" class="inp_razmer" placeholder="диам." type="number" name="diam_client_spot">
						</div>
					<?php endforeach;?>
				<?php endif; ?>

				<?php if(array_key_exists("обвод тр", $r)):?>
					<?php foreach ($r->{"обвод тр"} as $k2=>$v2):?>
						<div class="column-padd obvod_id">
							<span>Обвод труб</span>
							<input value="<?php echo $v2?>" class="inp_razmer" placeholder="кол." type="number" name="obvod_count">
							<input value="<?php echo $k2?>" class="inp_razmer" placeholder="диам." type="number" name="obvod_diam">
						</div>
					<?php endforeach;?>
				<?php endif; ?>

				<?php if(array_key_exists("вент", $r)):?>
					<?php foreach ($r->{"вент"} as $v2):?>
						<div class="column-padd vent_id">
							<span>вентиляция</span>
							<input value="<?php echo $v2->{'шт'}?>" class="inp_razmer" placeholder="кол." type="number" name="шт">
							<input value="<?php echo $v2->{'диам'}?>" class="inp_razmer" placeholder="диам." type="number" name="диам">
							<?php
								if($v2->{"принуд"}){
									echo '<span style="margin-right: 10px;"><input checked type="checkbox" name="принуд">принуд.</span>';
								}else{
									echo '<span style="margin-right: 10px;"><input type="checkbox" name="принуд">принуд.</span>';
								}
							?>
						</div>
					<?php endforeach;?>
				<?php endif; ?>

				<?php if(array_key_exists("доп. углы", $r)):?>
					<div class="column-padd dop_ugl">
						<span>Доп.углы</span>
						<input value="<?php echo $r->{'доп. углы'} ?>" class="inp_razmer" placeholder="кол." type="number" name="">
					</div>

				<?php endif; ?>

				<?php if(array_key_exists("имитация стены", $r)):?>
					<div class="column-padd imatation_wall_id">
						<span>Имитация стены</span>
						<input value="<?php echo $r->{'имитация стены'}?>" class="inp_razmer" placeholder="м.п" type="number" name="м.п">
					</div>
				<?php endif; ?>

				<?php if(array_key_exists("разделитель", $r)):?>
					<div class="column-padd razdelitel_id">
						<span>Разделитель</span>
						<input value="<?php echo $r->{'разделитель'}?>" class="inp_razmer" placeholder="м.п" type="number" name="м.п">
					</div>
				<?php endif; ?>

				<?php if(array_key_exists("гардина накладная", $r)):?>
					<?php foreach ($r->{"гардина накладная"} as $v2):?>
						<div class="gard_nak_id flex_border">
							<span>Накладная ПВХ гардина</span>
							<div style="display: flex;">			
								<div class="flex-column-alig">
									<label>длина</label>
									<input value="<?php echo $v2->{'м.п'}?>" class="inp_razmer" type="number" name="м.п">
								</div>
								<?php
									if($v2->{'с блендой'}){
										echo '<span style="margin-right: 10px;"><input checked type="checkbox" name="с блендой">с блендой</span>';
									}else{
										echo '<span style="margin-right: 10px;"><input type="checkbox" name="с блендой">с блендой</span>';
									}
									if($v2->{"с углами"}){
										echo '<span style="margin-right: 10px;"><input checked type="checkbox" name="с углами">с углами</span>';
									}else{
										echo '<span style="margin-right: 10px;"><input type="checkbox" name="с углами">с углами</span>';
									}
									if($v2->{'гардина клиента'}){
										echo '<span style="margin-right: 10px;"><input checked type="checkbox" name="гардина клиента">гардина клиента</span>';
									}else{
										echo '<span style="margin-right: 10px;"><input type="checkbox" name="гардина клиента">гардина клиента</span>';
									}
								?>
							</div>
						</div>
					<?php endforeach;?>
				<?php endif; ?>

				<?php if(array_key_exists("гардина скрытая", $r)):?>
					<?php foreach ($r->{"гардина скрытая"} as $v2):?>
						<div class="shad_gar_id flex_border">
							<span>Скрытая гардина</span>
							<select name="тип" style="width: 70px; height: 30px;">
								<?php
									$a = ["Lumfer UK"=>null,
											"ПК-5"=>null
										];
									$a[$v2->{"тип"}] = "selected"; 
								?>
								<option value="тип">тип</option>
								<option <?php echo $a['Lumfer UK']?> value="Lumfer UK">Lumfer UK</option>
								<option <?php echo $a['ПК-5']?> value="ПК-5">ПК-5</option>
							</select>
							<div class="flex-column-alig">
								<label>перим</label>
								<input value="<?php echo $v2->{'м.п'} ?>" class="inp_razmer" type="number" name="м.п">
							</div>
							<select name="цвет" style="width: 70px; height: 30px;">
								<?php
									$a = ["черный"=>null,
											"белый"=>null
										];
									$a[$v2->{"цвет"}] = "selected"; 
								?>
								<option value="">цвет</option>
								<option <?php echo $a['черный']?> value="черный">черный</option>
								<option <?php echo $a['белый']?> value="белый">белый</option>
							</select>
							<div class="flex-column-alig">
								<label>обрыв</label>
								<input value="<?php echo $v2->{'обрыв'}?>" class="inp_razmer" placeholder="колл." type="number" name="обрыв">
							</div>
						</div>
					<?php endforeach;?>
				<?php endif; ?>

				<?php if(array_key_exists("световые линии", $r)):?>
					<?php foreach ($r->{"световые линии"} as $v2):?>
						<div class="svet_line_id flex_border">
							<span>Световые линии</span>
							<select name="тип профиля" style="width: 70px; height: 30px;">
								<?php
									$a = ["line30"=>null,
										"line50"=>null];
									$a[$v2->{'тип профиля'}] = "selected";
								?>
								<option value="тип проф.">проф</option>
								<option <?php echo $a['line30']?> value="line30">line30</option>
								<option <?php echo $a['line50']?> value="line50" >line50</option>
							</select>
							<select name="тип рассеивателя" style="width: 70px; height: 30px;">
								<?php
									$a = ["белый"=>null,
										"темный"=>null];
									$a[$v2->{'тип рассеивателя'}] = "selected";
								?>
								<option value="рас.">тип рас.</option>
								<option <?php echo $a['белый']?>>белый</option>
								<option <?php echo $a['темный']?>>темный</option>
							</select>		
							<div class="flex-column-alig">		
								<label>длина</label>
								<input value="<?php echo $v2->{"м.п"}?>" class="inp_razmer" type="number" name="м.п">
							</div>
							<div class="flex-column-alig">		
								<label>кол.лент</label>
								<input value="<?php echo $v2->{"кол. лент"}?>" class="inp_razmer" type="number" name="кол. лент">
							</div>
							<select name="тип ленты" style="width: 70px; height: 30px;">

								<?php
									$a = ["холодная"=>null,
										"дневная"=>null,
										"теплая"=>null];
									$a[$v2->{'тип ленты'}] = "selected";
								?>

								<option value="тип">тип ленты</option>
								<option <?php echo $a['холодная']?> value="холодная" >холодная</option>
								<option <?php echo $a['дневная']?> value="дневная">дневная</option>
								<option <?php echo $a['теплая']?> value="теплая">теплая</option>
							</select>
							<div class="flex-column-alig">		
								<label>питание</label>
								<input value="<?php echo $v2->{'кол. блоков'}?>" class="inp_razmer" placeholder="кол." type="number" name="кол. блоков">
								<select name="блок мощ." style="width: 70px; height: 30px;">
									<?php
										$a = ["50W"=>null,
											"100W"=>null,
											"150W"=>null];
										$a[$v2->{'блок мощ.'}] = "selected";
									?>
									<option value ="мощность">мощность</option>
									<option <?php echo $a['50W'] ?> value="50W">50w</option>
									<option <?php echo $a['100W'] ?> value="100W">100W</option>
									<option <?php echo $a['150W'] ?> value="150W">150W</option>
								</select>
							</div>
							<div class="flex-column-alig">		
								<label>обрыв</label>
								<input value="<?php echo $v2->{'обрыв'}?>" class="inp_razmer" type="number" name="обрыв">
							</div>
						</div>
					<?php endforeach;?>
				<?php endif; ?>

				<?php if(array_key_exists("парящий", $r)):?>
					<?php foreach ($r->{"парящий"} as $v2):?>
						<div class="flying_id flex_border">
							<span>парящий</span>
							<select name="тип профиля" style="width: 70px; height: 30px;">
								<?php
									$a = ["c рас."=>null,
										"без рас."=>null];
									$a[$v2->{'тип профиля'}] = "selected";
								?>
								<option value="тип">тип</option>
								<option <?php echo $a['c рас.']?> value="c рас.">с рас.</option>
								<option <?php echo $a['без рас.']?> value="без рас.">без рас.</option>
							</select>
							<select name="тип ленты" style="width: 70px; height: 30px;">
								<?php
									$a = ["теплая"=>null,
										"дневная"=>null,
										"холодная"=>null];
									$a[$v2->{'тип ленты'}] = "selected";
								?>
								<option value="лента" >лента</option>
								<option <?php echo $a['теплая']?> value="теплая">теплая</option>
								<option <?php echo $a['дневная']?> value="дневная">дневная</option>
								<option <?php echo $a['холодная']?> value="холодная">холодная</option>
							</select>		
							<div class="flex-column-alig">
								<label>перим.</label>
								<input value = '<?php echo $v2->{"м.п"} ?>' class="inp_razmer" type="number" name="м.п">
							</div>
							<div class="flex-column-alig">		
								<label>питание</label>
								<input value="<?php echo $v2->{'кол. блоков'}?>" class="inp_razmer" placeholder="кол." type="number" name="кол. блоков">
								<select name="блок мощ." style="width: 70px; height: 30px;">
									<?php
										$a = ["50W"=>null,
											"100W"=>null,
											"150W"=>null];
										$a[$v2->{'блок мощ.'}] = "selected";
									?>
									<option value ="мощность">мощность</option>
									<option <?php echo $a['50W'] ?> value="50W">50w</option>
									<option <?php echo $a['100W'] ?> value="100W">100W</option>
									<option <?php echo $a['150W'] ?> value="150W">150W</option>
								</select>
							</div>
						</div>
					<?php endforeach;?>
				<?php endif; ?>

				<?php if(array_key_exists("теневой", $r)):?>
					<?php foreach ($r->{"теневой"} as $v2): ?>
						<div class="shadov_id flex_border">
							<span>Теневой</span>
							<select name="тип профиля" style="width: 70px; height: 30px;">
								<?php
									$a = ["алюм."=>null,
										"ПВХ"=>null];
									$a[$v2->{'тип профиля'}] = "selected";
								?>
								<option value="тип">тип</option>
								<option <?php echo $a['алюм.']?> value="алюм.">Алюм.</option>
								<option <?php echo $a['ПВХ']?> value="ПВХ">ПВХ</option>
							</select>
							<div class="flex-column-alig">
								<label>перим.</label>
								<input value="<?php echo $v2->{'м.п'}?>" class="inp_razmer" type="number" name="м.п">
							</div>
						</div>
					<?php endforeach;?>
				<?php endif; ?>
			</div>
		</div>
	<?php endforeach; ?>

<div style="margin-bottom: 30px;"><img class="plusImg add_room_id" src="../img/plus.png"></div>
</div>
<button class="calculate_btn_id">Отправить</button>	