<section id="portofolio" class="team section-bg">
    <div class="container" data-aos="fade-up">

    <div class="section-title">
        <h3>Berita <span>Alumni</span></h3>
    </div>

    <div class="row">
        <?php foreach ($listberita as $berita): ?>
        <?php
            $originalDate = $berita->tanggal_posting;
            $newDate = date("d F Y", strtotime($originalDate));
        ?>
        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="member">
                <div class="member-img">
                    <img src="<?php echo base_url('assets/berita/'.$berita->gambar_berita); ?>" class="img-fluid" alt="">
                    <div class="social">
                        <a href="http://twitter.com/share?text=text goes here&url=<?php echo base_url('main/bacaberita/'.$berita->id_berita); ?>"><i class="fab fa-twitter-square"></i></a>
                        <a target="BLANK" href="http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $berita->judul_berita; ?>&amp;p[summary]=<?php echo substr(strip_tags($berita->isi_berita),0,100) ;?>&amp;p[url]=<?php echo base_url('main/bacaberita/'.$berita->id_berita); ?>&amp;&p[images][0]=<?php echo base_url('assets/berita/'.$berita->gambar_berita);?>"><i class="fab fa-facebook-square"></i></a>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo base_url('main/bacaberita/'.$berita->id_berita); ?>&title=<?php echo $berita->judul_berita; ?>"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
                <div class="member-info">
                    <a href="<?php echo base_url('main/bacaberita/'.$berita->id_berita); ?>" id="populer"><?php echo $berita->judul_berita; ?></a><br>
                    <span id="card-donasi"><i class="far fa-calendar-alt"></i> <?php echo $newDate; ?> &bull; <i class="fas fa-bolt"></i> dilihat <?php echo $berita->total_dilihat; ?></span>
                    <p style="font-style:normal;"><?php echo substr(strip_tags($berita->isi_berita),0,100) . "..."; ?></p>                                      
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <p style="float: right;"><a href="<?php echo base_url('main/bacaberita') ?>">Baca Selengkapnya <i class="bi bi-arrow-right"></i></a></p>
    </div>
</section>