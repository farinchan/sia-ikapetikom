<style>
.str{
	mso-number-format : \@;
}
</style>

<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Berita.xls");
?>

<table border="1">
	<tr>
		<th>No</th>
        <th>NIA</th>
		<th>Pembuat Berita</th>
		<th>Judul</th>
		<th>Tanggal Posting</th>
		<th>Status</th>
		<th>Total Dilihat (Kali)</th>
	</tr>
	<?php $i=1; foreach ($alumni as $x): ?>
	<tr>
		<td><?php echo $i++; ?></td>
		<td><?php echo $x->nisn; ?></td>
		<td><?php echo $x->nama_alumni; ?></td>
		<td><?php echo $x->judul_berita; ?></td>
		<td class="str"><?php echo $x->tanggal_posting; ?></td>
        <?php if($x->status_berita == "Y"){ ?>
		<td>Published</td>
        <?php }else{ ?>
        <td>Not Published</td>
        <?php } ?>
		<td><?php echo $x->total_dilihat; ?></td>
	</tr>
	<?php endforeach; ?>

    <?php $j=$i; foreach ($admin as $x): ?>
	<tr>
		<td><?php echo $i++; ?></td>
		<td>Admin</td>
		<td>Admin</td>
		<td><?php echo $x->judul_berita; ?></td>
		<td class="str"><?php echo $x->tanggal_posting; ?></td>
        <?php if($x->status_berita == "Y"){ ?>
		<td>Published</td>
        <?php }else{ ?>
        <td>Not Published</td>
        <?php } ?>
		<td><?php echo $x->total_dilihat; ?></td>
	</tr>
	<?php endforeach; ?>
</table>