<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0
				maximum-scale=1.0, user-scalable=0">
	<meta name="robots" content="index, follow">
	<link rel="stylesheet" type="text/css" href=<?php echo $GLOBALS['root_dir']."css/".$GLOBALS['fn']['main.css'] ?>>
	<link rel="stylesheet" type="text/css" href=<?php echo $GLOBALS['root_dir']."css/".$GLOBALS['fn']['normalize.css']?>>
	<link rel="stylesheet" type="text/css" href=<?php echo $GLOBALS['root_dir']."css/".$GLOBALS['fn']["fancybox.css"]?>>
	<script defer type="text/javascript" src=<?php echo $GLOBALS['root_dir']."js/".$GLOBALS['fn']["main.js"]?>></script>
	<script defer type="text/javascript" src=<?php echo $GLOBALS['root_dir']."js/".$GLOBALS['fn']["fancybox.js"]?>></script>
	<script defer type="text/javascript" src=<?php echo $GLOBALS['root_dir']."js/".$GLOBALS['fn']["feedBackClient.js"]?>></script>
	<script defer type="text/javascript" src=<?php echo $GLOBALS["root_dir"]."js/".$GLOBALS['fn']["simpleCeilOffer.js"]?>></script>
	<script defer type="text/javascript" src=<?php echo $GLOBALS["root_dir"]."js/".$GLOBALS['fn']["sale_light_block.js"]?>></script>
	<?php
		if(strpos($_SERVER['REQUEST_URI'], "favourites") == false){
			echo "<script defer type='text/javascript' src=".$GLOBALS['root_dir']."js/".$GLOBALS['fn']["exampWorkFoto.js"]."></script>";
		}
	?>
	<link rel="apple-touch-icon" sizes="180x180" href='<?php echo $GLOBALS['root_dir']."img/favicon_io/apple-touch-icon.png"?>'>
	<link rel="icon" type="image/png" sizes="32x32" href='<?php echo $GLOBALS['root_dir']."img/favicon_io/favicon-32x32.png"?>'>
	<link rel="icon" type="image/png" sizes="16x16" href='<?php echo $GLOBALS['root_dir']."img/favicon_io/favicon-16x16.png"?>'>
	<link rel="manifest" href=<?php echo $GLOBALS['root_dir'].$GLOBALS['fn']["site.webmanifest"]?>>
	<!-- Yandex.Metrika counter -->
	<!-- <script type="text/javascript" >
		   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
		   m[i].l=1*new Date();
		   for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
		   k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
		   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

		   ym(91462500, "init", {
		        clickmap:true,
		        trackLinks:true,
		        accurateTrackBounce:true,
		        webvisor:true
		   });
		</script>
	<noscript><div><img src="https://mc.yandex.ru/watch/91462500" style="position:absolute; left:-9999px;" alt="" /></div></noscript> -->
	<!-- /Yandex.Metrika counter -->