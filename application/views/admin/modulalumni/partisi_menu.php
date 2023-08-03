<?php foreach ($data_profil as $profil): ?>
<ul class="nav nav-pills flex-column">
    <li class="nav-item">
    <a class="nav-link" href="<?php echo base_url('admin/ModulAlumni/listberita/'.$profil->nisn) ?>">Kontribusi Berita <span class="badge badge-primary" style="float:right; margin-left:10px;"><?php echo $berita_acc; ?></span> <span class="badge badge-danger" style="float:right;"><?php echo $berita_noacc; ?></span></a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="<?php echo base_url('admin/ModulAlumni/listdonasi/'.$profil->nisn) ?>">Kontribusi Donasi <span class="badge badge-primary" style="float:right; margin-left:10px;"><?php echo $donasi_acc; ?></span> <span class="badge badge-danger" style="float:right;"><?php echo $donasi_gagal; ?></span></a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="<?php echo base_url('admin/ModulAlumni/listtopik/'.$profil->nisn); ?>">Kontribusi Topik <span class="badge badge-primary" style="float:right; margin-left:10px;"><?php echo $tot_topik; ?></span></a>
    </li>
</ul>
<?php endforeach; ?>