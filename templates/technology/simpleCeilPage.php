<?php
	$out_count = 6;
	include "templates/simple_ceil_offer_block.php";
?>

<?php
	include "templates/ligthing_link_block.php";
?>

<?php
	$query = "SELECT id_img FROM hashTags WHERE name in ('потолочная гардина','скрытая гардина','подсветка гардины')";
	$hashsSelect = ['#потолочная гардина', '#скрытая гардина', '#подсветка гардины'];
	include "templates/exampWorkFoto.php";
?>