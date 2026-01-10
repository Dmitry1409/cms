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
<script type="text/javascript" src="js/tovari.js"></script>

<?php
	$res = $db->query("SELECT * FROM complect");
	$arr = [];
	while ($r= $res->fetchArray(SQLITE3_ASSOC)) {
		$arr[] = $r;
	}
?>

<div style="width: 100%; padding: 0 20px; margin-bottom: 20px;">
	<input placeholder="поиск" style="width: 100%;" autocomplete="off" type="text" name="search">
	<div class="result"></div>
</div>

<table>
	<thead>
		<tr>
			<td>id</td>
			<td>Наименование</td>
			<td>ед.</td>
			<td>Цена</td>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($arr as $a):?>
			<tr rowid=<?php echo $a['id']?>>
				<td><?php echo $a['id']?></td>
				<td colname='name'><?php echo $a['name']?></td>
				<td colname='metric'><?php echo $a['metric']?></td>
				<td colname='price'><?php echo $a['price']?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>