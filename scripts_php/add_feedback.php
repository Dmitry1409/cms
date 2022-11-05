<?php
	session_start();
	$db = new SQLite3('../cms.db');

	function randName($oldName){
		$n_name = md5(microtime() . rand(0, 9999));
		$j = strrpos($oldName, ".");
		$n_name = $n_name.substr($oldName, $j, strlen($oldName)-$j);
		return $n_name;
	}

	function autoRotateImage($p){
	    
	    $image = new Imagick($p);
	    $orientation = $image->getImageOrientation();

        switch($orientation) {
            case imagick::ORIENTATION_BOTTOMRIGHT:
                $image->rotateimage("#000", 180); // rotate 180 degrees
            break;
    
            case imagick::ORIENTATION_RIGHTTOP:
                $image->rotateimage("#000", 90); // rotate 90 degrees CW
            break;
    
            case imagick::ORIENTATION_LEFTBOTTOM:
                $image->rotateimage("#000", -90); // rotate 90 degrees CCW
            break;
            return;
        }
        $image->setImageOrientation(imagick::ORIENTATION_TOPLEFT);
        $image->writeImage($p);
	}

	function resize($name_file, $source_dir, $w, $h, $save_dir){
		$path = $source_dir."/".$name_file;
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
		$new_name = $save_dir."/".$name_file;


		switch($type){
			case 2:
				imageJpeg($img, $new_name);
				break;
			case 3:
				imagePng($img, $new_name);
				break;
		}
	}

	


	$clientName = str_replace("'", '"', $_POST['client_name']);
	$text_review = str_replace("'", '"', $_POST['text_review']);
	$scope = $_POST['scope'];

	$avatarDir400 = "../upload_img/avatars/400x400/";
	$avatarDirOrig = "../upload_img/avatars/origin/";

	$revDirOrig = "../upload_img/foto_review/origin/";
	$revDir100 = "../upload_img/foto_review/100x100/";
	$revDir800 = "../upload_img/foto_review/800x800/";

	$arrDB = [];
	if(array_key_exists("avatar", $_FILES)){	
		$n_name = randName($_FILES['avatar']['name']);
		$arrDB['avatarFileName'] = $n_name;
		move_uploaded_file($_FILES['avatar']['tmp_name'], $avatarDirOrig.$n_name);
		// autoRotateImage($avatarDirOrig.$n_name);
		resize($n_name, $avatarDirOrig, 400, null, $avatarDir400);
	}

	unset($_FILES['avatar']);


	if(count($_FILES)> 0){
		$arrDB['fotoRevArr'] = [];
		for($i = 0; $i<count($_FILES); $i++){
			$n_name = randName($_FILES[$i]['name']);
			$arrDB['fotoRevArr'][] = $n_name;
			move_uploaded_file($_FILES[$i]['tmp_name'], $revDirOrig.$n_name);
			// autoRotateImage($revDirOrig.$n_name);
			resize($n_name, $revDirOrig, 100, null, $revDir100);
			resize($n_name, $revDirOrig, 800, null, $revDir800);
		}
	}

	$timestamp = time();
	
	$q = "INSERT INTO feedBackClient (name_client, text_review, scope, timestamp";

	if(array_key_exists('avatarFileName', $arrDB)){
		$q = $q.", avatar_file_name";
	}

	if(array_key_exists("fotoRevArr", $arrDB)){	
		$q = $q.", foto_file_name_arr)";
	}else{
		$q = $q.")";
	}
	

	$q = $q."VALUES ('$clientName', '$text_review', '$scope', '$timestamp'";

	if(array_key_exists('avatarFileName', $arrDB)){
		$name = $arrDB['avatarFileName'];
		$q = $q.", '$name'";
	}
	if(array_key_exists("fotoRevArr", $arrDB)){
		$arr = json_encode($arrDB['fotoRevArr']);
		$q = $q.", '$arr')";
	}else{
		$q = $q.")";
	}

	
	if($db->exec($q)){
		echo "success";
	}else{
		echo $db->lastErrorMsg();
	}

?>