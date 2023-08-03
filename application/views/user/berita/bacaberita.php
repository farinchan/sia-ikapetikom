<?php foreach ($kontenberita as $berita): ?>
<?php
    $originalDate = $berita->tanggal_posting;
    $newDate = date("d F Y", strtotime($originalDate));
?>
<section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <ol>
                <li><a href="<?php echo base_url('main'); ?>">Home</a></li>
                <li><a href="<?php echo base_url('main/beritaalumni'); ?>">Berita Alumni</a></li>
                <li><?php echo $berita->judul_berita; ?></li>
            </ol>
            <?php $this->load->view('user/partisi/cariberita.php') ?>
        </div>
    </div>
</section>
<section class="inner-page">
    <div class="container">
        <span class="badge bg-primary"><i class="far fa-circle"></i> <?php echo $berita->nama_kategoriberita; ?></span><br><br>
        <h2 style="margin-top: 0px;"><?php echo $berita->judul_berita; ?></h2>
        <small style="font-size: 13px;"><i class="far fa-user"></i> <?php echo $berita->nama_alumni; ?> &bull; <i class="far fa-calendar-alt"></i> <?php echo $newDate; ?> &bull; <i class="fas fa-bolt"></i> dilihat <?php echo $berita->total_dilihat; ?></small>
        <div class="row">                
            <div class="col-sm-8" >                
                <section id="team" class="team section-bg" style="background-color: white;" >
                    <div data-aos="fade-up" style="margin-top: -20px;">
                    <div class="text-center">
                        <img src="<?php echo base_url('assets/berita/'.$berita->gambar_berita) ?>" alt="" class="img-fluid"><br>
                        <small><i>Berita ini dibuat oleh alumni tahun <?php echo $berita->tahun_lulus; ?> </i></small>
                    </div>
                    <br>
                    <?php echo $berita->isi_berita; ?>
                    </div>
                    <br>
                    <?php endforeach; ?>
                    <div class="row row-cols-auto">
                        <div class="col"><h4>Share</h4> </div>
                        <div class="col"><a href="https://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $berita->judul_berita; ?>&amp;p[summary]=<?php echo substr(strip_tags($berita->isi_berita),0,100) ;?>&amp;p[url]=<?php echo base_url('main/bacaberita/'.$berita->id_berita); ?>&amp;&p[images][0]=<?php echo base_url('assets/berita/'.$berita->gambar_berita);?>"><img src="https://image.flaticon.com/icons/png/512/124/124010.png" width="30px" alt=""></a></div>
                        <div class="col"><a href="https://twitter.com/share?text=text goes here&url=<?php echo base_url('main/bacaberita/'.$berita->id_berita); ?>"><img src="https://image.flaticon.com/icons/png/512/124/124021.png" width="30px" alt=""></a></div>
                        <div class="col"><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo base_url('main/bacaberita/'.$berita->id_berita); ?>&title=<?php echo $berita->judul_berita; ?>"><img src="https://image.flaticon.com/icons/png/512/174/174857.png" width="30px" alt=""></a></a></div>
                    </div>
                </section>                    
                <div id="disqus_thread"></div>
            </div>

            <?php $this->load->view('user/berita/infobacaberita.php'); ?>
            </div>
        </div>    
    </div>
</section>
<?php $this->load->view('user/partisi/disqus.php') ?>
