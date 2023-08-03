<section class="breadcrumbs">
<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <ol>
            <li><a href="<?php echo base_url('main'); ?>">Home</a></li>
            <li>Register Alumni</li>
        </ol>
        <?php $this->load->view('user/partisi/cariberita.php') ?>
    </div>
</div>
</section>
<section class="inner-page">
<div class="container">

    <div class="row">                
        <div class="col-sm-8" >                
            <section id="team" class="team section-bg" style="background-color: white;" >

                <div class="card" style="border: none;">
                <div class="card-body">
                    <div class="container">
                    <h3 style="margin-top: -70px; margin-bottom: 40px;">Register</h3><hr><br>

                    <form id="register_form" method="post" enctype="multipart/form-data">

                        <div class="mb-3 row">
                            <label for="nama_alumni" class="col-sm-2 col-form-label">NIA</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nisn" id="nisn" placeholder="NIA" required>
                                <small style="font-size: 12px;"><i>Digunakan Untuk Login</i></small>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="nama_alumni" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama_alumni" name="nama_alumni" placeholder="Nama Lengkap" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="nama_alumni" class="col-sm-2 col-form-label">Tahun Lulus</label>
                            <div class="col-sm-10">
                                <select class="form-select" aria-label="Default select example" required name="tahun_lulus" id="tahun_lulus">
                                    <option value="">Pilih Tahun Kelulusan</option>
                                    <?php foreach ($tahunlulus as $list_tahunlulus): ?>
                                    <option value="<?php echo $list_tahunlulus->tahun_lulus; ?>"><?php echo $list_tahunlulus->tahun_lulus; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="nama_alumni" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status_alumni" id="flexRadioDefault1" checked value="bekerja">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Bekerja
                                    </label>
                                    </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status_alumni" id="flexRadioDefault2" value="pelajar">
                                    <label class="form-check-label" for="flexRadioDefault2">
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
                            <label for="nama_alumni" class="col-sm-2 col-form-label">No Hp / Wa</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="no_wa" name="no_wa" placeholder="No Hp / No WA" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                                <select class="form-select" aria-label="Default select example" required name="provinsi" id="combobox_provinsi">
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
                                <select class="form-select" aria-label="Default select example" required name="kabupaten" id="combobox_kabupaten" required>
                                    <option value="">Pilih Kabupaten</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <select class="form-select" aria-label="Default select example" required name="kecamatan" id="combobox_kecamatan" required>
                                    <option value="">Pilih Kecamatan</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="nama_alumni" class="col-sm-2 col-form-label">Detail Alamat</label>
                            <div class="col-sm-10">
                                <textarea id="textarea_diskusi" class="form-control" name="detail_alamat" rows="10" placeholder="Alamat Lengkap, Meliputi RT/RW" required></textarea>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="nama_alumni" class="col-sm-2 col-form-label">Lokasi</label>
                            <div class="col-sm-10">
                                <div id="map"></div>
                                <small style="font-size: 12px;"><i>Drag Marker Kelokasi Anda</i></small>
                            </div>
                            <input type="hidden" name="latitude" id="latitude" readonly><br>
                            <input type="hidden" name="longitude" id="longitude" readonly><br>
                        </div>

                        <div class="mb-3 row">
                            <label for="nama_alumni" class="col-sm-2 col-form-label">Foto</label>
                            <div class="col-sm-10">
                                <div class="drop-zone">
                                    <span class="drop-zone__prompt">Drag File atau Klik kolom ini</span>
                                    <input type="file" name="myFile" class="drop-zone__input">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="nama_alumni" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                            </div>
                        </div>

                        <div class="row">
                            <label for="nama_alumni" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-eye fa-1x toggle-password"></i></span>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                                </div>
                                <small style="font-size: 12px;"><i>Digunakan Untuk Login</i></small>
                            </div>
                        </div>

                        <button class="btn btn-primary" type="submit" style="float: right;">
                           <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner"></span> Daftar
                        </button>
                    </form>

                    </div>
                </div>
                </div>
            </section>
        </div>
        <?php $this->load->view('user/register/syarat_ketentuan.php'); ?>
        </div>
    </div>    
</div>
</section>