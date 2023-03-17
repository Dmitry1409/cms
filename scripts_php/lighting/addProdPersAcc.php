<?php
	session_start();
	if(array_key_exists('buyProducts', $_SESSION)){
		$ar = $_SESSION['buyProducts'];
		$addobj = json_decode($_GET['objProduct']);
		$code = $addobj->code;
		$fl = true;
		for($i=0; $i<count($ar); $i++){
			if($ar[$i]->code == $code){
				$ar[$i]->amount = $ar[$i]->amount + $addobj->amount;
				$fl = false;
			}
		}
		if($fl){
			$ar[] = $addobj;
			$_SESSION['buyProducts'] = $ar;
		}

	}else{
		$ob = json_decode($_GET['objProduct']);
		$_SESSION['buyProducts'] = [$ob];
	}

?>