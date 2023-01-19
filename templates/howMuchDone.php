<div style="display: flex; margin-top: 50px; justify-content: center; position: relative;">
	<div class="vert_line"></div>
</div>
<div class="heder_present" style="position: relative; z-index: 2;">
	<span>Нами установлено</span>
</div>
<?php
	$res = $db->query('SELECT * FROM howMuchDone');
	$a = [];
	$fl = false;
	while($r = $res->fetchArray(SQLITE3_ASSOC)){
		if(time() > $r['expires']){
			$inAr = [0, 0];
			switch ($r['id']){
				case 1:
					$inAr = [86400, 30];
					break;
				case 2:
					$inAr = [1209600, 30];
					break;
				case 3:
					$inAr = [1468800, 30];
					break;
				case 4:
					$inAr = [604800, 30];
					break;
				case 5:
					$inAr = [86400, 15];
					break;
				case 6:
					$inAr = [86400, 3];
					break;
			}
			updateVal($r, $inAr[0], $inAr[1]);
			$fl = true;
		}
	}
	if($fl){
		$res = $db->query('SELECT * FROM howMuchDone');
	}

	while($r = $res->fetchArray(SQLITE3_ASSOC)){
		$a[] = $r;
	}

	function updateVal($row, $frequ, $maxVal){
		global $db;
	
		$dif = time() - $row['expires'];
		$dif = (int) ($dif / $frequ);
		$allVall = 0;
		for($i = 0; $i < $dif; $i++){
			$v = $maxVal * (rand(0, 100)/100);
			$allVall = (int)($allVall + $v);
		}
		$allVall = $row['value'] + $allVall;
		$id = $row['id'];
		$q = "UPDATE howMuchDone SET value = $allVall WHERE id = $id";
		$db->exec($q);
		$t = time() + $frequ;
		$q = "UPDATE howMuchDone SET expires = $t WHERE id = $id";
		$db->exec($q);
	}
?>
<div class="howMuchDoneSection">
	<?php
		for($i=0; $i<count($a); $i++){
			$v = $a[$i]['value'];
			$n = $a[$i]['name'];
			$d = $a[$i]['dimension'];
			echo "<div class='howMuchCont'>";
				echo "<span><span>$v</span><span> $d</span></span>";
				echo "<span>$n</span>";
			echo "</div>";
		}
	?>
</div>