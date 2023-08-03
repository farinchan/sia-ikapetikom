<div class="content-wrapper">
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Berita : <?php echo $nama_alumni; ?></h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active">List Berita</li>
            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/ModulAlumni/lihat/'.$this->uri->segment(4)) ?>"><?php echo $nama_alumni?></a></li>
            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/ModulAlumni/data') ?>">Data Alumni</a></li>
        </ol>
        </div>
    </div>
    </div>
</section>

<?php foreach ($data_profil as $profil): ?>
<?php
    $originalDate = $profil->waktu_join;
    $newDate = date("d F Y", strtotime($originalDate));
?>
<section class="content">
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-3">

        <div class="card">

            <div class="card-body p-0 mt-4 mb-4">
                <div class="text-center">
                    <a href="#" data-nisn="<?php echo $profil->nisn; ?>" id="foto_alumni" data-toggle="modal"><img src="<?php echo base_url('assets/user/img/'.$profil->foto_alumni) ?>" class="img-fluid rounded-circle" alt="..." width="170px"></a>
                    <?php if($profil->status_akun == "Y"){ ?>
                    <p class="mt-3" style="color: green;"><i class="fas fa-check-circle"></i> Akun Aktif</p>
                    <?php }else{ ?>
                    <p class="mt-3" style="color: red;"><i class="fas fa-times-circle"></i> Akun Tidak Aktif</p>
                    <?php } ?>
                    <h5>Alumni <?php echo $profil->tahun_lulus; ?> <br>
                    <small>Aktif, <?php if($last_login['hari'] != 0){echo $last_login['hari']." hari "; } if($last_login['jam'] != 0){echo $last_login['jam']." jam "; } ?> <?php echo $last_login['menit']." menit yang lalu" ?></small><br>
                    </h5>      
                </div>
            </div>

            <div class="card-footer text-center">
                <small style="font-size: 15px;">Waktu Pendaftaran, <?php echo $newDate; ?></small>
            </div>
            
        </div>
        <?php endforeach; ?>

        <div class="card">
            <div class="card-header">
            <h3 class="card-title">Kontribusi</h3>
            </div>
            <div class="card-body p-0">
            <?php $this->load->view('admin/modulalumni/partisi_menu'); ?>
            </div>
        </div>
        </div>
        <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">List Berita</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped" id="TahunLulus">
                    <thead>
                        <tr>
                        <th scope="col">No</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Status</th>
                        <th scope="col">Dilihat</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach ($berita as $x): ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo substr($x->judul_berita, 0, 20)."..."; ?></td>
                            <td><?php echo $x->nama_kategoriberita; ?></td>
                            <?php if($x->status_berita == "Y"){ ?>
                            <td><?php echo "<i style='color:green;'>Published</i>"; ?></td>
                            <?php }else{ ?>
                            <td><?php echo "<i style='color:red;'>Unpublished</i>"; ?></td>
                            <?php } ?>
                            <td><?php echo $x->total_dilihat." kali" ?></td>
                            <td><a href="<?php echo base_url('admin/ModulAlumni/editberita/'.$x->nisn.'/'.$x->id_berita) ?>"><span class="badge bg-primary"><i class="fas fa-edit"></i></span></a>  <a href="<?php echo base_url('main/bacaberita/'.$x->id_berita) ?>"><span class="badge bg-success"><i class="fas fa-eye"></i></span></a>  <a href="<?php echo base_url('admin/ModulAlumni/hapusberita/'.$x->id_berita.'/'.$this->uri->segment(4)) ?>" onclick="return confirm('Yakin Mau Menghapus Berita Ini ?')"><span class="badge bg-danger"><i class="fas fa-trash"></i></span></a> </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
</div>

