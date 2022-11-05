<?php
	function collect_data(){
		if(isset($_SESSION)){			
			if(!isset($_SESSION['time_vis'])){
				$_SESSION['time_vis'] = date("H:i:s");
				// $_SESSION['HTTP_REFERER'] = [];
				// $_SESSION["HTTP_REFERER"][] = date("H:i:s")." ".$_SERVER['HTTP_REFERER'].", ";
				$_SESSION['HTTP_USER_AGENT'] = $_SERVER['HTTP_USER_AGENT'];
				$_SESSION['REMOTE_ADDR'] = $_SERVER['REMOTE_ADDR'];
				$_SESSION['HTTPS'] = $_SERVER['HTTPS'];
				$_SESSION['REQUEST_URI'] = $_SERVER['REQUEST_URI'];
				$_SESSION['REQUEST_METHOD'] = $_SERVER['REQUEST_METHOD'];
				$_SESSION['SERVER_PROTOCOL'] = $_SERVER['SERVER_PROTOCOL'];
			}

			// $_SESSION["HTTP_REFERER"][] = date("H:i:s")." ".$_SERVER['HTTP_REFERER'].", ";
		}


	}
?>