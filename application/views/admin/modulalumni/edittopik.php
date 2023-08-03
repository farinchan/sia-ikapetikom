<div class="content-wrapper">
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Topik : <?php echo $nama_alumni; ?></h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active">Edit Topik</li>
            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/ModulAlumni/listtopik/'.$this->uri->segment(4)) ?>">List Topik</a></li>
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
            <?php $this->load->view('admin/modulalumni/partisi_menu.php'); ?>
            </div>
        </div>
        </div>
        <div class="col-md-9">
        <div class="card">
        <?php foreach ($data as $topik): ?>
            <div class="card-header">
                <h3 class="card-title">Topik : <?php echo $topik->judul_topik; ?></h3>
            </div>
            <div class="card-body">

            <form id="form_edittopik" method="post">
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Kategori</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="kategori_post" aria-label="Default select example" required name="kategori_topik">
                                <option value="">Pilih Kategori</option>
                                <?php foreach ($list_kategori as $list): ?>
                                <?php if($topik->id_kategoritopik == $list->id_kategoritopik){ ?>
                                <option selected value="<?php echo $list->id_kategoritopik; ?>">- <?php echo strtoupper($list->nama_kategoritopik); ?> - </option>
                                <?php }else{ ?>
                                <option value="<?php echo $list->id_kategoritopik; ?>">- <?php echo strtoupper($list->nama_kategoritopik); ?> - </option>
                                <?php } ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Judul</label>
                        <div class="col-sm-10">
                            <input type="text" name="judul_topik" id="judul_post" class="form-control" required value="<?php echo $topik->judul_topik; ?>">
                        </div>
                    </div>
                    
                    <input type="hidden" name="id_topik" value="<?php echo $topik->id_topik; ?>">

                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Hak Akses</label>
                        <div class="col-sm-10">
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="hak_akses" id="flexRadioDefault1" value="private" <?php if($topik->hak_akses == 'private'){ ?> checked <?php } ?>>
                                <label class="custom-control-label" for="flexRadioDefault1" style="font-weight: normal;">
                                    Private (Hanya Alumni Anda)
                                </label>
                                </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="hak_akses" id="flexRadioDefault2"  value="public" <?php if($topik->hak_akses == 'public'){ ?> checked <?php } ?>>
                                <label class="custom-control-label" for="flexRadioDefault2" style="font-weight: normal;">
                                    Public (Semua Alumni)
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10">
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="status_topik" id="flexRadioDefault11" value="Y" <?php if($topik->status_topik == 'Y'){ ?> checked <?php } ?>>
                                <label class="custom-control-label" for="flexRadioDefault11" style="font-weight: normal;">
                                    Diskusi dibuka
                                </label>
                                </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="status_topik" id="flexRadioDefault22"  value="N" <?php if($topik->status_topik == 'N'){ ?> checked <?php } ?>>
                                <label class="custom-control-label" for="flexRadioDefault22" style="font-weight: normal;">
                                    Diskusi ditutup
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Postingan Anda</label>
                        <div class="col-sm-10">
                            <textarea id="textarea_diskusi" class="form-control" name="isi_topik" rows="13" placeholder="Assalamualaikum..." required><?php echo $topik->isi_topik; ?></textarea>
                        </div>                    
                    </div>

                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Lampiran File </label>
                        <div class="col-sm-10">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name="myFile">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                            <?php if($topik->lampiran_file != "kosong"){ ?>
                            <small style="font-size: 12px;">Lampiran File : <a href="<?php echo base_url('main/downloadfiletopik?data='.$topik->lampiran_file) ?>"><?php echo $topik->lampiran_file; ?></a></small><br>
                            <small style="font-size: 12px;">(*) Kosongkan Jika tidak ingin diubah</i></small>
                            <?php } ?>

                        </div>
                    </div>

                    <button class="btn btn-primary" type="submit" style="float: right;"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner"></span> Update</button>
                </form>
                <?php endforeach; ?>

            </div>
        </div>
    </div>
</section>
</div>

