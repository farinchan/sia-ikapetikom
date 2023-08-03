<section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <ol>
                <li><a href="<?php echo base_url('main') ?>">Home</a></li>
                <li><a href="<?php echo base_url('main/traceralumni') ?>">tracer Alumni</a></li>
                <li><?php echo $namakategori ?></li>
            </ol>
            <?php $this->load->view('user/partisi/caritracer.php') ?>
        </div>
    </div>
</section>
<section class="inner-page">
    <div class="container">
        <h2 style="margin-top: -30px;" id="title-konten">Kategori : <?php echo $namakategori ?></h2>
        <div class="row">                
            <div class="col-sm-8" >                
                <section id="team" class="team section-bg" style="background-color: white;" >
                    <div  style="margin-top: -20px;">    
                        <div class="row">
                            <?php foreach ($listtracer as $tracer): ?>
                            <?php
                                $originalDate = $tracer->tanggal_posting;
                                $newDate = date("d F Y", strtotime($originalDate));
                            ?>
                            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                                <div class="member">
                                    <div class="member-img">
                                        <img src="<?php echo base_url('assets/tracer/'.$tracer->gambar_tracer); ?>" class="img-fluid" alt="">
                                        <div class="social">
                                            <a target="BLANK" href="https://twitter.com/share?text=text goes here&url=<?php echo base_url('main/bacatracer/'.$tracer->id_tracer); ?>"><i class="bi bi-twitter" ></i></a>
                                            <a target="BLANK" href="https://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $tracer->judul_tracer; ?>&amp;p[summary]=<?php echo substr(strip_tags($tracer->isi_tracer),0,100) ;?>&amp;p[url]=<?php echo base_url('main/bacatracer/'.$tracer->id_tracer); ?>&amp;&p[images][0]=<?php echo base_url('assets/tracer/'.$tracer->gambar_tracer);?>"><i class="bi bi-facebook"></i></a>
                                            <a target="BLANK" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo base_url('main/bacatracer/'.$tracer->id_tracer); ?>&title=<?php echo $tracer->judul_tracer; ?>"><i class="bi bi-linkedin"></i></a>
                                        </div>
                                    </div>
                                    <div class="member-info">
                                        <a href="<?php echo base_url('main/bacatracer/'.$tracer->id_tracer); ?>" id="populer"><?php echo $tracer->judul_tracer; ?></a><br>
                                        <span id="card-donasi"><i class="far fa-calendar-alt"></i> <?php echo $newDate; ?> &bull; <i class="fas fa-bolt"></i> dilihat <?php echo $tracer->total_dilihat; ?></span>
                                        <p  style="font-style:normal"><?php echo substr(strip_tags($tracer->isi_tracer),0,70) . "..."; ?></p>                                      
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <?php echo $this->pagination->create_links(); ?>                     
                    </section>
                </div>
                <?php $this->load->view('user/tracer/infotracer.php'); ?>
            </div>
        </div>    
    </div>
</section>