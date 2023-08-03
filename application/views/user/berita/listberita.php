<section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <ol>
                <li><a href="<?php echo base_url('main/') ?>">Home</a></li>
                <li>Berita Alumni</li>
            </ol>
            <?php $this->load->view('user/partisi/cariberita.php') ?>
        </div>
    </div>
</section>
<section class="inner-page">
    <div class="container">
        <h2 style="margin-top: -30px;" id="title-konten">Berita Alumni</h2>
        <div class="row">                
            <div class="col-sm-8" >                
                <section id="team" class="team section-bg" style="background-color: white;" >
                    <div  style="margin-top: -20px;">    
                        <div class="row" id="databerita">        
                        </div>
                        <div id='pagination'></div>                           
                    </section>
                </div>
                <?php $this->load->view('user/berita/infoberita.php'); ?>
            </div>
        </div>    
    </div>
</section>