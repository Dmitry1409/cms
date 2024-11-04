<html lang="en">
<head>
	<meta charset="UTF-8">
</head>
<body>

	<style type="text/css">
		table {
			border-collapse: collapse;
			border: 1px solid grey;
		}
		td {
			border: 1px solid grey;
			padding: 3px;
		}
	</style>
	
	<h3>Полотна</h3>

	<?php

		$polot = [];
		$complect = [];

		// $idZamer = "(1,2,3)";

		$res_db = $db->query("SELECT * FROM zamer WHERE id in $idZamer");
		while($z = $res_db->fetchArray(SQLITE3_ASSOC)){
			$js = json_decode($z['json']);
			$polot = array_merge($polot, $js->rooms);
			foreach($js->sum_mat as $k=>$v){
				if(array_key_exists($k, $complect)){
					$complect[$k] += $v;
				}else{
					$complect[$k] = $v;
				}
			}

		}

		$res = $db->query("SELECT * FROM products");
		$prod = [];
		while($r = $res->fetchArray(SQLITE3_ASSOC)){
			$prod[] = $r;
		}

		
		function out_polotna($arr){
			$n = 1;
			foreach ($arr as $r) {
				echo "<tr>";
					echo "<td>$n</td>";
					$n++;
					echo "<td>полотно пвх</td>";
					echo "<td>{$r->{'полотно'}}</td>";
					$raz = '';
					if(array_key_exists("стена А", $r)){
						$raz = $r->{'стена А'}." х ".$r->{'стена Б'};
					}else{
						$raz = "на фото";
					}
					echo "<td>$raz</td>";
					$f = null;
					if(array_key_exists("фото", $r)){
						$f = "<a style='margin-left: 20px;' target='_blank' href='https://auroom-nn.ru/admin/img_admin/img_zamer/{$r->{'фото'}}'><img style='width: 50px;' src='https://auroom-nn.ru/admin/img_admin/img_zamer/{$r->{'фото'}}'></a>";
					}
					echo "<td>$f</td>";
				echo "</tr>";
			}
		}

		function out_comp($arr){
			global $prod;
			$n = 1;
			foreach ($arr as $key => $value) {
				echo "<tr>";
					echo "<td>$n</td>";
					$n++;
					echo "<td>$key</td>";
					echo "<td>$value</td>";
					$ed = null;
					foreach ($prod as $p) {
						if($p["name"] == $key){
							$ed = $p['metric'];
							break;
						}
					}
					echo "<td>$ed</td>";
				echo "</tr>";

			}
		}
	?>
	<table>
		<thead>
			<tr>
				<td>#</td>
				<td>Наименование</td>
				<td>факт.</td>
				<td>размеры</td>
				<td>фото</td>
			</tr>
		</thead>
		<tbody>
			<?php  out_polotna($polot)?>
		</tbody>
	</table>

	<h3>Комплектующие</h3>

	<table>
		<thead>
			<tr>
				<td>#</td>
				<td>Наименование</td>
				<td>кол.</td>
				<td>ед.</td>
			</tr>
		</thead>
		<tbody>
			<?php  out_comp($complect)?>
		</tbody>
	</table>

</body>
</html>