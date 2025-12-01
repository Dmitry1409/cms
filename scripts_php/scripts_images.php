<?php
	include "collectImage.php";

	$dirNameSource = 'processed';


	$paths = getImages($dirNameSource);

	function convert_to_webp($dir){
		global $dirNameSource, $paths;
	
		for($i=0; $i<count($paths); $i++){
			$full_parth = $dirNameSource."/".$paths[$i];
			webpImage($full_parth);
		}
	}
	
	function copy_img(){
		global $dirNameSource, $paths, $sel_dir;


		for($i=0; $i<count($paths); $i++){

			$nf = strpos($paths[$i], '.');
			$nf = substr($paths[$i], 0, $nf);

			$s = $dirNameSource."/".$paths[$i];
			$d = "../img/imgObj/$sel_dir/jpg/".$paths[$i];

			$ws = $dirNameSource."/".$nf.".webp";
			$wd = "../img/imgObj/$sel_dir/webp/".$nf.".webp";

			if (!copy($s, $d)) {
			    echo "failed to copy $s...\n";
			}else{
				echo "Copy file $s";
				echo "<br>";
			}
			if (!copy($ws, $wd)) {
			    echo "failed to copy $s...\n";
			}else{
				echo "Copy file $ws";
				echo "<br>";
			}

		}

	}


	function write_data_base(){
		global $db, $paths, $sel_dir;

		$db = new SQLite3('../cms.db');

		for($i=0; $i<count($paths); $i++){
			$nf = strpos($paths[$i], '.');
			$nf = substr($paths[$i], 0, $nf);

			$nw = $nf.".webp";
			$nj = $paths[$i];

			$query = "INSERT INTO imageObj (webp, jpg, hashTag_id) VALUES ('img/imgObj/$sel_dir/webp/$nw',";
			$query = $query."'img/imgObj/$sel_dir/jpg/$nj', '[]')";

			if(!$db->exec($query)){
				echo $db->lastErrorMsg().". Не удалось записать в таблицу imgObj. Имя файла - $nj";
				exit;
			}else{
				echo "Запись файла $nj в базу сделана";
				echo "<br>";
			}

		}
	}


	function webpImage($source, $quality = 80)
	    {
	    	global $dirNameSource;
	        $dir = pathinfo($source, PATHINFO_DIRNAME);
	        $name = pathinfo($source, PATHINFO_FILENAME);
	        $destination = $dirNameSource . DIRECTORY_SEPARATOR . $name . '.webp';
	        $name = $name."webp";
	        $info = getimagesize($source);
	        $isAlpha = false;
	        if ($info['mime'] == 'image/jpeg')
	            $image = imagecreatefromjpeg($source);
	        elseif ($isAlpha = $info['mime'] == 'image/gif') {
	            $image = imagecreatefromgif($source);
	        } elseif ($isAlpha = $info['mime'] == 'image/png') {
	            $image = imagecreatefrompng($source);
	        } else {
	            return $source;
	        }
	        if ($isAlpha) {
	            // imagepalettetotruecolor($image);
	            imagealphablending($image, true);
	            imagesavealpha($image, true);
	        }
	        imagewebp($image, $destination, $quality);

	        // костыль который лечит не правельный вывод функции в инете нашел
	        $fpr = fopen($destination, "a+");
	        fwrite($fpr, chr(0x00));
	        fclose($fpr);
	        echo "Файл $destination конвертирован";
	        echo "<br>";

	       
	        // destroy($source);

	        // return $destination;
	    }

	function resize_img_in_dir($dir, $w, $h){
		$ar = getImages($dir);
		for ($i = 0; $i < count($ar); $i++){
			// echo $ar[$i];
			resize($ar[$i], $w, $h);
		}
	}

	function resize($path, $w, $h){
		$info = getimagesize($path);
		$width = $info[0];
		$height = $info[1];
		$type = $info[2];

		switch ($type){
			case 2:
				$img = imageCreateFromJpeg($path);
				break;

			case 3:
				$img = imageCreateFromPng($path);
				imageSaveAlpha($img, true);
				break;
		}

		if(empty($w)){
			$w = ceil($h / ($height / $width));
		}
		if(empty($h)){
			$h = ceil($w / ($width / $height));
		}

		$tmp = imageCreateTrueColor($w, $h);
		if($type == 3){
			imagealphablending($tmp, true); 
			imageSaveAlpha($tmp, true);
			$transparent = imagecolorallocatealpha($tmp, 0, 0, 0, 127); 
			imagefill($tmp, 0, 0, $transparent); 
			imagecolortransparent($tmp, $transparent); 
		}

		$tw = ceil($h / ($height / $width));
		$th = ceil($w / ($width / $height));

		if($tw < $w){
			imageCopyResampled($tmp, $img, ceil(($w - $tw) / 2), 0, 0, 0, $tw, $h, $width, $height);
		}else{
			imageCopyResampled($tmp, $img, 0, ceil(($h - $th) / 2), 0, 0, $w, $th, $width, $height);
		}

		$img = $tmp;
		$ind_tockha = strpos($path, '.');
		$new_name = substr($path, 0, $ind_tockha);
		$new_name = $new_name.substr($path, $ind_tockha);
		// $new_name = "processed/".$new_name;


		switch($type){
			case 2:
				imageJpeg($img, $new_name);
				break;
			case 3:
				imagePng($img, $new_name);
				break;
		}
	}
	
	

	// resize('plus.png', 60, 0);


?>