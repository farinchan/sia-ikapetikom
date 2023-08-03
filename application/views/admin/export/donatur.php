<style>
.str{
	mso-number-format : \@;
}
</style>

<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Donatur ".$judul_donasi.".xls");
?>
<h1>Data Donatur <?php echo $judul_donasi; ?></h1>
<table border="1">
	<tr>
		<th>No</th>
        <th>Tanggal Donasi</th>
		<th>Nama Donatur</th>
		<th>Nominal</th>
	</tr>
	<?php $i=1; foreach ($donatur as $x): ?>
	<tr>
		<td><?php echo $i++; ?></td>
		<td class="str"><?php echo $x->tanggal_bayar; ?></td>
        <td><?php echo $x->nama_alumni; ?></td>
		<td class="str"><?php echo number_format($x->total_donasi,2,',','.') ; ?></td>
	</tr>

	<?php endforeach; ?>
    <tr>
        <td colspan="3">Total</td>
        <td class="str"><?php echo number_format($totaldanaterkumpul,2,',','.'); ?></td>
    </tr>
</table>