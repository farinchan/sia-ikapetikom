<style>
.str{
	mso-number-format : \@;
}
</style>

<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Donasi.xls");
?>

<table border="1">
	<tr>
		<th>No</th>
        <th>Judul Donasi</th>
		<th>Kategori</th>
		<th>Donasi Dibuka / Donasi Ditutup</th>
		<th>Total Dilihat (Kali)</th>
        <th>Target Dana</th>
	</tr>
	<?php $i=1; foreach ($data as $x): ?>
	<tr>
		<td><?php echo $i++; ?></td>
		<td><?php echo $x->judul_donasi; ?></td>
		<td><?php echo $x->nama_kategoridonasi; ?></td>
		<td class="str"><?php echo $x->donasi_dibuka." / ".$x->donasi_ditutup; ?></td>
		<td><?php echo $x->total_dilihat; ?></td>
		<td class="str"><?php echo number_format($x->target_dana,2,',','.') ; ?></td>
	</tr>
	<?php endforeach; ?>
</table>