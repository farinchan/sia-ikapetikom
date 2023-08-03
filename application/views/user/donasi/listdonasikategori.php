<section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <ol>
                <li><a href="<?php echo base_url('main') ?>">Home</a></li>
                <li><a href="<?php echo base_url('main/donasi') ?>">Donasi</a></li>
                <li><?php echo $kategori ?></li>
            </ol>
            <?php $this->load->view('user/partisi/cariberita.php') ?>
        </div>
    </div>
</section>
<section class="inner-page">
    <div class="container">
        <h2 style="margin-top: -30px;">Kategori : <?php echo $kategori ?></h2>
        <div class="row">                
            <div class="col-sm-8" >                
                <section id="team" class="team section-bg" style="background-color: white;" >
                    <div data-aos="fade-up" style="margin-top: -20px;">    
                        <div class="row" id="datadonasi">
                            <?php foreach ($listdonasi as $x): ?>
                            <?php
                                date_default_timezone_set('Asia/Jakarta');
                                $originalDate = $x->tanggal_donasidibuat;
                                $newDate = date("d F Y", strtotime($originalDate));

                                $date1 = new DateTime(date('Y-m-d', strtotime($x->donasi_ditutup)));
                                $date2 = new DateTime();

                                $progres = ($x->donasi_terkumpul / $x->target_dana) * 100;
                            ?>
                            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                                <div class="member">
                                    <div class="member-img">
                                        <img src="<?php echo base_url('assets/donasi/img/'.$x->gambar_donasi) ?>" class="img-fluid" alt="">
                                        <div class="social">
                                            <a href=""><i class="bi bi-twitter"></i></a>
                                            <a href=""><i class="bi bi-facebook"></i></a>
                                            <a href=""><i class="bi bi-instagram"></i></a>
                                        </div>
                                    </div>
                                    <div class="member-info">
                                        <h4><?php echo $x->judul_donasi; ?></h4>
                                        <span id="card-donasi"><i class="far fa-calendar-alt"></i> <?php echo $newDate; ?> &bull; <i class="fas fa-bolt"></i> dilihat <?php echo $x->total_dilihat; ?></span>
                                        <div class="progress mt-4" style="height: 8px;">
                                            <div class="progress-bar" role="progressbar" style="width: <?php echo $progres ?>%;" aria-valuenow="<?php echo $progres ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <small class="text-muted">Terkumpul</small><br>
                                                <small style="color: blue;">Rp. <?php echo number_format($x->donasi_terkumpul, 2, ',', '.') ?></small>
                                            </div>

                                            <div class="col">
                                                <small class="text-muted" style="float: right;">Durasi</small><br>
                                                <small class="text-black" style="float: right;"><?php if($date1 < $date2){echo "Ditutup"; }else{ echo $date1->diff($date2)->days." Hari lagi"; } ?> </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="d-grid gap-2">
                                            <a href="<?php echo base_url('main/detaildonasi/'.$x->id_donasi) ?>" type="button" class="btn btn-primary">Donasi Sekarang</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <?php echo $this->pagination->create_links(); ?>                                            
                    </section>
                </div>
            <?php $this->load->view('user/donasi/samping.php'); ?>
            </div>
        </div>    
    </div>
</section>