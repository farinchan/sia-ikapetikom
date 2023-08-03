<section id="portofolio" class="team section-bg">
    <div class="container" data-aos="fade-up">

    <div class="section-title">
        <h3>Donasi <span>Alumni</span></h3>
    </div>

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
        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="member">
                <div class="member-img">
                    <img src="<?php echo base_url('assets/donasi/img/'.$x->gambar_donasi) ?>" class="img-fluid" alt="">
                    <div class="social">
                        <a href="http://twitter.com/share?text=text goes here&url=<?php echo base_url('main/detaildonasi/'.$x->id_donasi); ?>"><i class="fab fa-twitter-square"></i></a>
                        <a target="BLANK" href="http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $x->judul_donasi; ?>&amp;p[url]=<?php echo base_url('main/detaildonasi/'.$x->id_donasi); ?>&amp;&p[images][0]=<?php echo base_url('assets/donasi/img/'.$x->gambar_donasi);?>"><i class="fab fa-facebook-square"></i></a>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo base_url('main/detaildonasi/'.$x->id_donasi); ?>&title=<?php echo $x->judul_donasi; ?>"><i class="fab fa-linkedin"></i></a>
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
    <p style="float: right;"><a href="<?php echo base_url('main/donasi') ?>">Baca Selengkapnya <i class="bi bi-arrow-right"></i></a></p>

    </div>
</section>
