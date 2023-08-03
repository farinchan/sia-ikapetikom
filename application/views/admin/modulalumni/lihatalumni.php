<div class="content-wrapper">
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1>Data : <?php echo $nama_alumni; ?></h1>
        </div>
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"><?php echo $nama_alumni?></li>
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
        <div class="card">
            <div class="card-header">
            <h3 class="card-title">Kontribusi </h3>
            </div>
            <div class="card-body p-0">
                <?php $this->load->view('admin/modulalumni/partisi_menu'); ?>
            </div>
        </div>
        </div>
        <div class="col-md-9">
        <div class="card">
            <div class="card-header">
            <h3 class="card-title">Edit Akun</h3>
            </div>
            <div class="card-body">

            <form id="updateprofilalumni_form" method="post">
                <div class="mb-3 row">
                    <label for="nama_alumni" class="col-sm-2 col-form-label">NISN</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nisn" id="nisn" placeholder="Nisn" required readonly value="<?php echo $profil->nisn; ?>">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="nama_alumni" class="col-sm-2 col-form-label">Tahun Lulus</label>
                    <div class="col-sm-10">
                        <select class="form-control" aria-label="Default select example" required name="tahun_lulus" id="tahun_lulus">
                            <option value="">Pilih Tahun Kelulusan</option>
                            <?php foreach ($tahunlulus as $list_tahunlulus): ?>
                            <?php if($profil->tahun_lulus == $list_tahunlulus->tahun_lulus){ ?>
                                <option selected value="<?php echo $list_tahunlulus->tahun_lulus; ?>"><?php echo $list_tahunlulus->tahun_lulus; ?></option>
                            <?php }else{ ?>
                                <option value="<?php echo $list_tahunlulus->tahun_lulus; ?>"><?php echo $list_tahunlulus->tahun_lulus; ?></option>
                            <?php } ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="nama_alumni" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_alumni" name="nama_alumni" placeholder="Nama Lengkap" required value="<?php echo $profil->nama_alumni; ?>">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="nama_alumni" class="col-sm-2 col-form-label">Status Pekerjaan</label>
                    <div class="col-sm-10">
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" name="status_alumni" id="flexRadioDefault1" <?php if($profil->status_alumni == "bekerja"){ ?> checked <?php } ?> value="bekerja">
                            <label class="custom-control-label" for="flexRadioDefault1" style="font-weight: normal;">
                                Bekerja
                            </label>
                            </div>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" name="status_alumni" id="flexRadioDefault2" <?php if($profil->status_alumni == "pelajar"){ ?> checked <?php } ?> value="pelajar">
                            <label class="custom-control-label" for="flexRadioDefault2" style="font-weight: normal;">
                                Pelajar
                            </label>
                        </div>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="detail_status" id="detail_status" placeholder="Instansi Tempat Bekerja" required value="<?php echo $profil->detail_status; ?>">
                        <small style="font-size: 12px;"><i>Jika Pelajar masukkan instansi pendidikan</i></small>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="nama_alumni" class="col-sm-2 col-form-label">Status Akun</label>
                    <div class="col-sm-10">
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" name="status_akun" id="flexRadioDefault11" <?php if($profil->status_akun == "Y"){ ?> checked <?php } ?> value="Y">
                            <label class="custom-control-label" for="flexRadioDefault11" style="font-weight: normal;">
                                Aktif
                            </label>
                            </div>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" name="status_akun" id="flexRadioDefault22" <?php if($profil->status_akun == "N"){ ?> checked <?php } ?> value="N">
                            <label class="custom-control-label" for="flexRadioDefault22" style="font-weight: normal;">
                                Tidak Aktif
                            </label>
                        </div>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="nama_alumni" class="col-sm-2 col-form-label">No Hp / Wa</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="no_wa" name="no_wa" placeholder="No Hp / No WA" required value="<?php echo $profil->no_wa; ?>">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <select class="form-control" aria-label="Default select example" required name="provinsi" id="combobox_provinsi">
                            <option value="">Pilih Provinsi</option>
                            <?php foreach ($provinsi as $list_provinsi): ?>
                            <?php if($list_provinsi->kode == $profil->alamat_provinsi){ ?>
                            <option selected value="<?php echo $list_provinsi->kode; ?>"><?php echo strtolower($list_provinsi->nama); ?></option>
                            <?php }else{ ?>
                            <option value="<?php echo $list_provinsi->kode; ?>"><?php echo strtolower($list_provinsi->nama); ?></option>
                            <?php } ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <select class="form-control" aria-label="Default select example" required name="kabupaten" id="combobox_kabupaten" required>
                            <option value="">Pilih Kabupaten</option>
                            <option selected value="<?php echo $profil->alamat_kabupaten; ?>"><?php echo strtolower($kota['alamat_kabupaten']); ?></option>
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <select class="form-control" aria-label="Default select example" required name="kecamatan" id="combobox_kecamatan" required>
                            <option value="">Pilih Kecamatan</option>
                            <option selected value="<?php echo $profil->alamat_kecamatan; ?>"><?php echo strtolower($kota['alamat_kecamatan']); ?></option>
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="nama_alumni" class="col-sm-2 col-form-label">Detail Alamat</label>
                    <div class="col-sm-10">
                        <textarea id="textarea_diskusi" class="form-control" name="detail_alamat" rows="5" placeholder="Alamat Lengkap, Meliputi RT/RW" required><?php echo $profil->detail_alamat; ?></textarea>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="nama_alumni" class="col-sm-2 col-form-label">Lokasi</label>
                    <div class="col-sm-10">
                    <div id="map" style="height: 400px;"></div>
                    </div>
                    <input type="hidden" name="latitude" id="latitude" value="<?php echo $profil->latitude; ?>" readonly><br>
                    <input type="hidden" name="longitude" id="longitude" value="<?php echo $profil->longitude; ?>" readonly><br>
                </div>
                
                                <div class="mb-3 row">
                    <label for="nama_alumni" class="col-sm-2 col-form-label">Riwayat Pendidikan</label>
                    <div class="col-sm-10">
                        <table class="table table-bordered" id="tbl_riwayatpendidikan">
                            <tbody id="tbl_riwayatpendidikan_body">
                                <?php if(empty($riwayatpendidikan)): ?>
                                    <tr id="rec-1">
                                        <td><span class="sn"><input type="text" name="pen_tahun_mulai[]" required placeholder="Tahun Masuk..." class="form-control"></span></td>
                                        <td><span class="sn"><input type="text" name="pen_tahun_selesai[]" required placeholder="Tahun Lulus..." class="form-control"></span></td>
                                        <td><span class="sn"><input type="text" name="pen_lembaga[]" required placeholder="Lembaga Pendidikan..." class="form-control"></span></td>
                                        <td style="width:50px;"><a class="btn btn-sm delete-record btn-danger text-white mt-1" style="padding:2px 5px" data-id="1"><i class="fas fa-trash fa-sm"></i></a></td>
                                        <td style="width:50px;"><a class="btn btn-sm add-record btn-success text-white mt-1" style="padding:2px 5px" data-id="1"><i class="fas fa-plus fa-sm"></i></a></td>
                                    </tr>
                                <?php else: ?>
                                    <?php $i=0; foreach($riwayatpendidikan as $x): ?>
                                        <?php if($i == 0): ?>
                                            <tr id="">
                                                <td><span class="sn"><input type="text" name="pen_tahun_mulai[]" required placeholder="Tahun Masuk..." class="form-control" value="<?= $x->tahun_mulai; ?>"></span></td>
                                                <td><span class="sn"><input type="text" name="pen_tahun_selesai[]" required placeholder="Tahun Lulus..." class="form-control" value="<?= $x->tahun_lulus; ?>"></span></td>
                                                <td><span class="sn"><input type="text" name="pen_lembaga[]" required placeholder="Lembaga Pendidikan..." class="form-control" value="<?= $x->lembaga; ?>"></span></td>
                                                <td style="width:50px;"><a  data-id_pendidikan = "<?= $x->id_riwayat; ?>" class="btn btn-sm btn-danger text-white mt-1 dlt_pendidikan" style="padding:2px 5px"><i class="fas fa-trash fa-sm"></i></a></td>
                                                <td style="width:50px;"><a href="#" class="btn btn-sm add-record btn-success text-white mt-1" style="padding:2px 5px"><i class="fas fa-plus fa-sm"></i></a></td>
                                            </tr>
                                        <?php else: ?>
                                            <tr id="">
                                                <td><span class="sn"><input type="text" name="pen_tahun_mulai[]" required placeholder="Tahun Masuk..." class="form-control" value="<?= $x->tahun_mulai; ?>"></span></td>
                                                <td><span class="sn"><input type="text" name="pen_tahun_selesai[]" required placeholder="Tahun Lulus..." class="form-control" value="<?= $x->tahun_lulus; ?>"></span></td>
                                                <td><span class="sn"><input type="text" name="pen_lembaga[]" required placeholder="Lembaga Pendidikan..." class="form-control" value="<?= $x->lembaga; ?>"></span></td>
                                                <td style="width:50px;"><a href="#" data-id_pendidikan = "<?= $x->id_riwayat; ?>"  class="btn btn-sm btn-danger text-white mt-1 dlt_pendidikan" style="padding:2px 5px"><i class="fas fa-trash fa-sm"></i></a></td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php $i++; endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>                     
                    </div>

                </div>
 
                <div class="mb-3 row">
                    <label for="nama_alumni" class="col-sm-2 col-form-label">Riwayat Pekerjaan</label>
                    <div class="col-sm-10">
                        <table class="table table-bordered" id="tbl_riwayatpekerjaan">
                            <tbody id="tbl_riwayatpekerjaan_body">
                                <?php if(empty($riwayatpekerjaan)): ?>
                                    <tr id="pek-1">
                                        <td><span class="snn"><input type="text" name="pek_tahun_mulai[]" required placeholder="Tahun Mulai..." class="form-control"></span></td>
                                        <td><span class="snn"><input type="text" name="pek_tahun_selesai[]" required placeholder="Tahun Selesai.." class="form-control"></span></td>
                                        <td><span class="snn"><input type="text" name="pek_lembaga[]" required placeholder="Lembaga Pekerjaan..."  class="form-control"></span></td>
                                        <td><span class="snn"><input type="text" name="pek_bidangkerja[]" required placeholder="Bidang Pekerjaan..."  class="form-control"></span></td>
                                        <td style="width:50px;"><a class="btn btn-sm delete-records btn-danger text-white mt-1" style="padding:2px 5px" data-ids="1"><i class="fas fa-trash fa-sm"></i></a></td>
                                        <td style="width:50px;"><a class="btn btn-sm add-records btn-success text-white mt-1" style="padding:2px 5px" data-ids="1"><i class="fas fa-plus fa-sm"></i></a></td>
                                    </tr>
                                <?php else: ?>
                                    <?php $i=0; foreach($riwayatpekerjaan as $x): ?>
                                        <?php if($i == 0): ?>
                                            <tr id="">
                                                <td><span class="snn"><input type="text" name="pek_tahun_mulai[]" required placeholder="Tahun Mulai..." class="form-control" value="<?= $x->dari_tahun; ?>"></span></td>
                                                <td><span class="snn"><input type="text" name="pek_tahun_selesai[]" required placeholder="Tahun Selesai.." class="form-control" value="<?= $x->sampai_tahun; ?>"></span></td>
                                                <td><span class="snn"><input type="text" name="pek_lembaga[]" required placeholder="Lembaga Pekerjaan..."  class="form-control" value="<?= $x->lembaga; ?>"></span></td>
                                                <td><span class="snn"><input type="text" name="pek_bidangkerja[]" required placeholder="Bidang Pekerjaan..."  class="form-control" value="<?= $x->bidang_kerja; ?>"></span></td>
                                                <td style="width:50px;"><a href="#" data-id_pekerjaan="<?= $x->id_pekerjaan; ?>" class="btn btn-sm btn-danger text-white mt-1 dlt_pekerjaan" style="padding:2px 5px" data-ids="1"><i class="fas fa-trash fa-sm"></i></a></td>
                                                <td style="width:50px;"><a class="btn btn-sm add-records btn-success text-white mt-1" style="padding:2px 5px" data-ids="1"><i class="fas fa-plus fa-sm"></i></a></td>
                                            </tr>
                                        <?php else: ?>
                                            <tr id="">
                                                <td><span class="snn"><input type="text" name="pek_tahun_mulai[]" required placeholder="Tahun Mulai..." class="form-control" value="<?= $x->dari_tahun; ?>"></span></td>
                                                <td><span class="snn"><input type="text" name="pek_tahun_selesai[]" required placeholder="Tahun Selesai.." class="form-control" value="<?= $x->sampai_tahun; ?>"></span></td>
                                                <td><span class="snn"><input type="text" name="pek_lembaga[]" required placeholder="Lembaga Pekerjaan..."  class="form-control" value="<?= $x->lembaga; ?>"></span></td>
                                                <td><span class="snn"><input type="text" name="pek_bidangkerja[]" required placeholder="Bidang Pekerjaan..."  class="form-control" value="<?= $x->bidang_kerja; ?>"></span></td>
                                                <td style="width:50px;"><a href="#" data-id_pekerjaan="<?= $x->id_pekerjaan; ?>" class="btn btn-sm btn-danger text-white mt-1 dlt_pekerjaan" style="padding:2px 5px" data-ids="1"><i class="fas fa-trash fa-sm"></i></a></td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php $i++; endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>                     
                    </div>

                </div>

                <div class="mb-3 row">
                    <label for="nama_alumni" class="col-sm-2 col-form-label">Social Media</label>
                    <div class="col-sm-10">
                        <table class="table table-bordered">
                            <tr>
                                <td><span><input type="text" name="facebook" placeholder="Facebook..." class="form-control" value="<?= $profil->facebook; ?>"></span></td>
                                <td><span><input type="text" name="instagram" placeholder="Instagram..." class="form-control" value="<?= $profil->instagram; ?>"></span></td>
                                <td><span><input type="text" name="twitter" placeholder="Twitter...."  class="form-control" value="<?= $profil->twitter; ?>"></span></td>
                            </tr>
                    </table>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="nama_alumni" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $profil->email; ?>">
                    </div>
                </div>

                <div class="row">
                    <label for="nama_alumni" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-eye fa-1x toggle-password"></i></span>
                        </div>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                    </div>
                    <small style="font-size: 12px;"><i>Kosongkan jika tidak perlu diubah</i></small>
                </div>

            </div>

        </div>
        <div class="card-footer">
            <div class="float-right">
                <a href="#" id="hapus_alumni" type="button" data-toggle="modal" data-nisn="<?php echo $profil->nisn; ?>" class="btn btn-danger">Hapus</a>
                <button type="submit" class="btn btn-primary">
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner"></span> Update
            </button>
            </div>
        </div>
        </form>
        
            <div style="display:none;">
        <table id="sample_table_riwayatpekerjaan">
            <tr id="">
                <td><span class="snn"><input type="text" name="pek_tahun_mulai[]" required placeholder="Tahun Mulai..." class="form-control"></span></td>
                <td><span class="snn"><input type="text" name="pek_tahun_selesai[]" required placeholder="Tahun Selesai.."  class="form-control"></span></td>
                <td><span class="snn"><input type="text" name="pek_lembaga[]" required placeholder="Lembaga Pekerjaan..." class="form-control"></span></td>
                <td><span class="snn"><input type="text" name="pek_bidangkerja[]" required placeholder="Bidang Pekerjaan..." class="form-control"></span></td>
                <td style="width:50px;"><a class="btn btn-sm delete-records btn-danger text-white mt-1" style="padding:2px 5px" data-ids="1"><i class="fas fa-trash fa-sm"></i></a></td>
            </tr>
    </table>
    </div>

    <div style="display:none;">
        <table id="sample_table_riwayatpendidikan">
            <tr id="">
                <td><span class="sn"><input type="text" name="pen_tahun_mulai[]" required placeholder="Tahun Masuk..."  class="form-control"></span></td>
                <td><span class="sn"><input type="text" name="pen_tahun_selesai[]" required placeholder="Tahun Lulus..."  class="form-control"></span></td>
                <td><span class="sn"><input type="text" name="pen_lembaga[]" required placeholder="Lembaga Pendidikan..."  class="form-control"></span></td>
                <td style="width:50px;"><a class="btn btn-sm delete-record btn-danger text-white mt-1" style="padding:2px 5px" data-id="1"><i class="fas fa-trash fa-sm"></i></a></td>
            </tr>
    </table>
    </div>
        </div>
    </div>
    </div>
</section>
<?php endforeach; ?>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
    jQuery(document).delegate('a.add-record', 'click', function(e) {
        e.preventDefault();    
        var content = jQuery('#sample_table_riwayatpendidikan tr'),
        size = jQuery('#tbl_riwayatpendidikan >tbody >tr').length + 1,
        element = null,    
        element = content.clone();
        element.attr('id', 'rec-'+size);
        element.find('.delete-record').attr('data-id', size);
        element.appendTo('#tbl_riwayatpendidikan_body');
        element.find('.sn');
    });

    jQuery(document).delegate('a.delete-record', 'click', function(e) {
        e.preventDefault();    
        var didConfirm = confirm("Yakin Mau Menghapus ?");
        if (didConfirm == true) {
            var id = jQuery(this).attr('data-id');
            var targetDiv = jQuery(this).attr('targetDiv');
            jQuery('#rec-' + id).remove();
            
            //regnerate index number on table
            $('#tbl_riwayatpendidikan_body tr').each(function(index) {
            //alert(index);
            $(this).find('span.sn');
            });
            return true;
        } else {
            return false;
        }
    });



    jQuery(document).delegate('a.add-records', 'click', function(e) {
        e.preventDefault();    
        var content = jQuery('#sample_table_riwayatpekerjaan tr'),
        size = jQuery('#tbl_riwayatpekerjaan >tbody >tr').length + 1,
        element = null,    
        element = content.clone();
        element.attr('id', 'pek-'+size);
        element.find('.delete-records').attr('data-ids', size);
        element.appendTo('#tbl_riwayatpekerjaan_body');
        element.find('.snn');
    });

    jQuery(document).delegate('a.delete-records', 'click', function(e) {
        e.preventDefault();    
        var didConfirm = confirm("Yakin Mau Menghapus ?");
        if (didConfirm == true) {
            var id = jQuery(this).attr('data-ids');
            var targetDiv = jQuery(this).attr('targetDiv');
            jQuery('#pek-' + id).remove();
            
            //regnerate index number on table
            $('#tbl_riwayatpekerjaan_body tr').each(function(index) {
            //alert(index);
            $(this).find('span.snn');
            });
            return true;
        } else {
            return false;
        }
    });

    //delete alert riwayat Pendidikan
    $('.dlt_pendidikan').click(function(e){
        e.preventDefault();
        var confirmed = confirm("Yakin Mau Menghapus ?");

        if(confirmed){

            $.ajax({
                url : '<?= base_url('admin/ModulAlumni/hapusRiwayatPendidikanByid'); ?>',
                data: {'id':$(this).data('id_pendidikan')},
                type: 'POST',
                success: function(data){
                    location.reload();
                }
            });

        }        

    });

    $('.dlt_pekerjaan').click(function(e){
        e.preventDefault();

        var confirmed = confirm("Yakin Mau Menghapus ?");

        if(confirmed){

            $.ajax({
                url : '<?= base_url('admin/ModulAlumni/hapusRiwayatPekerjaanByid'); ?>',
                data: {'id':$(this).data('id_pekerjaan')},
                type: 'POST',
                success: function(data){
                    location.reload();
                }
            });

        }     
    });

</script>


