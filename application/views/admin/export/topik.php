<style>
.str{
	mso-number-format : \@;
}
</style>

<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Topik.xls");
?>

<table border="1">
	<tr>
		<th>No</th>
        <th>NIA</th>
		<th>Pembuat Topik</th>
		<th>Judul Topik</th>
		<th>Tanggal Posting</th>
		<th>Status</th>
		<th>Total Dilihat (Kali)</th>
	</tr>
	<?php $i=1; foreach ($data as $x): ?>
	<tr>
		<td><?php echo $i++; ?></td>
		<td><?php echo $x->nisn; ?></td>
		<td><?php echo $x->nama_alumni; ?></td>
		<td><?php echo $x->judul_topik; ?></td>
		<td class="str"><?php echo $x->tanggal; ?></td>
        <?php if($x->status_topik == "Y"){ ?>
		<td>Published</td>
        <?php }else{ ?>
        <td>Not Published</td>
        <?php } ?>
		<td><?php echo $x->total_dilihat; ?></td>
	</tr>
	<?php endforeach; ?>
</table>