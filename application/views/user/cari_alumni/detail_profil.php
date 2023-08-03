<section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <ol>
                <li><a href="<?php echo base_url('main'); ?>">Home</a></li>
                <li><a href="<?php echo base_url('main/carialumni'); ?>">Pencarian Alumni</a></li>
                <?php foreach ($data_profil as $x): ?>
                <li><?php echo $x->nama_alumni; ?></li>
                <?php endforeach; ?>
            </ol>
            <?php $this->load->view('user/partisi/cariberita.php') ?>
        </div>
    </div>
</section>
<section class="inner-page">

    <div class="container">

    <?php if(isset($_SESSION['nisn_session'])){ ?>

        <?php foreach ($data_profil as $x): ?>
        <h2 style="margin-top: -30px;">Profil <?php echo $x->nama_alumni; ?> </h2>
        <?php endforeach; ?>
        <div class="row">                
            <div class="col-sm-4" >                
                <section id="team" class="team section-bg" style="background-color: white;" >
                    <div data-aos="fade-up" style="margin-top: -20px;">    
                        <?php $this->load->view('user/cari_alumni/foto_profil.php');?>
                        <div class="card mt-4">
                            <div class="card-header" style="background-color: white;">
                                Kontribusi Alumni
                            </div>
                            <div class="card-body">
                                <div class="list-group list-group-flush">
                                    <a class="list-group-item list-group-item-action">Kontribusi Berita <span style="float: right;" class="badge bg-primary rounded-pill"><?php echo $total_berita; ?></span></a>
                                    <a href="<?php echo base_url('main/kirimpesan/'.$x->nisn); ?>" class="list-group-item list-group-item-action">Kirim Pesan <span style="float: right;" class="badge bg-primary rounded-pill"><i class="fas fa-paper-plane" style="float: right;"></i></span></a>
                                    <a class="list-group-item list-group-item-action"> Kontribusi Donasi <span style="float: right;" class="badge bg-primary rounded-pill"><?php echo $totaldonasi; ?></span></a>
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
                                    <?php foreach ($data_profil as $x): ?>
                                    Profil <?php echo $x->nama_alumni; ?>
                                    <?php endforeach; ?>
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

            <?php }else{ ?>
           <h5 style="margin-top: -30px;">Anda harus <a href="<?php echo base_url('main/login') ?>">login</a> terlebih dahulu untuk melihat profil.</h5>
            <?php } ?>
        </div>    
    </div>
</section>