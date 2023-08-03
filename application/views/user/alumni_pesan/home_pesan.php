<section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <ol>
                <li><a href="<?php echo base_url('main'); ?>">Home</a></li>
                <li><a href="<?php echo base_url('main/profil'); ?>">Dashboard Alumni</a></li>
                <li>Pesan Pribadi</li>
            </ol>
            <?php $this->load->view('user/partisi/cariberita.php') ?>
        </div>
    </div>
</section>
<section class="inner-page">
    <div class="container">
        <h2 style="margin-top: -30px;">Pesan Pribadi</h2>
            
        <section id="team" class="team section-bg" style="background-color: white;" >
            <div data-aos="fade-up" style="margin-top: -20px;">    
                <div class="card">
                    <div class="card-header" style="background-color: white;">
                        Pilih kontak dibawah
                    </div>
                    <div class="card-body">

                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Kontak Masuk
                            </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                
                            <div class="list-group list-group-flush">
                                <?php if(empty($list_nisn_pengirim)){}else{ ?>
                                <?php foreach ($list_nisn_pengirim as $kotakmasuk): ?>
                                <a href="<?php echo base_url('main/kirimpesan/'.$kotakmasuk['nisn']) ?>" class="list-group-item list-group-item-action"><?php echo $kotakmasuk['nama_alumni']; ?> <span style="float: right;" class="badge bg-primary rounded-pill"><?php if($kotakmasuk['not_watch'] == 0){}else{echo "belum terbaca ".$kotakmasuk['not_watch']; } ?></span></a>
                                <?php endforeach; ?>
                                <?php } ?>
                            </div>

                            </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Kontak Keluar
                            </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="accordion-body">

                                <div class="list-group list-group-flush">
                                <?php if(empty($list_nisn_tujuan)){}else{ ?>
                                <?php foreach ($list_nisn_tujuan as $kotakmasuk): ?>
                                <a href="<?php echo base_url('main/kirimpesan/'.$kotakmasuk['nisn']) ?>" class="list-group-item list-group-item-action"><?php echo $kotakmasuk['nama_alumni']; ?> </a>
                                <?php endforeach; ?>
                                <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    </div>

                </div>
                <div class="card-footer">
                    <center>Masuk ke menu cari alumni -> Lalu pilih alumni yang ingin anda ajak berkomunikasi.</center>
                </div>
            </div>
        </section>                          

        </div>    
    </div>
</section>