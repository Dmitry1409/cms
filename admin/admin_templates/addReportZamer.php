
<link rel="stylesheet" type="text/css" href="css/addReportStyle.css">
<script type="text/javascript" src="js/addReportZamer.js"></script>

<?php
	include "admin_templates/add_edit_template_menu_zamer.php";
?>

<div style="padding-left: 10px;">
	<div style="margin-bottom: 10px;">
		<span>Везде полотно</span>
		<select class="main_factur">
			<option value="выбрать">выбрать</option>
			<option value="бел.мат">бел.мат</option>
			<option value="бел.глян">бел.глян</option>
			<option value="бел.сатин">бел.сатин</option>
			<option value="Bauf бел мат">Bauf бел мат</option>
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
					<option value="Bauf бел мат">Bauf бел мат</option>
				</select>
			</div>
			<div class="flex-column-alig">
				<label>Др.фактура</label>
				<input style="width: 80px;" class="inp_razmer" type="text" name="alt_factur">
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