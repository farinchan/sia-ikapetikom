<section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <ol>
                <li><a href="<?php echo base_url('main'); ?>">Home</a></li>
                <li>Dashboard Alumni</li>
            </ol>
            <?php $this->load->view('user/partisi/cariberita.php') ?>
        </div>
    </div>
</section>
<section class="inner-page">
    <div class="container">
        <h2 style="margin-top: -30px;">Selamat Datang <?php echo $_SESSION['nama_session']; ?> </h2>
        <div class="row">                
            <div class="col-sm-4" >                
                <section id="team" class="team section-bg" style="background-color: white;" >
                    <div data-aos="fade-up" style="margin-top: -20px;">    
                        <?php $this->load->view('user/alumni_dashboard/foto_profil.php');?>
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
                                    <a href="<?php echo base_url('main/pesan'); ?>" class="list-group-item list-group-item-action">Pesan Pribadi <?php if($pesan_belum_terbaca == 0){}else{ ?><span style="float: right;" class="badge bg-primary rounded-pill"><?php echo "New"; ?></span> <?php } ?></a>
                                    <a href="<?php echo base_url('main/alumnidonasi') ?>" class="list-group-item list-group-item-action">Kontribusi Donasi <span style="float: right;" class="badge bg-primary rounded-pill"><?php echo $total_donasi ?></span></a>
                                    <a href="<?php echo base_url('main/alumnilisttopik') ?>" class="list-group-item list-group-item-action">Topik Dibuat <span style="float: right;" class="badge bg-primary rounded-pill"><?php echo $totaltopik; ?></span></a>
                                    </div>
                            </div>
                            </div>
                    </div>

                </section>
            </div>

                <div class="col-sm-8">
                    <section id="team" class="team section-bg" style="background-color: white;" >
                        <div data-aos="fade-up" style="margin-top: -20px;">    
                            <div class="card">
                                <div class="card-header" style="background-color: white;">
                                    Data Diri Saya
                                    <a href="<?php echo base_url('main/editprofil'); ?>" style="float: right;"><i class="fas fa-user-edit"></i></a>
                                </div>
                                <div class="card-body">
                                    <table class="table">
                                        <tbody>
                                            <?php foreach ($data_profil as $profil): ?>
                                            <tr>
                                                <th scope="row">NIA</th>
                                                <td><?php echo $profil->nisn; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Nama</th>
                                                <td><?php echo $profil->nama_alumni; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Tahun Lulus</th>
                                                <td><?php echo $profil->tahun_lulus; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Email</th>
                                                <td><?php echo $profil->email; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Password</th>
                                                <td>**********</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">No Hp</th>
                                                <td><?php echo $profil->no_wa; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Status</th>
                                                <td><?php echo strtoupper($profil->status_alumni); ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Instansi</th>
                                                <td><?php echo $profil->detail_status; ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Provinsi</th>
                                                <td><?php echo strtoupper($kota['alamat_provinsi']); ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Kabupaten</th>
                                                <td><?php echo strtoupper($kota['alamat_kabupaten']); ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Kecamatan</th>
                                                <td><?php echo strtoupper($kota['alamat_kecamatan']); ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Riwayat Pendidikan</th>
                                                <td>
                                                    <table class="table table-bordered">
                                                         <thead>
                                                            <tr>
                                                                <th scope="col">Tahun</th>
                                                                <th scope="col">Instansi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $i=0; foreach($riwayatpendidikan as $x): ?>
                                                            <tr>
                                                                <td><?= $x->tahun_mulai." - ".$x->tahun_lulus; ?></td>
                                                                <td><?= $x->lembaga; ?></td>
                                                            </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Riwayat Pekerjaan</th>
                                                <td>
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Tahun</th>
                                                                <th scope="col">Lembaga Kerja</th>
                                                                <th scope="col">Bidang Kerja</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach($riwayatpekerjaan as $x): ?>
                                                            <tr>
                                                                <td><?=  $x->dari_tahun." - ".$x->sampai_tahun; ?></td>
                                                                <td><?= $x->lembaga; ?></td>
                                                                <td><?= $x->bidang_kerja; ?></td>
                                                            </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
    
                                            <tr>
                                                <th scope="row">Alamat Lengkap</th>
                                                <td><?php echo $profil->detail_alamat; ?></td>
                                            </tr>

                                        </tbody>
                                        </table>
                                        
                                        <center>
                                        <a style="float:center;" href="<?= $profil->facebook; ?>" target="_blank" class="btn btn-primary btn-sm" type="button"><i class="fab fa-facebook-square fa-2x"></i></a>
                                        <a style="float:center;" href="<?= $profil->instagram; ?>" target="_blank" class="btn btn-danger btn-sm" type="button"><i class="fab fa-instagram fa-2x"></i></a>
                                        <a style="float:center;" href="<?= $profil->twitter; ?>" target="_blank" class="btn btn-info btn-sm text-white" type="button"><i class="fab fa-twitter-square fa-2x"></i></a>
                                        </center>


                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </section>                          
                </div>
            </div>
        </div>    
    </div>
</section>