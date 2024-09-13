
<link rel="stylesheet" type="text/css" href="css/addReportStyle.css">
<script type="text/javascript" src="js/addReportZamer.js"></script>
<div style="display: none;">
	<div class="column-padd lustr_id">				
		<label>Люстры</label>
		<input class="inp_razmer" type="number" name="">
		<select style="width: 70px;">
			<option value="накладная" selected>накладная</option>
			<option value="крючек">крючек</option>
		</select>
	</div>
	<div class="column-padd spot_nah_id">		
		<label>Споты наши</label>
		<input class="inp_razmer" type="number" name="шт">
		<select name="цвет" style="width: 70px;">
			<option value="цвет">цвет</option>
			<option value="хром">хром</option>
			<option value="белый">белые</option>
			<option value="золото">золото</option>
		</select>
		<select name="свечение" style="width: 70px;">
			<option value="свечение">свечение</option>
			<option value="теплый">теплый</option>
			<option value="дневной">дневной</option>
			<option value="холодный">холодный</option>
		</select>
		<select name="мощность" style="width: 70px;">
			<option value="мощность">мощность</option>
			<option value="8W">8W</option>
			<option value="10W">10W</option>
			<option value="12W">12W</option>
		</select>
	</div>
	<div class="column-padd spot_client_id">			
		<label>Споты клиента</label>
		<input class="inp_razmer" placeholder="кол." type="number" name="count_client_spot">
		<input class="inp_razmer" placeholder="диам." type="number" name="diam_client_spot">
	</div>
	<div class="column-padd obvod_id">
		<span>Обвод труб</span>
		<input class="inp_razmer" placeholder="кол." type="number" name="obvod_count">
		<input class="inp_razmer" placeholder="диам." type="number" name="obvod_diam">
	</div>
	<div class="column-padd vent_id">
		<span>вентиляция</span>
		<input class="inp_razmer" placeholder="кол." type="number" name="шт">
		<input class="inp_razmer" placeholder="диам." type="number" name="диам">
		<span style="margin-right: 10px;"><input type="checkbox" name="принуд">принуд.</span>
	</div>
	<div class="column-padd dop_ugl">
		<span>Доп.углы</span>
		<input class="inp_razmer" placeholder="кол." type="number" name="">
	</div>
	<div class="column-padd imatation_wall_id">
		<span>Имитация стены</span>
		<input class="inp_razmer" placeholder="м.п" type="number" name="м.п">
	</div>
	<div class="gard_nak_id flex_border">
		<span>Накладная ПВХ гардина</span>
		<div style="display: flex;">			
			<div class="flex-column-alig">
				<label>длина</label>
				<input class="inp_razmer" type="number" name="м.п">
			</div>
			<span style="margin-right: 10px;"><input type="checkbox" name="с блендой">с блендой</span>
			<span style="margin-right: 10px;"><input type="checkbox" name="с углами">с углами</span>
		</div>
	</div>
	<div class="shad_gar_id flex_border">
		<span>Скрытая гардина</span>
		<select name="тип" style="width: 70px; height: 30px;">
			<option value="тип">тип</option>
			<option value="Lumfer UK">Lumfer UK</option>
			<option value="ПК-5">ПК-5</option>
		</select>
		<div class="flex-column-alig">
			<label>перим</label>
			<input class="inp_razmer" type="number" name="м.п">
		</div>
		<select name="цвет" style="width: 70px; height: 30px;">
			<option value="">цвет</option>
			<option value="черный">черный</option>
			<option value="белый">белый</option>
		</select>
		<div class="flex-column-alig">
			<label>обрыв</label>
			<input class="inp_razmer" placeholder="колл." type="number" name="обрыв">
		</div>
	</div>
	<div class="svet_line_id flex_border">
		<span>Световые линии</span>
		<select name="тип профиля" style="width: 70px; height: 30px;">
			<option value="тип проф.">проф</option>
			<option value="line30">line30</option>
			<option value="line50" >line50</option>
		</select>
		<select name="тип рассеивателя" style="width: 70px; height: 30px;">
			<option value="рас.">тип рас.</option>
			<option>белый</option>
			<option>темный</option>
		</select>		
		<div class="flex-column-alig">		
			<label>длина</label>
			<input class="inp_razmer" type="number" name="м.п">
		</div>
		<div class="flex-column-alig">		
			<label>кол.лент</label>
			<input class="inp_razmer" value="1" type="number" name="кол. лент">
		</div>
		<select name="тип ленты" style="width: 70px; height: 30px;">
			<option value="тип">тип ленты</option>
			<option value="холодная" >холодная</option>
			<option value="дневная">дневная</option>
			<option value="теплая">теплая</option>
		</select>
		<div class="flex-column-alig">		
			<label>питание</label>
			<input class="inp_razmer" placeholder="кол." type="number" name="кол. блоков">
			<select name="блок мощ." style="width: 70px; height: 30px;">
				<option value ="мощность">мощность</option>
				<option value="50W">50w</option>
				<option value="100W">100W</option>
				<option value="150W">150W</option>
			</select>
		</div>
		<div class="flex-column-alig">		
			<label>обрыв</label>
			<input class="inp_razmer" type="number" name="обрыв">
		</div>
	</div>
	<div class="flying_id flex_border">
		<span>парящий</span>
		<select name="тип профиля" style="width: 70px; height: 30px;">
			<option value="тип">тип</option>
			<option value="c рас.">с рас.</option>
			<option value="без рас.">без рас.</option>
		</select>
		<select name="тип ленты" style="width: 70px; height: 30px;">
			<option value="лента" >лента</option>
			<option value="теплая">теплая</option>
			<option value="дневная">дневная</option>
			<option value="холодная">холодная</option>
		</select>		
		<div class="flex-column-alig">
			<label>перим.</label>
			<input class="inp_razmer" type="number" name="м.п">
		</div>
		<div class="flex-column-alig">		
			<label>питание</label>
			<input class="inp_razmer" placeholder="кол." type="number" name="кол. блоков">
			<select name="блок мощ." style="width: 70px; height: 30px;">
				<option value ="мощность">мощность</option>
				<option value="50W">50w</option>
				<option value="100W">100W</option>
				<option value="150W">150W</option>
			</select>
		</div>
	</div>
	<div class="shadov_id flex_border">
		<span>Теневой</span>
		<select name="тип профиля" style="width: 70px; height: 30px;">
			<option value="тип">тип</option>
			<option value="алюм.">Алюм.</option>
			<option value="ПВХ">ПВХ</option>
		</select>
		<div class="flex-column-alig">
			<label>перим.</label>
			<input class="inp_razmer" type="number" name="м.п">
		</div>
	</div>
	<div class="room_id_templat">
		<input style="width: 18px; height: 18px;" checked type="checkbox" name="focus_room_box">
		<div>Помещение</div>
		<input type="text" placeholder="Название" name="name_room">
		<div>	
			<div class="flex-column-alig">
				<label>A</label>
				<input class="inp_razmer" type="number" placeholder="А" name="A">
			</div>
			<div class="flex-column-alig">
				<label>B</label>
				<input class="inp_razmer" type="number" placeholder="B" name="B">
			</div>
			<div class="flex-column-alig">
				<label>Площадь</label>
				<input class="inp_razmer" type="number" name="square">
			</div>
			<div class="flex-column-alig">
				<label>Периметр</label>
				<input class="inp_razmer" type="number" name="length">
			</div>
			<div class="flex-column-alig">
				<label>Фактура</label>
				<select name="factur_room" style="width: 70px;">
					<option value="фактура">фактура</option>
					<option value="бел.мат">бел.мат</option>
					<option value="бел.глянец">бел.глянец</option>
					<option value="бел.сатин">бел.сатин</option>
				</select>
			</div>
			<div class="flex-column-alig">
				<label>Др.фактура</label>
				<input class="inp_razmer" type="text" name="alt_factur">
			</div>
			<div style="border: 1px solid grey;" class="flex-column-alig">
				<label>Мат. стены</label>
				<div class="type_wall_id">
					<select style="width: 70px;">
						<option value="бетон" selected>бетон</option>
						<option value="гипс\карт">гипс\карт.</option>
						<option value="гипс\блок">гипс\блок</option>
						<option value="дерево">дерево</option>
						<option value="кирпич">кирпич</option>
						<option value="керамика">керамика</option>
						<option value="гранит">гранит</option>
					</select>
					<input class="inp_razmer" type="number" name="type_wall">
				</div>
				<img class="plusImg add_dop_elem" src="../img/plus.png">
			</div>		
			<input style="margin-top: 5px;" type="file" accept="image/*" name="foto">
		</div>
		<div class="insert_dopy"></div>
	</div>
</div>
<div class="add_dop_panel">
	<img class="menu_img" src="../img/plus.png">
	<span>Люстра</span>
	<span>Споты наши</span>
	<span>Споты клиента</span>
	<span>Обвод тр</span>
	<span>Вент.</span>
	<span>Доп. углы</span>
	<span>Накладная гардина</span>
	<span>Имитация стены</span>
	<span>Скрытая гардина</span>
	<span>Световые линии</span>
	<span>Парящий</span>
	<span>Теневой</span>
</div>
<div style="padding-left: 10px;">
	<div style="margin-bottom: 10px;">
		<span>Везде полотно</span>
		<select class="main_factur">
			<option value="выбрать">выбрать</option>
			<option value="бел.мат">бел.мат</option>
			<option value="бел.глян">бел.глян</option>
			<option value="бел.сатин">бел.сатин</option>
		</select>
	</div>
	<div class="room_block focus_room">
		<input style="width: 18px; height: 18px;" checked type="checkbox" name="focus_room_box">
		<div>Помещение</div>
		<input type="text" placeholder="Название" name="name_room">
		<div>	
			<div class="flex-column-alig">
				<label>A</label>
				<input class="inp_razmer" type="number" placeholder="А" name="A">
			</div>
			<div class="flex-column-alig">
				<label>B</label>
				<input class="inp_razmer" type="number" placeholder="B" name="B">
			</div>
			<div class="flex-column-alig">
				<label>Площадь</label>
				<input class="inp_razmer" type="number" name="square">
			</div>
			<div class="flex-column-alig">
				<label>Периметр</label>
				<input class="inp_razmer" type="number" name="length">
			</div>
			<div class="flex-column-alig">
				<label>Фактура</label>
				<select name="factur_room" style="width: 70px;">
					<option value="фактура">фактура</option>
					<option value="бел.мат">бел.мат</option>
					<option value="бел.глянец">бел.глянец</option>
					<option value="бел.сатин">бел.сатин</option>
				</select>
			</div>
			<div class="flex-column-alig">
				<label>Др.фактура</label>
				<input class="inp_razmer" type="text" name="alt_factur">
			</div>
			<div style="border: 1px solid grey;" class="flex-column-alig">
				<label>Мат. стены</label>
				<div class="type_wall_id">
					<select style="width: 70px;">
						<option value="бетон" selected>бетон</option>
						<option value="гипс\карт">гипс\карт.</option>
						<option value="гипс\блок">гипс\блок</option>
						<option value="дерево">дерево</option>
						<option value="кирпич">кирпич</option>
						<option value="кермика">керамика</option>
						<option value="гранит">гранит</option>
					</select>
					<input class="inp_razmer" type="number" name="type_wall">
				</div>
				<img class="plusImg add_dop_elem" src="../img/plus.png">
			</div>		
			<input style="margin-top: 5px;" type="file" accept="image/*" name="foto">
		</div>
		<div class="insert_dopy"></div>
	</div>
		
	<div style="margin-bottom: 30px;"><img class="plusImg add_room_id" src="../img/plus.png"></div>

	<button class="calculate_btn_id">Отправить</button>
</div>