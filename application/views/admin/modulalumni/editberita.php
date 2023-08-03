<div class="content-wrapper">
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Berita : <?php echo $nama_alumni; ?></h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active">Edit Berita</li>
            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/ModulAlumni/listberita/'.$this->uri->segment(4)) ?>">List Berita</a></li>
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
                <?php $this->load->view('admin/modulalumni/partisi_menu.php') ?>
            </div>
        </div>
        </div>
        <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Berita : <?php echo $judul_berita; ?></h3>
            </div>
            <div class="card-body">
            <form id="editberita_form" method="post">
                <?php foreach ($berita as $x): ?>
                <div class="mb-3 row">
                    <label for="nama_alumni" class="col-lg-2 col-form-label" >Judul Berita</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_alumni" name="judul_berita" placeholder="Judul Berita" required value="<?php echo $x->judul_berita; ?>">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="nama_alumni" class="col-sm-2 col-form-label">Pilih Kategori Berita</label>
                    <div class="col-sm-10">
                        <select class="form-control" aria-label="Default select example" required name="id_kategoriberita" id="tahun_lulus">
                            <option value="">Pilih Kategori Berita</option>
                            <?php foreach ($list_kategoriberita as $list): ?>
                            <?php if($list->id_kategoriberita == $x->id_kategoriberita){ ?>
                            <option selected value="<?php echo $list->id_kategoriberita; ?>"><?php echo $list->nama_kategoriberita ?></option>
                            <?php }else{ ?>
                            <option value="<?php echo $list->id_kategoriberita; ?>"><?php echo $list->nama_kategoriberita ?></option>
                            <?php } ?>
                            <?php endforeach; ?>
                        </select>
                        <small style="font-size: 12px;"><i>Request ke admin jika ingin menambahkan kategori berita baru</i></small>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="nama_alumni" class="col-sm-2 col-form-label">Status Berita</label>
                    <div class="col-sm-10">
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" name="status_berita" id="flexRadioDefault11" <?php if($x->status_berita == "Y"){ ?> checked <?php } ?> value="Y">
                            <label class="custom-control-label" for="flexRadioDefault11" style="font-weight: normal;">
                                Published
                            </label>
                            </div>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" name="status_berita" id="flexRadioDefault22" <?php if($x->status_berita == "N"){ ?> checked <?php } ?> value="N">
                            <label class="custom-control-label" for="flexRadioDefault22" style="font-weight: normal;">
                                UnPublished
                            </label>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="id_berita" value="<?php echo $x->id_berita; ?>">

                <div class="mb-3 row">
                    <label for="nama_alumni" class="col-sm-2 col-form-label">Isi Berita</label>
                    <div class="col-sm-10">
                        <textarea id="isi_berita" class="form-control" name="isi_berita" rows="10" required><?php echo $x->isi_berita ?></textarea>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="nama_alumni" class="col-sm-2 col-form-label">Gambar</label>
                    <div class="col-sm-10">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name="myFile" >
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                        <small style="font-size: 12px;"><i>Gambar Terpasang : <a href="<?php echo base_url('assets/berita/'.$x->gambar_berita) ?>" target="__BLANK"><?php echo $x->gambar_berita; ?></a> </i></small>
                    </div>
                </div>

                <?php endforeach; ?>               
                <button type="submit" class="btn btn-primary" style="float: right;"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner"></span> Update</button>
            </form>
            </div>
        </div>
    </div>
</section>
</div>

