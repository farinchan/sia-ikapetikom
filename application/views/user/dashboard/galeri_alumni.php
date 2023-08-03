<?php $this->load->model('admin/Model_Dashboard'); ?>
<section class="portfolio">
    <div class="container" data-aos="fade-up">

    <div class="section-title">
        <h3>Galeri <span>Kegiatan</span></h3>
    </div>

    <div class="row">
        <?php foreach ($galeri as $x): ?>
        <div class="col-lg-3 col-md-6">
            <div class="card mb-4" data-aos="fade-up" data-aos-delay="100">
                <?php if(!empty($this->Model_Dashboard->getGambarLimit1($x->id_galeri))){ ?>
                <img src="<?php echo base_url('assets/galeri/'.$this->Model_Dashboard->getGambarLimit1($x->id_galeri)) ; ?>" width="80px" height="170px" class="card-img-top" alt="...">
                <?php }else{ ?>
                <img src="https://cel.ac/wp-content/uploads/2016/02/placeholder-img-1.jpg" width="80px" height="170px" class="card-img-top" alt="...">
                <?php } ?>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $x->judul_kegiatan; ?></h5>
                </div>
                <div class="card-footer bg-white">
                    <a href="<?php echo base_url('main/galeri/'.$x->id_galeri); ?>"><small>Selengkapnya</small></a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php echo $this->pagination->create_links(); ?>                     

    </div>
</section>

