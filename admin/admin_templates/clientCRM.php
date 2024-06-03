<link rel="stylesheet" type="text/css" href="css/calendar.css">
<link rel="stylesheet" type="text/css" href="css/clientCRM.css">
<script type="text/javascript" src="js/clientCRM.js"></script>


<div class="dayModalWrapp">
	<div>
		<h3 style="margin-top: 0; text-align: center;"></h3>
		<img class="modalDayClose" width="30px" src="../img/close.png">
		
		<div style="display: flex;">
			<div class="inp_wrap_modal">
				<button>Добавить</button>
				<select>
					<option value="-">тип события</option>
					<option value="замер">Замер</option>
					<option value="монтаж">Монтаж</option>
					<option value="звонок">Звонок</option>
					<option value="заказать">Заказать</option>
					<option value="доставка">Доставка</option>
					<option value="посчитать">Посчитать</option>
					<option value="другое">Другое</option>
				</select>
				<div style="display: flex; flex-direction: column;">
					<input style="width: 150px;" placeholder="Начало" type="text" name="start">
					<input style="width: 150px;" placeholder="Конец" type="text" name="finish">
				</div>
			</div>
			<div class="insertwrappModal">
				<div class="inserChoiseBlock">
					<div>выбрать:</div>
				</div>
				<div class="insertClients"></div>
			</div>
		</div>
	</div>
</div>
	

<?php
	$db = new SQLite3("crm.db");

	function isLiap($y){
		if($y % 400 == 0){
			return true;
		}elseif ($y % 100 == 0){
			return false;
		}elseif($y % 4 == 0){
			return true;
		}else{
			return false;
		}
	}

	$em = 0;
	$f = 28;
	$month = (int)date('m');
	$day  = (int)date('d');
	if(isLiap(20 + date('y'))) $f = 29;
	$c = [["Январь",31],["Февраль",$f],["Март",31],["Апрель",30],
			["Май",31],["Июнь",30],["Июль",31],["Август",31],["Сентябрь",30],
			["Октябрь",31],["Ноябрь",30],["Декабрь",31]];

	$res = $db->query("SELECT * FROM events");
	$events = [];
	while($r = $res->fetchArray(SQLITE3_ASSOC)){
		$events[] = $r;
	}

	echo "<div class='wrapp_m'>";
	$cSm = 1;
	for($i=0; $i<count($c); $i++){
		$nmont;
		if(($i + 1)>= 10){
			$nmont = $i+1;
		}else{
			$nmont = '0'.($i+1);
		}
		echo "<div numbMonth='$nmont' class='month'>";
		$nm = $c[$i][0];
		echo "<h2>$nm</h2>";
		for($j=1; $j<=$c[$i][1]; $j++){
			if($j == 1){
				echo "<div class='week'>";
				if($em > 0){
					for($k=0; $k<$em; $k++){
						echo "<div></div>";
					}
				}
			}
			$todayCl = null;
			if($i == $month - 1){
				if($j == $day){
					$todayCl = "today";
				}
			}
			$smClass = null;
			if($cSm == 1){
				$smClass = "sm1";
				$cSm = 2;
			}elseif($cSm == 2){
				$smClass = "sm2";
				$cSm = 3;
			}elseif($cSm == 3){
				$smClass = "sm2";
				$cSm = 4;
			}else{
				$smClass = "sm2";
				$cSm = 1;
			}
			$evHtml = null;
			$fl_e = false;
			for($e = 0; $e < count($events); $e++){
				$start = $events[$e]['start'];
				$e_m = (int)substr($start, 3, 2);
				if($i == ($e_m -1)){
					$e_d = (int)substr($start, 0, 2);
					if(($e_d ) == $j){
						$n_col = null;
						if($events[$e]['type'] == "замер"){
							$n_col = 'zam_col';
						}
						if($events[$e]['type'] == "монтаж"){
							$n_col = 'mount_col';
						}
						if($fl_e){
							$evHtml = $evHtml."<div class='n-point $n_col'></div>";
						}else{
							$evHtml = "<div class='n_point_wrapp'><div class='n-point $n_col'></div>";
							$fl_e = true;
						}
					}
				}
			}
			if($fl_e){
				$evHtml = $evHtml."</div>";
			}
			echo "<div class='no-empty $smClass $todayCl'>$j$evHtml</div>";
			if(($j+$em) % 7 == 0){
				echo "</div>";
				echo "<div class='week'>";
			}
			if($j == $c[$i][1]){
				$a = ($c[$i][1] - (7 - $em));
				$r = $a / 7;
				$r = (int)$r;
				$r = 7 - ($a -($r*7));
				if($r>0){
					for($k=0; $k<$r; $k++){
						echo "<div></div>";
					}
				}
				$em = 7-$r;
				echo "</div>";
			}
		}
		echo "</div>";
	}
	echo "</div>";
?>
