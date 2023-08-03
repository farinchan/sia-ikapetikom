<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Tambah Alumni</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Tambah Alumni</li>
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/ModulAlumni/data') ?>">Data</a></li>
            </ol>
            </div>
        </div>
        </div>
    </div>

    <section class="content">
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Default box -->
                <div class="card">
                <div class="card-header">
                    <h6>Tambah Alumni</h6>
                </div>
                <div class="card-body">

                <form id="register_form" method="post">
                    <div class="mb-3 row">
                        <label for="nama_alumni" class="col-sm-2 col-form-label">NIA</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nisn" id="nisn" placeholder="NIA" required>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama_alumni" class="col-sm-2 col-form-label">Tahun Lulus</label>
                        <div class="col-sm-10">
                            <select class="form-control" aria-label="Default select example" required name="tahun_lulus" id="tahun_lulus">
                                <option value="">Pilih Tahun Kelulusan</option>
                                <?php foreach ($tahunlulus as $list_tahunlulus): ?>
                                    <option value="<?php echo $list_tahunlulus->tahun_lulus; ?>"><?php echo $list_tahunlulus->tahun_lulus; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama_alumni" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama_alumni" name="nama_alumni" placeholder="Nama Lengkap" required>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama_alumni" class="col-sm-2 col-form-label">Status Pekerjaan</label>
                        <div class="col-sm-10">
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="status_alumni" id="flexRadioDefault1" required value="bekerja">
                                <label class="custom-control-label" for="flexRadioDefault1" style="font-weight: normal;">
                                    Bekerja
                                </label>
                                </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="status_alumni" id="flexRadioDefault2" required value="pelajar">
                                <label class="custom-control-label" for="flexRadioDefault2" style="font-weight: normal;">
                                    Pelajar
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="detail_status" id="detail_status" placeholder="Instansi Tempat Bekerja" required>
                            <small style="font-size: 12px;"><i>Jika Pelajar masukkan instansi pendidikan</i></small>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama_alumni" class="col-sm-2 col-form-label">Status Akun</label>
                        <div class="col-sm-10">
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="status_akun" id="flexRadioDefault11" value="Y" required>
                                <label class="custom-control-label" for="flexRadioDefault11" style="font-weight: normal;">
                                    Aktif
                                </label>
                                </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="status_akun" id="flexRadioDefault22" value="N" required>
                                <label class="custom-control-label" for="flexRadioDefault22" style="font-weight: normal;">
                                    Tidak Aktif
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama_alumni" class="col-sm-2 col-form-label">No Hp / Wa</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="no_wa" name="no_wa" placeholder="No Hp / No WA" required>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <select class="form-control" aria-label="Default select example" required name="provinsi" id="combobox_provinsi">
                                <option value="">Pilih Provinsi</option>
                                <?php foreach ($provinsi as $list_provinsi): ?>
                                <option value="<?php echo $list_provinsi->kode; ?>"><?php echo $list_provinsi->nama; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <select class="form-control" aria-label="Default select example" required name="kabupaten" id="combobox_kabupaten" required>
                                <option value="">Pilih Kabupaten</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <select class="form-control" aria-label="Default select example" required name="kecamatan" id="combobox_kecamatan" required>
                                <option value="">Pilih Kecamatan</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama_alumni" class="col-sm-2 col-form-label">Detail Alamat</label>
                        <div class="col-sm-10">
                            <textarea id="textarea_diskusi" class="form-control" name="detail_alamat" rows="5" placeholder="Alamat Lengkap, Meliputi RT/RW" required></textarea>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama_alumni" class="col-sm-2 col-form-label">Foto Profil</label>
                        <div class="col-sm-10">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" name="myFile" required>
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>
                    </div>

                   <div class="mb-3 row">
                        <label for="nama_alumni" class="col-sm-2 col-form-label">Riwayat Pendidikan</label>
                        <div class="col-sm-10">
                            <table class="table table-bordered" id="tbl_riwayatpendidikan">
                                <tbody id="tbl_riwayatpendidikan_body">
                                    <tr id="rec-1">
                                        <td><span class="sn"><input type="text" name="pen_tahun_mulai[]" required placeholder="Tahun Masuk..." class="form-control"></span></td>
                                        <td><span class="sn"><input type="text" name="pen_tahun_selesai[]" required placeholder="Tahun Lulus..." class="form-control"></span></td>
                                        <td><span class="sn"><input type="text" name="pen_lembaga[]" required placeholder="Lembaga Pendidikan..." class="form-control"></span></td>
                                        <td style="width:50px;"><a class="btn btn-sm delete-record btn-danger text-white mt-1" style="padding:2px 5px" data-id="1"><i class="fas fa-trash fa-sm"></i></a></td>
                                        <td style="width:50px;"><a class="btn btn-sm add-record btn-success text-white mt-1" style="padding:2px 5px" data-id="1"><i class="fas fa-plus fa-sm"></i></a></td>
                                    </tr>
                                </tbody>
                            </table>                     
                        </div>

                    </div>

                    <div class="mb-3 row">
                        <label for="nama_alumni" class="col-sm-2 col-form-label">Riwayat Pekerjaan</label>
                        <div class="col-sm-10">
                            <table class="table table-bordered" id="tbl_riwayatpekerjaan">
                                <tbody id="tbl_riwayatpekerjaan_body">
                                    <tr id="pek-1">
                                        <td><span class="snn"><input type="text" name="pek_tahun_mulai[]" required placeholder="Tahun Mulai..." class="form-control"></span></td>
                                        <td><span class="snn"><input type="text" name="pek_tahun_selesai[]" required placeholder="Tahun Selesai.." class="form-control"></span></td>
                                        <td><span class="snn"><input type="text" name="pek_lembaga[]" required placeholder="Lembaga Pekerjaan..."  class="form-control"></span></td>
                                        <td><span class="snn"><input type="text" name="pek_bidangkerja[]" required placeholder="Bidang Pekerjaan..."  class="form-control"></span></td>
                                        <td style="width:50px;"><a class="btn btn-sm delete-records btn-danger text-white mt-1" style="padding:2px 5px" data-ids="1"><i class="fas fa-trash fa-sm"></i></a></td>
                                        <td style="width:50px;"><a class="btn btn-sm add-records btn-success text-white mt-1" style="padding:2px 5px" data-ids="1"><i class="fas fa-plus fa-sm"></i></a></td>
                                    </tr>
                                </tbody>
                            </table>                     
                        </div>

                    </div>

                    <div class="mb-3 row">
                        <label for="nama_alumni" class="col-sm-2 col-form-label">Social Media</label>
                        <div class="col-sm-10">
                            <table class="table table-bordered">
                                <tr>
                                    <td><span><input type="text" name="facebook" placeholder="Facebook..." class="form-control"></span></td>
                                    <td><span><input type="text" name="instagram" placeholder="Instagram..." class="form-control"></span></td>
                                    <td><span><input type="text" name="twitter" placeholder="Twitter...."  class="form-control"></span></td>
                                </tr>
                        </table>
                        </div>
                    </div>


                    <div class="mb-3 row">
                        <label for="nama_alumni" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" name="email" required placeholder="Email">
                        </div>
                    </div>

                    <div class="row">
                        <label for="nama_alumni" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-eye fa-1x toggle-password"></i></span>
                            </div>
                            <input type="password" class="form-control" name="password" id="password" required placeholder="Password">
                        </div>
                    </div>

                </div>

            </div>
            <div class="card-footer">
                <div class="float-right">
                    <button type="submit" class="btn btn-primary">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner"></span> Simpan
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
            </div>
      </div>
    </div>
    </section>
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

</script>