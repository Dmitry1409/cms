<?php

	function exectRequest($q, $db){
		$res = $db->query($q);
		$otv = [];
		while($r = $res->fetchArray(SQLITE3_ASSOC)){
			$otv[] = $r;
		}
		return $otv;
	}

	function createSQLRequest($fields, $table_name, $col, $select){
		$q = "SELECT ";
		if($fields == "*"){
			$q = $q."* ";
		}
		if(is_array($fields)){
			for($i=0; $i<count($fields); $i++){
				$q = $q.$fields." ";
				if($i != count($fields)-1){
					$q = $q.",";
				}
			}
		}
		$q = $q." FROM $table_name WHERE $col ";
		if(is_array($select)){
			$q = $q."in (";
			for($i=0; $i<count($select); $i++){
				$q = $q."'".$select[$i]."'";
				if($i == count($select)-1){
					$q = $q.")";
				}else{
					$q = $q.",";
				}
			}
		}
		return $q;

	}

?>