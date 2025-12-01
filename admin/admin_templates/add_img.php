
<?php if($_SERVER["REQUEST_METHOD"] == "GET"){?>
	<form action="add_img" method="POST">
		<select name="folder">
			<option value="-">-</option>
			<option value="carved">carved</option>
			<option value="curtain">curtain</option>
			<option value="curtainLight">curtainLight</option>
			<option value="fotoPrint">fotoPrint</option>
			<option value="hiddenCurtain">hiddenCurtain</option>
			<option value="kitchen">kitchen</option>
			<option value="lightNiches">lightNiches</option>
			<option value="lightTransp">lightTransp</option>
			<option value="multiLevel">multiLevel</option>
			<option value="profilShadow">profilShadow</option>
			<option value="sittingRoom">sittingRoom</option>
			<option value="staryySky">staryySky</option>
			<option value="svetLine">svetLine</option>
			<option value="svetovoy">svetovoy</option>
		</select>
		
		<input type="submit">
	</form>

<?php }else if($_SERVER["REQUEST_METHOD"] == "POST"){?>
	<h2>POST</h2>
	<?php

		$sel_dir = $_POST['folder'];
		if($sel_dir == "-"){
			echo "Не выбрана папка";
			exit;
		}

		include "../scripts_php/scripts_images.php";

		convert_to_webp();
		copy_img();
		write_data_base();

		echo "<h3>готово</h3>";

	?>

<?php }?>