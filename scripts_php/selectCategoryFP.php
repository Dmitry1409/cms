<?php
	session_start();
	include "collectImage.php";
	$d = $_GET['category'];

	if($d=='all'){
		$res = [];
		$folders = scandir('../img/imgFantes');
		$folders = array_diff($folders, array('..', '.'));
		for($i=2; $i<count($folders)+2; $i++){
			$p = "../img/imgFantes/".$folders[$i];
			$names = getImages($p);
			$ar = cookArr($names, $p);
			$res = array_merge($res, $ar);
		}
		shuffle($res);
		$_SESSION['FPImgArr'] = $res;
		$arr = [];
		$arr['imgs'] = array_slice($res, 0, 12);
		$arr['len'] = count($res);
		echo json_encode($arr);
		return;
	}
	$a = getImages("../img/imgFantes/$d");
	$c = cookArr($a, "../img/imgFantes/$d");
	$_SESSION['FPImgArr'] = $c;
	$res = [];
	$res['len'] = count($c);
	$res['imgs'] = array_splice($c, 0, 12);
	echo json_encode($res);
	
	function cookArr ($arr_path, $dir){
		$res = [];
		for($i=0; $i<count($arr_path); $i++){
			$p = $dir.'/'.$arr_path[$i];
			$finfo = getimagesize($p);
			$a = [];
			$a[]=$p;
			$a[]=$finfo[0];
			$a[]=$finfo[1];
			$res[] = $a;
		}
		return $res;
	}
?>