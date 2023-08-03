<?php foreach ($data_penerima as $penerima): ?>
<section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <ol>
                <li><a href="<?php echo base_url('main'); ?>">Home</a></li>
                <li><a href="<?php echo base_url('main/profil'); ?>">Dashboard Alumni</a></li>
                <li><a href="<?php echo base_url('main/pesan'); ?>">Pesan Pribadi</a></li>
                <li><?php echo $penerima->nama_alumni; ?></li>
            </ol><br>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Cari Kegiatan" aria-label="Search"><br>
                <button class="btn btn-outline-info" type="submit">Cari</button>
            </form>
        </div>
    </div>
</section>
<section class="inner-page">
    <div class="container">
        <h2 style="margin-top: -30px;">Percakapan - <?php echo $penerima->nama_alumni; ?></h2>
        <div class="row">                
            <div class="col-sm-4" >                
                <?php $this->load->view('user/alumni_pesan/list_percakapan.php'); ?>
            </div>
            
                <div class="col-sm-8">
                    <section id="team" class="team section-bg" style="background-color: white;" >
                        <div data-aos="fade-up" style="margin-top: -20px;">    
                            <div class="card">
                                <div class="card-header" style="background-color: white;">
                                <small>Aktif, <?php if($last_login['hari'] != 0){echo $last_login['hari']." hari "; } if($last_login['jam'] != 0){echo $last_login['jam']." jam "; } ?> <?php echo $last_login['menit']." menit yang lalu" ?></small>
                                </div>
                                <div class="card-body">
                                
                                <form id="form_pesan" method="post">
                                    <div class="form-group">
                                    <textarea id="textarea_pesan" class="form-control" name="isi_pesan" rows="3" placeholder="Assalamualaikum..." required></textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col mt-3">
                                            <div class="drop-zone" style="height: 50%;">
                                                <span class="drop-zone__prompt">Drag File atau Klik kolom ini</span>
                                                <input type="file" name="myFile" id="myFile" class="drop-zone__input">
                                            </div>
                                        </div><br>
                                        <input type="hidden" name="nisn_tujuan" value="<?php echo $penerima->nisn; ?>">
                                        <div class="col mt-3" >
                                            <button style="float: right;" class="btn btn-success" type="submit"> Kirimkan</button>
                                        </div>
                                    </div>
                                </form>


                                <div class="d-flex justify-content-center">
                                    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status" id="spinner">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                 </div>

                                <div id="konten_pesan"></div>
                                <ul class="list-group list-group-flush" id="list_pesan">
                                    <?php foreach ($data_profil as $profil): ?>
                                        <?php foreach ($list_pesan as $list): ?>
                                        <li class="list-group-item"><i class="fas fa-user"></i> <?php if($list->nisn_pengirim == $_SESSION['nisn_session']){echo $_SESSION['nama_session']; }else{echo $penerima->nama_alumni;} ?>, <small class="text-muted">Dikirim <?php echo $list->tanggal; ?></small></li>
                                            <li class="list-group-item">                          
                                            <div class="row">
                                                <div class="col-2">
                                                    <?php if($list->nisn_pengirim == $_SESSION['nisn_session']){ ?>
                                                    <img id="image-diskusi" src="<?php echo base_url('assets/user/img/'.$profil->foto_alumni); ?>" alt="" class="img-fluid rounded-circle" width="80px">
                                                    <?php }else{ ?>
                                                    <img id="image-diskusi" src="<?php echo base_url('assets/user/img/'.$penerima->foto_alumni); ?>" alt="" class="img-fluid rounded-circle" width="80px">
                                                    <?php } ?>
                                                </div>
                                                <div class="col-9">
                                                <p style="font-size: 14px;"><?php echo $list->isi_pesan; ?></p>
                                                <?php if($list->lampiran_file == "kosong"){}else{ ?>
                                                    <small>Lampiran file : </small>
                                                    <small><a href="<?php echo base_url('main/downloadfiletopik?data='.$list->lampiran_file); ?>"><?php echo $list->lampiran_file; ?></a></small>
                                                <?php } ?>
                                                </div>
                                            </div>                                           
                                        </li>
                                        <?php endforeach; ?>
                                    <?php endforeach; ?>
                                </ul>

                                </div>
                            </div>
                        </div>
                    </section>                          
                </div>
            </div>
        </div>    
    </div>
</section>

<?php endforeach; ?>