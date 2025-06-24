<style type="text/css">
	.addClientWrap{
		display: flex;
		flex-wrap: wrap;
	}
	.addClientWrap input, .addClientWrap textarea{
		margin: 3px;
	}
	.block-column{
		display: flex;
		max-width: 150px;
		border: 1px solid grey;
		padding: 5px;

		flex-direction: column;
	}
	.obj_id_class{
		position: relative;
	}
	.add_obj_id{
		position: absolute;
		top: -5px;
		right: -5px;
	}
	.client_cont{
		min-height: 100vh;
	}
	.client-row{
		position: relative;
		margin-bottom: 5px; 
		height: 110px;
		overflow: hidden;
		padding: 5px; 
		display: flex; 
		align-items: center; 
		flex-wrap: wrap; 
		border: 2px solid grey;
		transition: 0.5s;
	}
	.flex-wrap{
		display: flex; 
		flex-wrap: wrap;
		width: 100%;
		border-top: 1px solid green;
	}
	.finded_cl_bl{
		margin-top: 20px;
		border: 1px solid green;
	}
	.flex-column{
		padding: 5px;
		display: flex; 
		flex-direction: column;
		max-width: 150px;
		margin-right: 20px;
	}
	.head_finded_cl{
		display: flex; 
		justify-content: space-around;
	}
	.obj_border{
		border: 1px solid green;
		margin: 4px;
		/*border-bottom: 1px solid green;*/
	}
	.noFinded{
		position: absolute;
		bottom: 20%;
		right: 25px;
		opacity: 1;
		transition: 1s;
	}
	.status_client_checked{
		width: 18px;
		height: 18px;
	}
	.sort_cont{
		display: flex; 
		justify-content: space-between; 
		margin-left: 10px;
	}
	.sort_by_date{
		cursor: pointer;
		height: 50px;
	}
	.svg_up_client_row{
		position: absolute;
		bottom: 15px;
		right: 15px;
		fill:rgba(0,0,0,0.5);
		width:20px; 
		height:20px;
		transform: rotate(180deg);
	}
	.svg_sort_data{
		width: 16px;
		fill: green;
		transform: rotate(90deg);
	}
	.svg_up{
		transform: rotate(-90deg);
	}
	
</style>
<script type="text/javascript" src="js/allClient.js"></script>

<div style='padding-left: 5px; padding-right: 5px;'>

	<div class="addClientWrap">
		<input autocomplete="off" placeholder="Имя" type="text" name="clientName">
		<span style="position: relative;"><input autocomplete="off" placeholder="Телефон" type="tel" name="telehon"></span>
		<input autocomplete="off" placeholder="Адрес объекта" type="text" name="address">
		<input autocomplete="off" placeholder="Тип объекта" type="text" name="type">
		<input autocomplete="off" name="desc" placeholder="Описание">
		<input autocomplete="off" type="text" placeholder="Откуда нас нашел" name="from">
	</div>
	<button class="addClientId">Добавить</button>

	<h3>Список клиентов</h3>
	<?php
		$db = new SQLite3('crm.db');
		$res = $db->query("SELECT * FROM clients WHERE status in ('новый', 'повторно') ORDER BY created DESC");
		$out = [];
		while($r = $res->fetchArray(SQLITE3_ASSOC)){
			$q = "SELECT * FROM phones WHERE id in ".listToCupStr($r['ref_tel']);
			$r['tel_arr'] = getArrInDB($q);
			$q = "SELECT * FROM object WHERE id in ".listToCupStr($r['ref_obj']);
			$r['obj_arr'] = getArrInDB($q);
			$q = "SELECT * FROM events WHERE id in ".listToCupStr($r['ref_event']);
			$r['event_arr'] = getArrInDB($q);
			$q = "SELECT * FROM sheta WHERE id in ".listToCupStr($r['ref_shet']);
			$r['sheta_arr'] = getArrInDB($q);
			$out[] = $r;
		}
	?>
	<div class='sort_cont'>
		<span style="display: flex; flex-direction: column;">
			<span>
				<input value='все' class='all_check_box status_client_checked' type='checkbox'><span style='margin-left: 10px;'>все</span>
			</span>
			<span>
				<input checked="true" class='status_client_checked' value='новый' type='checkbox'><span style='margin-left: 10px;'>новый</span>
			</span>
			<span>
				<input checked="true" class='status_client_checked' value='повторно' type='checkbox'><span style='margin-left: 10px;'>повторно</span>
			</span>
			<span>
				<input class='status_client_checked' value='замер назначен' type='checkbox'><span style='margin-left: 10px;'>замер назначен</span>
			</span>
			<span>
				<input class='status_client_checked' value='замер выполнен' type='checkbox'><span style='margin-left: 10px;'>замер выполнен</span>
			</span>
			<span>
				<input class='status_client_checked' value='монтаж назначен' type='checkbox'><span style='margin-left: 10px;'>монтаж назначен</span>
			</span>
			<span>
				<input class='status_client_checked' value='монтаж выполнен' type='checkbox'><span style='margin-left: 10px;'>монтаж выполнен</span>
			</span>
			<span>
				<input class='status_client_checked' value='ушли' type='checkbox'><span style='margin-left: 10px;'>ушли</span>
			</span>
			<span>
				<input class='status_client_checked' value='нет связи' type='checkbox'><span style='margin-left: 10px;'>нет связи</span>
			</span>
		</span>

		<span class="sort_by_date">
			<span>по созданию:</span>
			<svg class="svg_sort_data" version="1.1" viewBox="17 21 60 60" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
					<g id="Layer_4_copy">
					<path d="M31.356,25.677l38.625,22.3c1.557,0.899,1.557,3.147,0,4.046l-38.625,22.3c-1.557,0.899-3.504-0.225-3.504-2.023V27.7   C27.852,25.902,29.798,24.778,31.356,25.677z"></path>
					<path d="M69.981,47.977l-38.625-22.3c-0.233-0.134-0.474-0.21-0.716-0.259l37.341,21.559c1.557,0.899,1.557,3.147,0,4.046   l-38.625,22.3c-0.349,0.201-0.716,0.288-1.078,0.301c0.656,0.938,1.961,1.343,3.078,0.699l38.625-22.3   C71.538,51.124,71.538,48.876,69.981,47.977z"></path>
					<path d="M31.356,25.677l38.625,22.3c1.557,0.899,1.557,3.147,0,4.046   l-38.625,22.3c-1.557,0.899-3.504-0.225-3.504-2.023V27.7C27.852,25.902,29.798,24.778,31.356,25.677z" style="stroke-miterlimit:10;"></path>
						</g>
				</svg>
		</span>
	</div>
	<div style="padding: 10px;">
		<span>Найдено: </span><span class="count_client_id"><?php echo count($out)?></span>
	</div>
	<?php
		echo "<div class='client_cont'>";
			for($i=0; $i<count($out); $i++){
				echo "<div class='client-row'>";
					echo "<div style='align-self: flex-start;' client_id={$out[$i]['id']} class='block-column cl_block_id'>";
						echo "<span>id:{$out[$i]['id']}</span>";
						echo "<span>{$out[$i]['name']}</span>";
						echo "<span cl_status='{$out[$i]['status']}' >{$out[$i]['status']}</span>";						
						for($j=0; $j<count($out[$i]['tel_arr']); $j++){
							echo  "<span tel_id='{$out[$i]['tel_arr'][$j]['id']}' class='tel_id'><a href=tel:{$out[$i]['tel_arr'][$j]['val']}$>{$out[$i]['tel_arr'][$j]['val']}</a></span>";
						}
					echo "</div>";
					$o = "";
					for($j=0; $j<count($out[$i]['obj_arr']); $j++){
						$o .= "<span obj_id={$out[$i]['obj_arr'][$j]['id']} class='obj_id_class block-column'>";
							$o .= "<span >Объект id:{$out[$i]['obj_arr'][$j]['id']}</span>";
							$o .= "<span obj_status='{$out[$i]['obj_arr'][$j]['status']}'>{$out[$i]['obj_arr'][$j]['status']}</span>";
							$o .= "<span>{$out[$i]['obj_arr'][$j]['description']}</span>";
							$o .= "<span>{$out[$i]['obj_arr'][$j]['address']}</span>";
							if($out[$i]['obj_arr'][$j]['ref_zamer']){
								$o .= "<span style='display: flex; flex-direction: column;'>";
								$zamer = json_decode($out[$i]['obj_arr'][$j]['ref_zamer']);
								for($k =0; $k<count($zamer); $k++){
									$o .= "<a href='showZamer?idZamer={$zamer[$k]}'>замер № {$zamer[$k]}</a>";
								}
								$o .= "</span>";
							}
						$o .= "</span>";
					}
					echo $o;	
					$e = "";
					for($j=0; $j<count($out[$i]['event_arr']); $j++){
						$e .= "<span class='block-column'>";
							$e .= "<span>id:{$out[$i]['event_arr'][$j]['id']}</span>";
							$e .= "<span>{$out[$i]['event_arr'][$j]['type']}:{$out[$i]['event_arr'][$j]['status']}</span>";
							if($out[$i]['event_arr'][$j]['type'] == "ис. звонок"){
								$e .= "<span><span style='font-weight: bold;'>Результат: </span>{$out[$i]['event_arr'][$j]['comment']}</span>";
							}
							$e .= "<span>{$out[$i]['event_arr'][$j]['start']}</span>";
						$e .= "</span>";
					}
					echo $e;
					$sh = "";
					for($j=0; $j<count($out[$i]['sheta_arr']); $j++){
						$sh .= "<span class='block-column'>";
							$sh .= "<span>Счет id:{$out[$i]['sheta_arr'][$j]['id']}</span>";
							$sh .= "<span>Дата: {$out[$i]['sheta_arr'][$j]['data']}</span>";
							$sh .= "<span>Объект id: {$out[$i]['sheta_arr'][$j]['ref_obj']}</span>";
						$sh .= "</span>";
					}
					echo $sh;
				echo "</div>";
			}
		echo "</div>";

	?>
</div>

<?php


	function getArrInDB($q){
		global $db;
		$res = $db->query($q);
		$out = [];
		if($res){
			while($t = $res->fetchArray(SQLITE3_ASSOC)){
				$out[] = $t;
			}
		}
		return $out;
	}

	function listToCupStr($js){
		$s = "(";
		$js = json_decode($js);
		for($i=0; $i<count($js); $i++){
			$s = $s.$js[$i];
			if($i != count($js)-1){
				$s = $s.",";
			}
		}
		$s .= ")";
		return $s;
	}
?>