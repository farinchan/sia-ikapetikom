<style>
.str{
	mso-number-format : \@;
}
</style>

<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Alumni.xls");
?>

<table border="1">
	<tr>
		<th>No</th>
		<th>NIA</th>
		<th>Nama</th>
		<th>Tahun Lulus</th>
		<th>Status</th>
		<th>Detail Pekerjaan</th>
		<th>No WA</th>
		<th>Alamat</th>
		<th>Email</th>
	</tr>
	<?php $i=1; foreach ($data as $x): ?>
	<tr>
		<td><?php echo $i++; ?></td>
		<td><?php echo $x->nisn; ?></td>
		<td><?php echo $x->nama_alumni; ?></td>
		<td><?php echo $x->tahun_lulus; ?></td>
		<td><?php echo $x->status_alumni; ?></td>
		<td><?php echo $x->detail_status; ?></td>
		<td class="str"><?php echo $x->no_wa; ?></td>
		<td><?php echo $x->detail_alamat; ?></td>
		<td><?php echo $x->email; ?></td>
	</tr>
	<?php endforeach; ?>
</table>