
<?php
	$dir = scandir('../img/imgObj');
?>

<?php if($_SERVER["REQUEST_METHOD"] == "GET"){?>
	<p>Если создается новая категория нужно создать папку в imgObj с подпапками jpg и webp. Добавь фотки в папку "processed" выбери папку и нажми отправить. Все фото конвертируются и сопируются в нужные папки и сделаются записи в базе. Нужно будет перекинуть фотки и базу на продакшн или грузить фотки изначально на продакшн</p>
	<form action="add_img" method="POST">
		<select name="folder">
			<?php
				$ind = 0;
				foreach ($dir as $d) {
					if($ind == 0){
						echo "<option value='-'>-</option>";
					}else{
						if($d != "." AND $d != ".."){
							echo "<option value='$d'>$d</option>";
						}
					}
					$ind++;
				}
			?>
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