<?php
	function getImages($dir){
		$files = scandir($dir);
		$files = array_diff($files, array('..', '.'));
		$ar = array();
		$i = 0;
		foreach ($files as $k) {
			$ar[$i] = $k;
			$i++;
		}
		return $ar;
	}

?>