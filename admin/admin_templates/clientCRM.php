<link rel="stylesheet" type="text/css" href="css/calendar.css">
<link rel="stylesheet" type="text/css" href="css/clientCRM.css">
<script type="text/javascript" src="js/clientCRM.js"></script>
<script type="text/javascript" src="js/speech.js"></script>
<?php
	include "admin_templates/view_choise_modal.php";
?>


<div class="dayModalWrapp">
	<div>
		<h3 style="margin-top: 0; text-align: center;"></h3>
		<img class="modalDayClose" width="30px" src="../img/close.png">
		
		<div style="display: flex;">
			<div class="inp_wrap_modal">
				<button>Добавить</button>
				<select>
					<option value="тип события">тип события</option>
					<option value="замер">замер</option>
					<option value="монтаж">монтаж</option>
					<option value="вх. звонок">вх. звонок</option>
					<option value="ис. звонок">ис. звонок</option>
					<option value="заказать">заказать</option>
					<option value="доставка">доставка</option>
					<option value="другое">другое</option>
				</select>
				<div style="display: flex; flex-direction: column;">
					<input style="width: 150px;" placeholder="Начало" type="text" name="start">
					<input style="width: 150px;" placeholder="Конец" type="text" name="finish">
				</div>
			</div>
			<div class="insertwrappModal">
				<div class="inserChoiseBlock">
					<button class="choise_modal_button_id">выбрать:</button>
				</div>
				<div class="choised_cart_insert"></div>
			</div>
		</div>
		<div style="margin-top: 20px;" class="add_block_modal"></div>
	</div>
</div>
	

<div class="year_cont">
	<div>		
		<button class="year_btn">2024</button>
		<button class="year_btn">2025</button>
		<button class="year_btn">2026</button>
		<button class="year_btn">2027</button>
		<button class="year_btn">2028</button>
	</div>
</div>

<?php
	$db = new SQLite3("crm.db");

	function getEmptyDiv($d){
		$w = (int)date("w",strtotime($d));
		if($w == 0){
			return 6;
		}else{
			return $w - 1;
		}
	}

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


	$f = 28;
	$month = (int)date('m');
	$day  = (int)date('d');

	if(isLiap(20 + date('y'))) $f = 29;

	$c = [["Январь",31, "01"],["Февраль",$f, "02"],["Март",31, "03"],["Апрель",30, "04"],
			["Май",31, "05"],["Июнь",30,"06"],["Июль",31,"07"],["Август",31,"08"],["Сентябрь",30,"09"],
			["Октябрь",31,"10"],["Ноябрь",30, "11"],["Декабрь",31,"12"]];
	$cout = [];

	if($month == 1){
		$cout = [$c[10],$c[11], $c[0], $c[1], $c[2]];
	}
	elseif($month == 2){
		$cout = [$c[11],$c[0], $c[1], $c[2], $c[3]];
	}
	elseif($month == 12){
		$cout = [$c[9],$c[10], $c[11], $c[0], $c[1]];
	}
	elseif($month == 11){
		$cout = [$c[8],$c[9], $c[10], $c[11], $c[0]];
	}
	else{
		$cout = array_slice($c, ($month-3), 5);
	}


	$tagY = date('y');
	if($month <= 2){
		$tagY = date('y') - 1;
	}
	$serchData = "20".$tagY."-".$cout[0][2]."-01";

	$numEmty = getEmptyDiv($serchData);


	$time_start = strtotime($serchData);

	$res = $db->query("SELECT * FROM events WHERE time_start >= $time_start");
	$events = [];
	while($r = $res->fetchArray(SQLITE3_ASSOC)){
		$events[] = $r;
	}

	echo "<div class='wrapp_m'>";
	$cSm = ceil(strtotime($serchData) / 86400)%4;


	for($i=0; $i<count($cout); $i++){
		// добавляем теги к месяцам предыдущего и следующего года 
		$tag_next_last_year = null;
		if($i==0){
			if($cout[$i][2]=="11"){
				$tag_next_last_year = "last-year";
			}
			if($cout[$i][2]=="12"){
				$tag_next_last_year = "last-year";
			}
		}
		if($i==1){
			if($cout[$i][2]=="12"){
				$tag_next_last_year = "last-year";
			}
		}
		if($i == 3){
			if($cout[$i][2]=="01"){
				$tag_next_last_year = "next-year";
			}
		}	
		if($i == 4){
			if($cout[$i][2]=="01"){
				$tag_next_last_year = "next-year";
			}
			if($cout[$i][2]=="02"){
				$tag_next_last_year = "next-year";
			}
		}
		echo "<div $tag_next_last_year numbMonth='{$cout[$i][2]}' class='month'>";
		echo "<h2>{$cout[$i][0]}</h2>";
		for($j=1; $j<=$cout[$i][1]; $j++){
			if($j == 1){
				echo "<div class='week'>";
				for($k=0; $k<$numEmty; $k++){
					echo "<div></div>";
				}
			}
			$todayCl = null;

			if(date('m') == $cout[$i][2]){
				if($j == $day){
					$todayCl = "today";
				}
			}

			$smClass = null;
			if($cSm == 4){
				$smClass = "sm2";
				$cSm = 1;
			}elseif($cSm == 3){
				$smClass = "sm1";
				$cSm++;
			}else{
				$smClass = "sm2";
				$cSm++;
			}
			$evHtml = null;
			$fl_e = false;

			for($e = 0; $e < count($events); $e++){
				$start = $events[$e]['start'];
				$finish = $events[$e]['finish'];
				$e_m = substr($start, 3, 2);
				if($cout[$i][2] == $e_m){
					$e_d_s = (int)substr($start, 0, 2);
					$e_d_f = (int)substr($finish, 0, 2);
					if($e_d_s <= $j and $j <= $e_d_f){
						$n_col = null;
						if($events[$e]['type'] == "замер"){
							$n_col = 'zam_col';
						}
						if($events[$e]['type'] == "монтаж"){
							$n_col = 'mount_col';
						}
						if($events[$e]['type']== "вх. звонок"){
							$n_col = "in_colling_col";
						}
						if($events[$e]['type']== "заказать"){
							$n_col = "zakazat_col";
						}
						if($events[$e]['type']== "доставка"){
							$n_col = "deliv_col";
						}
						if($events[$e]['type']== "ис. звонок"){
							$n_col = "out_coling_col";
						}
						if($events[$e]['type']=="другое"){
							$n_col = "other_col";
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
			if(($j+$numEmty) % 7 == 0){
				echo "</div>";
				echo "<div class='week'>";
			}
			if($j == $cout[$i][1]){
				$a = ($cout[$i][1] - (7 - $numEmty));
				$r = $a / 7;
				$r = (int)$r;
				$r = 7 - ($a -($r*7));
				if($r>0){
					for($k=0; $k<$r; $k++){
						echo "<div></div>";
					}
				}
				$numEmty = 7-$r;
				echo "</div>";
			}
		}
		echo "</div>";
	}
	echo "</div>";
?>
