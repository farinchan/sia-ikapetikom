<section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <ol>
                <li><a href="<?php echo base_url('main'); ?>">Home</a></li>
                <li>Pekerjaan</li>
            </ol>
            <?php $this->load->view('user/partisi/cariberita.php') ?>
        </div>
    </div>
</section>
<section class="inner-page">
    <div class="container">
        <h2 style="margin-top: -30px;">Selamat Datang <?php echo $_SESSION['nama_session']; ?> </h2>
        <div class="row">
            <div class="col-sm-4">
                <section id="team" class="team section-bg" style="background-color: white;">
                    <div data-aos="fade-up" style="margin-top: -20px;">
                        <?php $this->load->view('user/alumni_dashboard/foto_profil.php'); ?>
                        <div class="card mt-4">
                            <div class="card-header" style="background-color: white;">
                                Menu Alumni
                            </div>
                            <div class="card-body">
                                <div class="list-group list-group-flush">
                                    <a href="<?php echo base_url('main/profil'); ?>" class="list-group-item list-group-item-action" aria-current="true">
                                        Data Pribadi
                                    </a>
                                    <a href="<?php echo base_url('main/pekerjaan'); ?>" class="list-group-item list-group-item-action">Data Tracer<span style="float: right;" class="badge bg-primary rounded-pill"></span></a>

                                    <a href="<?php echo base_url('main/berita'); ?>" class="list-group-item list-group-item-action">Kontribusi Berita <span style="float: right;" class="badge bg-primary rounded-pill"><?php echo $total_berita ?></span></a>
                                    <a href="<?php echo base_url('main/pesan'); ?>" class="list-group-item list-group-item-action">Pesan Pribadi <?php if ($pesan_belum_terbaca == 0) {
                                                                                                                                                    } else { ?><span style="float: right;" class="badge bg-primary rounded-pill"><?php echo "New"; ?></span> <?php } ?></a>
                                    <a href="<?php echo base_url('main/alumnidonasi') ?>" class="list-group-item list-group-item-action">Kontribusi Donasi <span style="float: right;" class="badge bg-primary rounded-pill"><?php echo $total_donasi ?></span></a>
                                    <a href="<?php echo base_url('main/alumnilisttopik') ?>" class="list-group-item list-group-item-action">Topik Dibuat <span style="float: right;" class="badge bg-primary rounded-pill"><?php echo $totaltopik; ?></span></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </section>
            </div>

            <div class="col-sm-8">
                <section id="team" class="team section-bg" style="background-color: white;">
                    <div data-aos="fade-up" style="margin-top: -20px;">
                        <div class="card">
                            <div class="card-header" style="background-color: white;">
                                Data Tracer Saya
                                <a href="#" style="float: right;" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-edit"></i></a>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <?php if ($pekerjaan_tersedia) : ?>
                                        <tbody>
                                            <tr>
                                                <th scope="row">NIA</th>
                                                <td><?php echo $data_profil[0]->nisn ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Nama Tempat / Lembaga Bekerja</th>
                                                <td><?php echo $pekerjaan['tempat_kerja']; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Lama Waktu Untuk Mendapatkan Pekerjaan Pertama</th>
                                                <td><?php echo $pekerjaan['lama_menganggur']; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Sumber Informasi Pekerjaan Pertama</th>
                                                <td><?php echo $pekerjaan['sumber_informasi_pekerjaan']; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Mulai Mencari Pekerjaan Sejak</th>
                                                <td><?php echo $pekerjaan['kapan_mulai_mencari']; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Bagaimana Cara Pertama Kali Mendapatkan Pekerjaan pertama</th>
                                                <td><?php echo $pekerjaan['cara_dapat']; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Berapa Gaji Perbulan Pekerjaan Pertama</th>
                                                <td><?php echo $pekerjaan['gaji_pekerjaan_pertama']; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Berapa lama menekuni pekerjaan saat ini</th>
                                                <td><?php echo $pekerjaan['lama_bekerja_saat_ini']; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Sektor Bidang Pekerjaan</th>
                                                <td><?php echo $pekerjaan['bidang_pekerjaan']; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Bidang Pekerjaan (Deksripsi)</th>
                                                <td><?php echo $pekerjaan['deskripsi_bidang_pekerjaan']; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Apakah bidang pekerjaan saat ini sesuai dengan bidang studi yang
                                                    Saudara ambil?</th>
                                                <td><?php echo $pekerjaan['sesuai']; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Berapa gaji Saudara per bulan untuk pekerjaan Saudara saat ini?</th>
                                                <td>
                                                    <table class="table table-bordered">
                                                        <!-- <thead>
                                                                <tr>
                                                                </tr>
                                                            </thead> -->
                                                        <tbody>
                                                            <tr>
                                                                <th>Pertama</th>
                                                                <td><?php echo $pekerjaan['gaji_pertama_bekerja']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Sekarang</th>
                                                                <td><?php echo $pekerjaan['gaji_sekarang_bekerja']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Diharapkan</th>
                                                                <td><?php echo $pekerjaan['gaji_harapan']; ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Permasalahan Pekerjaan Yang Terjadi</th>
                                                <td><?php echo $pekerjaan['permasalahan_pekerjaan']; ?></td>
                                            </tr>
                                        </tbody>
                                    <?php else : ?>
                                        <tbody>
                                            <tr>
                                                <th scope="row">NIA</th>
                                                <td><?php echo $data_profil[0]->nisn ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Nama Tempat / Lembaga Bekerja</th>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Lama Waktu Untuk Mendapatkan Pekerjaan Pertama</th>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Sumber Informasi Pekerjaan Pertama</th>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Mulai Mencari Pekerjaan Sejak</th>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Bagaimana Cara Pertama Kali Mendapatkan Pekerjaan pertama</th>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Berapa Gaji Perbulan Pekerjaan Pertama</th>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Berapa lama menekuni pekerjaan saat ini</th>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Sektor Bidang Pekerjaan</th>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Bidang Pekerjaan (Deksripsi)</th>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Apakah bidang pekerjaan saat ini sesuai dengan bidang studi yang
                                                    Saudara ambil?</th>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Berapa gaji Saudara per bulan untuk pekerjaan Saudara saat ini?</th>
                                                <td>
                                                    <table class="table table-bordered">
                                                        <!-- <thead>
                                                                <tr>
                                                                </tr>
                                                            </thead> -->
                                                        <tbody>
                                                            <tr>
                                                                <th>Pertama</th>
                                                                <td>-</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Sekarang</th>
                                                                <td>-</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Diharapkan</th>
                                                                <td>-</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Permasalahan Pekerjaan Yang Terjadi</th>
                                                <td>-</td>
                                            </tr>
                                        </tbody>
                                    <?php endif; ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>
<!-- Button trigger modal
<button type="button" class="btn btn-primary">
  Launch demo modal
</button> -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl ">
        <div class="modal-content">
            <form action="<?php echo base_url('main/ubahpekerjaan_action') ?>" method="post">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Halo Apa Kabar</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="nisn" value="<?php echo $_SESSION['nisn_session']; ?>">
                    <?php if ($pekerjaan_tersedia) : ?>
                        <div id="form-group-container">
                            <div class="form-group mb-4 mt-1">
                                <label for="tempat_kerja">Sebutkan nama lembaga tempat Saudara bekerja?</label>
                                <input type="text" required class="form-control" value="<?= $pekerjaan['tempat_kerja'] == '-' ? null : $pekerjaan['tempat_kerja']; ?>" name="tempat_kerja" id="tempat_kerja" aria-describedby="helpId" placeholder="Masukkan Tempat Kerja">
                            </div>
                            <div class="form-group mb-4">
                                <label for="lama_menganggur">Setelah lulus, berapa lama Saudara menunggu untuk mendapatkan
                                    pekerjaan pertama?</label>
                                <select class="form-control" required name="lama_menganggur" id="lama_menganggur">
                                    <option value="" disabled selected>==Click for option==</option>
                                    <option value="Sudah bekerja sebelum lulus" <?= ($pekerjaan['lama_menganggur'] == 'Sudah bekerja sebelum lulus') ? 'selected' : ''; ?>>Sudah bekerja sebelum lulus</option>
                                    <option value="Kurang dari 3 bulan" <?= ($pekerjaan['lama_menganggur'] == 'Kurang dari 3 bulan') ? 'selected' : ''; ?>>Kurang dari 3 bulan</option>
                                    <option value="3 - 6 bulan" <?= ($pekerjaan['lama_menganggur'] == '3 - 6 bulan') ? 'selected' : ''; ?>>3 - 6 bulan</option>
                                    <option value="6 - 12 bulan" <?= ($pekerjaan['lama_menganggur'] == '6 - 12 bulan') ? 'selected' : ''; ?>>6 - 12 bulan</option>
                                    <option value="1 - 2 tahun" <?= ($pekerjaan['lama_menganggur'] == '1 - 2 tahun') ? 'selected' : ''; ?>>1 - 2 tahun</option>
                                    <option value="Lebih dari 2 tahun" <?= ($pekerjaan['lama_menganggur'] == 'Lebih dari 2 tahun') ? 'selected' : ''; ?>>Lebih dari 2 tahun</option>
                                </select>
                            </div>
                            <div class="form-group mb-4">
                                <label for="sumber_informasi_pekerjaan">Dari mana Saudara mendapatkan informasi tentang pekerjaan pertama yang
                                    saudara peroleh ?</label>
                                <select class="form-control" required name="sumber_informasi_pekerjaan" id="sumber_informasi_pekerjaan">
                                    <option value="" disabled selected>==Click for option==</option>
                                    <option value="Iklan" <?= ($pekerjaan['sumber_informasi_pekerjaan'] == 'Iklan') ? 'selected' : ''; ?>>Iklan</option>
                                    <option value="Teman" <?= ($pekerjaan['sumber_informasi_pekerjaan'] == 'Teman') ? 'selected' : ''; ?>>Teman</option>
                                    <option value="Keluarga" <?= ($pekerjaan['sumber_informasi_pekerjaan'] == 'Keluarga') ? 'selected' : ''; ?>>Keluarga</option>
                                    <option value="Pengguna kerja (Employer)" <?= ($pekerjaan['sumber_informasi_pekerjaan'] == 'Pengguna kerja (Employer)') ? 'selected' : ''; ?>>Pengguna kerja (Employer)</option>
                                    <option value="Mencari sendiri: browsing di internet dan sebagainya" <?= ($pekerjaan['sumber_informasi_pekerjaan'] == 'Mencari sendiri: browsing di internet dan sebagainya') ? 'selected' : ''; ?>>Mencari sendiri: browsing di internet dan sebagainya</option>
                                </select>
                            </div>
                            <div class="form-group mb-4">
                                <label for="kapan_mulai_mencari">Kapan Saudara mulai mencari pekerjaan ?</label>
                                <select class="form-control" required name="kapan_mulai_mencari" id="kapan_mulai_mencari">
                                    <option value="" disabled selected>==Click for option==</option>
                                    <option value="Lebih dari satu bulan sebelum wisuda" <?= ($pekerjaan['kapan_mulai_mencari'] == 'Lebih dari satu bulan sebelum wisuda') ? 'selected' : ''; ?>>Lebih dari satu bulan sebelum wisuda</option>
                                    <option value="Segera setelah wisuda" <?= ($pekerjaan['kapan_mulai_mencari'] == 'Segera setelah wisuda') ? 'selected' : ''; ?>>Segera setelah wisuda</option>
                                    <option value="Satu bulan setelah wisuda" <?= ($pekerjaan['kapan_mulai_mencari'] == 'Satu bulan setelah wisuda') ? 'selected' : ''; ?>>Satu bulan setelah wisuda</option>
                                    <option value="Lebih dari satu bulan setelah wisuda" <?= ($pekerjaan['kapan_mulai_mencari'] == 'Lebih dari satu bulan setelah wisuda') ? 'selected' : ''; ?>>Lebih dari satu bulan setelah wisuda</option>
                                    <option value="Belum memperoleh informasi lowongan pekerjaan yang relatif relevan" <?= ($pekerjaan['kapan_mulai_mencari'] == 'Belum memperoleh informasi lowongan pekerjaan yang relatif relevan') ? 'selected' : ''; ?>>Belum memperoleh informasi lowongan pekerjaan yang relatif relevan</option>
                                </select>
                            </div>
                            <div class="form-group mb-4">
                                <label for="cara_dapat">Bagaimana cara Saudara mendapatkan pekerjaan pertama ?</label>
                                <select class="form-control" required name="cara_dapat" id="cara_dapat">
                                    <option value="" disabled selected>==Click for option==</option>
                                    <option value="Berkompetisi (dengan tes)" <?= ($pekerjaan['cara_dapat'] == 'Berkompetisi (dengan tes)') ? 'selected' : ''; ?>>Berkompetisi (dengan tes)</option>
                                    <option value="Rekomendasi (tanpa tes)" <?= ($pekerjaan['cara_dapat'] == 'Rekomendasi (tanpa tes)') ? 'selected' : ''; ?>>Rekomendasi (tanpa tes)</option>
                                    <option value="Ditempatkan (karena ada ikatan dinas dsb.)" <?= ($pekerjaan['cara_dapat'] == 'Ditempatkan (karena ada ikatan dinas dsb.)') ? 'selected' : ''; ?>>Ditempatkan (karena ada ikatan dinas dsb.)</option>
                                    <option value="Diminta oleh pengguna" <?= ($pekerjaan['cara_dapat'] == 'Diminta oleh pengguna') ? 'selected' : ''; ?>>Diminta oleh pengguna</option>
                                    <option value="Memanfaatkan koneksi" <?= ($pekerjaan['cara_dapat'] == 'Memanfaatkan koneksi') ? 'selected' : ''; ?>>Memanfaatkan koneksi</option>
                                    <option value="Melalui agen tenaga kerja" <?= ($pekerjaan['cara_dapat'] == 'Melalui agen tenaga kerja') ? 'selected' : ''; ?>>Melalui agen tenaga kerja</option>
                                    <option value="Melalui Unit Pengembangan Karir dan Penempatan Kerja" <?= ($pekerjaan['cara_dapat'] == 'Melalui Unit Pengembangan Karir dan Penempatan Kerja') ? 'selected' : ''; ?>>Melalui Unit Pengembangan Karir dan Penempatan Kerja</option>
                                    <option value="Meng-iklankan diri sendiri melalui internet" <?= ($pekerjaan['cara_dapat'] == 'Meng-iklankan diri sendiri melalui internet') ? 'selected' : ''; ?>>Meng-iklankan diri sendiri melalui internet</option>
                                    <option value="Berwirausaha" <?= ($pekerjaan['cara_dapat'] == 'Berwirausaha') ? 'selected' : ''; ?>>Berwirausaha</option>
                                </select>
                            </div>
                            <div class="form-group mb-4">
                                <label for="gaji_pekerjaan_pertama">Berapa gaji Saudara per bulan untuk pekerjaan pertama ?</label>
                                <select class="form-control" required name="gaji_pekerjaan_pertama" id="gaji_pekerjaan_pertama">
                                    <option value="" disabled selected>==Click for option==</option>
                                    <option value="Kurang dari 1.000.000,00" <?= ($pekerjaan['gaji_pekerjaan_pertama'] == 'Kurang dari 1.000.000,00') ? 'selected' : ''; ?>>Kurang dari 1.000.000,00</option>
                                    <option value="1.000.000 - < 2.000.000" <?= ($pekerjaan['gaji_pekerjaan_pertama'] == '1.000.000 - < 2.000.000') ? 'selected' : ''; ?>>1.000.000 - < 2.000.000</option>
                                    <option value="2.000.000 - < 3.000.000" <?= ($pekerjaan['gaji_pekerjaan_pertama'] == '2.000.000 - < 3.000.000') ? 'selected' : ''; ?>>2.000.000 - < 3.000.000</option>
                                    <option value="3.000.000 - < 4.000.000" <?= ($pekerjaan['gaji_pekerjaan_pertama'] == '3.000.000 - < 4.000.000') ? 'selected' : ''; ?>>3.000.000 - < 4.000.000</option>
                                    <option value="4.000.000 - < 5.000.000" <?= ($pekerjaan['gaji_pekerjaan_pertama'] == '4.000.000 - < 5.000.000') ? 'selected' : ''; ?>>4.000.000 - < 5.000.000</option>
                                    <option value="> 5.000.000" <?= ($pekerjaan['gaji_pekerjaan_pertama'] == '> 5.000.000') ? 'selected' : ''; ?>> 5.000.000</option>
                                </select>
                            </div>
                            <div class="form-group mb-4">
                                <label for="lama_bekerja_saat_ini">Berapa lama Saudara menekuni pekerjaan Saudara saat ini ?</label>
                                <select class="form-control" required name="lama_bekerja_saat_ini" id="lama_bekerja_saat_ini">
                                    <option value="" disabled selected>==Click for option==</option>
                                    <option value="Kurang dari 6 bulan" <?= ($pekerjaan['lama_bekerja_saat_ini'] == 'Kurang dari 6 bulan') ? 'selected' : ''; ?>>Kurang dari 6 bulan</option>
                                    <option value="6 - 12 bulan" <?= ($pekerjaan['lama_bekerja_saat_ini'] == '6 - 12 bulan') ? 'selected' : ''; ?>>6 - 12 bulan</option>
                                    <option value="1 - 2 tahun" <?= ($pekerjaan['lama_bekerja_saat_ini'] == '1 - 2 tahun') ? 'selected' : ''; ?>>1 - 2 tahun</option>
                                    <option value="2 - 3 tahun" <?= ($pekerjaan['lama_bekerja_saat_ini'] == '2 - 3 tahun') ? 'selected' : ''; ?>>2 - 3 tahun</option>
                                    <option value="Lebih dari 3 tahun" <?= ($pekerjaan['lama_bekerja_saat_ini'] == 'Lebih dari 3 tahun') ? 'selected' : ''; ?>>Lebih dari 3 tahun</option>
                                </select>
                            </div>
                            <div class="form-group mb-4">
                                <label for="bidang_pekerjaan">Bidang pekerjaan Saudara termasuk
                                    Sektor :
                                </label>
                                <select class="form-control" required name="bidang_pekerjaan" id="bidang_pekerjaan">
                                    <option value="" disabled selected>==Click for option==</option>
                                    <option value="Pendidikan" <?= ($pekerjaan['bidang_pekerjaan'] == 'Pendidikan') ? 'selected' : ''; ?>>Pendidikan</option>
                                    <option value="Pemerintah daerah" <?= ($pekerjaan['bidang_pekerjaan'] == 'Pemerintah daerah') ? 'selected' : ''; ?>>Pemerintah daerah</option>
                                    <option value="Swasta" <?= ($pekerjaan['bidang_pekerjaan'] == 'Swasta') ? 'selected' : ''; ?>>Swasta</option>
                                    <option value="Wirausaha" <?= ($pekerjaan['bidang_pekerjaan'] == 'Wirausaha') ? 'selected' : ''; ?>>Wirausaha</option>
                                </select>
                            </div>
                            <div class="form-group mb-4">
                                <label for="deskripsi_bidang_pekerjaan">Bidang pekerjaan: (tuliskan)</label>
                                <textarea class="form-control" name="deskripsi_bidang_pekerjaan" id="deskripsi_bidang_pekerjaan" rows="3" placeholder="Masukkan Deskripsi Bidang Pekerjaan"> <?= $pekerjaan['deskripsi_bidang_pekerjaan'] == '-' ? null : $pekerjaan['deskripsi_bidang_pekerjaan']; ?> </textarea>
                            </div>
                            <div class="form-group mb-4">
                                <label for="sesuai">Apakah bidang pekerjaan Saudara saat ini sesuai dengan bidang studi yang Saudara ambil?
                                </label>
                                <select class="form-control" required name="sesuai" id="sesuai">
                                    <option value="" disabled selected>==Click for option==</option>
                                    <option value="ya" <?= ($pekerjaan['sesuai'] == 'ya') ? 'selected' : ''; ?>>Sesuai</option>
                                    <option value="tidak" <?= ($pekerjaan['sesuai'] == 'tidak') ? 'selected' : ''; ?>>Tidak</option>
                                </select>
                            </div>
                            <div class="form-group mb-4">
                                <label for="gaji_pertama_bekerja">Berapa gaji Saudara per bulan untuk pekerjaan Saudara saat ini ?
                                </label>
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4"><label for="gaji_pertama_bekerja">
                                            Pertama :
                                        </label>
                                        <select class="form-control" required name="gaji_pertama_bekerja" id="gaji_pertama_bekerja">
                                            <option value="" disabled selected>==Click for option==</option>
                                            <option value="Kurang dari 1.000.000,00" <?= ($pekerjaan['gaji_pertama_bekerja'] == 'Kurang dari 1.000.000,00') ? 'selected' : ''; ?>>Kurang dari 1.000.000,00</option>
                                            <option value="1.000.000 - < 2.000.000" <?= ($pekerjaan['gaji_pertama_bekerja'] == '1.000.000 - < 2.000.000') ? 'selected' : ''; ?>>1.000.000 - < 2.000.000</option>
                                            <option value="2.000.000 - < 3.000.000" <?= ($pekerjaan['gaji_pertama_bekerja'] == '2.000.000 - < 3.000.000') ? 'selected' : ''; ?>>2.000.000 - < 3.000.000</option>
                                            <option value="3.000.000 - < 4.000.000" <?= ($pekerjaan['gaji_pertama_bekerja'] == '3.000.000 - < 4.000.000') ? 'selected' : ''; ?>>3.000.000 - < 4.000.000</option>
                                            <option value="> 4.000.000" <?= ($pekerjaan['gaji_pertama_bekerja'] == '> 4.000.000') ? 'selected' : ''; ?>> > 4.000.000</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4"><label for="gaji_pertama_bekerja">
                                            Sekarang :
                                        </label>
                                        <select class="form-control" required name="gaji_sekarang_bekerja" id="gaji_sekarang_bekerja">
                                            <option value="" disabled selected>==Click for option==</option>
                                            <option value="Kurang dari 1.000.000,00" <?= ($pekerjaan['gaji_sekarang_bekerja'] == 'Kurang dari 1.000.000,00') ? 'selected' : ''; ?>>Kurang dari 1.000.000,00</option>
                                            <option value="1.000.000 - < 2.000.000" <?= ($pekerjaan['gaji_sekarang_bekerja'] == '1.000.000 - < 2.000.000') ? 'selected' : ''; ?>>1.000.000 - < 2.000.000</option>
                                            <option value="2.000.000 - < 3.000.000" <?= ($pekerjaan['gaji_sekarang_bekerja'] == '2.000.000 - < 3.000.000') ? 'selected' : ''; ?>>2.000.000 - < 3.000.000</option>
                                            <option value="3.000.000 - < 4.000.000" <?= ($pekerjaan['gaji_sekarang_bekerja'] == '3.000.000 - < 4.000.000') ? 'selected' : ''; ?>>3.000.000 - < 4.000.000</option>
                                            <option value="> 4.000.000" <?= ($pekerjaan['gaji_sekarang_bekerja'] == '> 4.000.000') ? 'selected' : ''; ?>> > 4.000.000</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4"><label for="gaji_harapan">
                                            Diharapkan :
                                        </label>
                                        <select class="form-control" required name="gaji_harapan" id="gaji_harapan">
                                            <option value="" disabled selected>==Click for option==</option>
                                            <option value="Kurang dari 1.000.000,00" <?= ($pekerjaan['gaji_harapan'] == 'Kurang dari 1.000.000,00') ? 'selected' : ''; ?>>Kurang dari 1.000.000,00</option>
                                            <option value="1.000.000 - < 2.000.000" <?= ($pekerjaan['gaji_harapan'] == '1.000.000 - < 2.000.000') ? 'selected' : ''; ?>>1.000.000 - < 2.000.000</option>
                                            <option value="2.000.000 - < 3.000.000" <?= ($pekerjaan['gaji_harapan'] == '2.000.000 - < 3.000.000') ? 'selected' : ''; ?>>2.000.000 - < 3.000.000</option>
                                            <option value="3.000.000 - < 4.000.000" <?= ($pekerjaan['gaji_harapan'] == '3.000.000 - < 4.000.000') ? 'selected' : ''; ?>>3.000.000 - < 4.000.000</option>
                                            <option value="> 4.000.000" <?= ($pekerjaan['gaji_harapan'] == '> 4.000.000') ? 'selected' : ''; ?>> > 4.000.000</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="permasalahan_pekerjaan">Permasalahan apa saja yang Saudara hadapi dalam rangka memperoleh pekerjaan?</label>
                                <textarea class="form-control" name="permasalahan_pekerjaan" id="permasalahan_pekerjaan" rows="3" placeholder="Masukkan Permasalahan dalam rangka memperoleh Bidang Pekerjaan"><?= $pekerjaan['permasalahan_pekerjaan'] == '-' ? null : $pekerjaan['permasalahan_pekerjaan']; ?></textarea>
                            </div>
                        </div>
                    <?php else : ?>
                        <div id="form-group-container">
                            <div class="form-group mb-4 mt-1">
                                <label for="tempat_kerja">Sebutkan nama lembaga tempat Saudara bekerja?</label>
                                <input type="text" required class="form-control" name="tempat_kerja" id="tempat_kerja" aria-describedby="helpId" placeholder="Masukkan Tempat Kerja">
                            </div>
                            <div class="form-group mb-4">
                                <label for="lama_menganggur">Setelah lulus, berapa lama Saudara menunggu untuk mendapatkan
                                    pekerjaan pertama?</label>
                                <select class="form-control" required name="lama_menganggur" id="lama_menganggur">
                                    <option value="" disabled selected>==Click for option==</option>
                                    <option value="Sudah bekerja sebelum lulus">Sudah bekerja sebelum lulus</option>
                                    <option value="Kurang dari 3 bulan">Kurang dari 3 bulan</option>
                                    <option value="3 - 6 bulan">3 - 6 bulan</option>
                                    <option value="6 - 12 bulan">6 - 12 bulan</option>
                                    <option value="1 - 2 tahun">1 - 2 tahun</option>
                                    <option value="Lebih dari 2 tahun">Lebih dari 2 tahun</option>
                                </select>
                            </div>
                            <div class="form-group mb-4">
                                <label for="sumber_informasi_pekerjaan">Dari mana Saudara mendapatkan informasi tentang pekerjaan pertama yang
                                    saudara peroleh ?</label>
                                <select class="form-control" required name="sumber_informasi_pekerjaan" id="sumber_informasi_pekerjaan">
                                    <option value="" disabled selected>==Click for option==</option>
                                    <option value="Iklan">Iklan</option>
                                    <option value="Teman">Teman</option>
                                    <option value="Keluarga">Keluarga</option>
                                    <option value="Pengguna kerja (Employer)">Pengguna kerja (Employer)</option>
                                    <option value="Mencari sendiri: browsing di internet dan sebagainya">Mencari sendiri: browsing di internet dan sebagainya</option>
                                </select>
                            </div>
                            <div class="form-group mb-4">
                                <label for="kapan_mulai_mencari">Kapan Saudara mulai mencari pekerjaan ?</label>
                                <select class="form-control" required name="kapan_mulai_mencari" id="kapan_mulai_mencari">
                                    <option value="" disabled selected>==Click for option==</option>
                                    <option value="Lebih dari satu bulan sebelum wisuda">Lebih dari satu bulan sebelum wisuda</option>
                                    <option value="Segera setelah wisuda">Segera setelah wisuda</option>
                                    <option value="Satu bulan setelah wisuda">Satu bulan setelah wisuda</option>
                                    <option value="Lebih dari satu bulan setelah wisuda">Lebih dari satu bulan setelah wisuda</option>
                                    <option value="Belum memperoleh informasi lowongan pekerjaan yang relatif relevan">Belum memperoleh informasi lowongan pekerjaan yang relatif relevan</option>
                                </select>
                            </div>
                            <div class="form-group mb-4">
                                <label for="cara_dapat">Bagaimana cara Saudara mendapatkan pekerjaan pertama ?</label>
                                <select class="form-control" required name="cara_dapat" id="cara_dapat">
                                    <option value="" disabled selected>==Click for option==</option>
                                    <option value="Berkompetisi (dengan tes)">Berkompetisi (dengan tes)</option>
                                    <option value="Rekomendasi (tanpa tes)">Rekomendasi (tanpa tes)</option>
                                    <option value="Ditempatkan (karena ada ikatan dinas dsb.)">Ditempatkan (karena ada ikatan dinas dsb.)</option>
                                    <option value="Diminta oleh pengguna">Diminta oleh pengguna</option>
                                    <option value="Memanfaatkan koneksi">Memanfaatkan koneksi</option>
                                    <option value="Melalui agen tenaga kerja">Melalui agen tenaga kerja</option>
                                    <option value="Melalui Unit Pengembangan Karir dan Penempatan Kerja">Melalui Unit Pengembangan Karir dan Penempatan Kerja</option>
                                    <option value="Meng-iklankan diri sendiri melalui internet">Meng-iklankan diri sendiri melalui internet</option>
                                    <option value="Berwirausaha">Berwirausaha</option>
                                </select>
                            </div>
                            <div class="form-group mb-4">
                                <label for="gaji_pekerjaan_pertama">Berapa gaji Saudara per bulan untuk pekerjaan pertama ?</label>
                                <select class="form-control" required name="gaji_pekerjaan_pertama" id="gaji_pekerjaan_pertama">
                                    <option value="" disabled selected>==Click for option==</option>
                                    <option value="Kurang dari 1.000.000,00">Kurang dari 1.000.000,00</option>
                                    <option value="1.000.000 - < 2.000.000">1.000.000 - < 2.000.000</option>
                                    <option value="2.000.000 - < 3.000.000">2.000.000 - < 3.000.000</option>
                                    <option value="3.000.000 - < 4.000.000">3.000.000 - < 4.000.000</option>
                                    <option value="4.000.000 - < 5.000.000">4.000.000 - < 5.000.000</option>
                                    <option value="> 5.000.000"> > 5.000.000</option>
                                </select>
                            </div>
                            <div class="form-group mb-4">
                                <label for="lama_bekerja_saat_ini">Berapa lama Saudara menekuni pekerjaan Saudara saat ini ?</label>
                                <select class="form-control" required name="lama_bekerja_saat_ini" id="lama_bekerja_saat_ini">
                                    <option value="" disabled selected>==Click for option==</option>
                                    <option value="Kurang dari 6 bulan">Kurang dari 6 bulan</option>
                                    <option value="6 - 12 bulan">6 - 12 bulan</option>
                                    <option value="1 - 2 tahun">1 - 2 tahun</option>
                                    <option value="2 - 3 tahun">2 - 3 tahun</option>
                                    <option value="Lebih dari 3 tahun">Lebih dari 3 tahun</option>
                                </select>
                            </div>
                            <div class="form-group mb-4">
                                <label for="bidang_pekerjaan">Bidang pekerjaan Saudara termasuk
                                    Sektor :
                                </label>
                                <select class="form-control" required name="bidang_pekerjaan" id="bidang_pekerjaan">
                                    <option value="" disabled selected>==Click for option==</option>
                                    <option value="Pendidikan">Pendidikan</option>
                                    <option value="Pemerintah daerah">Pemerintah daerah</option>
                                    <option value="Swasta">Swasta</option>
                                    <option value="Wirausaha">Wirausaha</option>
                                </select>
                            </div>
                            <div class="form-group mb-4">
                                <label for="deskripsi_bidang_pekerjaan">Bidang pekerjaan: (tuliskan)</label>
                                <textarea class="form-control" name="deskripsi_bidang_pekerjaan" id="deskripsi_bidang_pekerjaan" rows="3" placeholder="Masukkan Deskripsi Bidang Pekerjaan"></textarea>
                            </div>
                            <div class="form-group mb-4">
                                <label for="sesuai">Apakah bidang pekerjaan Saudara saat ini sesuai dengan bidang studi yang Saudara ambil?
                                </label>
                                <select class="form-control" required name="sesuai" id="sesuai">
                                    <option value="" disabled selected>==Click for option==</option>
                                    <option value="ya">Sesuai</option>
                                    <option value="tidak">Tidak</option>
                                </select>
                            </div>
                            <div class="form-group mb-4">
                                <label for="gaji_pertama_bekerja">Berapa gaji Saudara per bulan untuk pekerjaan Saudara saat ini ?
                                </label>
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4"><label for="gaji_pertama_bekerja">
                                            Pertama :
                                        </label>
                                        <select class="form-control" required name="gaji_pertama_bekerja" id="gaji_pertama_bekerja">
                                            <option value="" disabled selected>==Click for option==</option>
                                            <option value="Kurang dari 1.000.000,00">Kurang dari 1.000.000,00</option>
                                            <option value="1.000.000 - < 2.000.000">1.000.000 - < 2.000.000</option>
                                            <option value="2.000.000 - < 3.000.000">2.000.000 - < 3.000.000</option>
                                            <option value="3.000.000 - < 4.000.000">3.000.000 - < 4.000.000</option>
                                            <option value="> 4.000.000"> > 4.000.000</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4"><label for="gaji_pertama_bekerja">
                                            Sekarang :
                                        </label>
                                        <select class="form-control" required name="gaji_sekarang_bekerja" id="gaji_sekarang_bekerja">
                                            <option value="" disabled selected>==Click for option==</option>
                                            <option value="Kurang dari 1.000.000,00">Kurang dari 1.000.000,00</option>
                                            <option value="1.000.000 - < 2.000.000">1.000.000 - < 2.000.000</option>
                                            <option value="2.000.000 - < 3.000.000">2.000.000 - < 3.000.000</option>
                                            <option value="3.000.000 - < 4.000.000">3.000.000 - < 4.000.000</option>
                                            <option value="> 4.000.000"> > 4.000.000</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4"><label for="gaji_pertama_bekerja">
                                            Diharapkan :
                                        </label>
                                        <select class="form-control" required name="gaji_harapan" id="gaji_harapan">
                                            <option value="" disabled selected>==Click for option==</option>
                                            <option value="Kurang dari 1.000.000,00">Kurang dari 1.000.000,00</option>
                                            <option value="1.000.000 - < 2.000.000">1.000.000 - < 2.000.000</option>
                                            <option value="2.000.000 - < 3.000.000">2.000.000 - < 3.000.000</option>
                                            <option value="3.000.000 - < 4.000.000">3.000.000 - < 4.000.000</option>
                                            <option value="> 4.000.000"> > 4.000.000</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="permasalahan_pekerjaan">Permasalahan apa saja yang Saudara hadapi dalam rangka memperoleh
                                    pekerjaan?</label>
                                <textarea class="form-control" name="permasalahan_pekerjaan" id="permasalahan_pekerjaan" rows="3" placeholder="Masukkan Permasalahan dalam rangka memperoleh Bidang Pekerjaan"></textarea>
                            </div>
                            
                            <div class="form-group mb-4">
                                <label for="sesuai">Apabila Saudara bekerja pada bidang pendidikan, apakah Saudara pernahditugaskan mengikuti pelatihan model pembelajaran inovatif?
                                </label>
                                <select class="form-control" required name="" id="">
                                    <option value="" disabled selected>==Click for option==</option>
                                    <option value="pernah" <?= ($pekerjaan['sesuai'] == 'ya') ? 'selected' : ''; ?>>Sesuai</option>
                                    <option value="tidak pernah" <?= ($pekerjaan['sesuai'] == 'tidak') ? 'selected' : ''; ?>>Tidak</option>
                                </select>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>