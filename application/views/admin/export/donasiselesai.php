<style>
.str{
	mso-number-format : \@;
}
</style>

<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Donasi Selesai.xls");
?>

<table border="1">
	<tr>
		<th>No</th>
        <th>Judul Donasi Selesai</th>
        <th>Target Dana</th>
        <th>Terkumpul</th>
	</tr>
	<?php $i=1; foreach ($data as $x): ?>
	<tr>
		<td><?php echo $i++; ?></td>
		<td><?php echo $x->judul_donasi; ?></td>
		<td class="str"><?php echo number_format($x->target_dana,2,',','.') ; ?></td>
        <td class="str"><?php echo number_format($x->donasi_terkumpul,2,',','.') ; ?></td>
	</tr>
	<?php endforeach; ?>
</table>