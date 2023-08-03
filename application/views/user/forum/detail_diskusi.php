<?php foreach ($isitopik as $topik): ?>
<section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <ol>
                <li><a href="<?php echo base_url('main'); ?>">Home</a></li>
                <li><a href="<?php echo base_url('main/diskusi') ?>">Diskusi</a></li>
                <li><?php echo $topik->judul_topik; ?></li>
            </ol>
            <?php $this->load->view('user/partisi/cariberita.php') ?>
        </div>
    </div>
</section>
<section class="inner-page">
    <div class="container">

        <div class="row">                
            <div class="col-sm-8" >                
                <section id="team" class="team section-bg" style="background-color: white;" >

                    <div class="card" style="border: none;">
                        <div class="card-body">
                            <div class="container">
                                <h3 style="margin-top: -70px;"><?php echo $topik->judul_topik; ?></h3>
                                <p>Dibuat Pada <?php echo $topik->tanggal; ?>, Telah dilihat <?php echo $topik->total_dilihat; ?> kali </p>
                                <?php if($topik->hak_akses == "private" && $topik->tahun_lulus != $tahunlulus_saya){ ?>
                                <div class="alert alert-success" role="alert">
                                   Diskusi bersifat <b>PRIVATE</b> Hanya Alumni <b><?php echo $topik->tahun_lulus; ?></b> Yang bisa Berdiskusi, Anda merupakan alumni <b><?php echo $tahunlulus_saya; ?></b>
                                </div>
                                <?php }else{ ?>
                                <div class="row">
                                    <div class="col-6 col-md-3">
                                        <img id="image-diskusi" src="<?php echo base_url('assets/user/img/'.$topik->foto_alumni) ?>" alt="" class="img-fluid rounded-circle" width="150px">
                                    </div>
                                    <div class="col-md-9">
                                        <h6><i class="fas fa-user"></i> <a href="<?php echo base_url('main/lihatprofil/'.$topik->nisn) ?>"><?php echo $topik->nama_alumni; ?></a>, <small style="color: red; font-size: 12px;"><i>Mengatakan</i></small> </h6>
                                        <p><?php echo $topik->isi_topik; ?></p>
                                        <?php if($topik->lampiran_file == "kosong"){}else{ ?>
                                        <div class="alert alert-success" role="alert">
                                            <i class="fas fa-link"></i> Ada File Lampiran
                                        </div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item"><a href="<?php echo base_url('main/downloadfiletopik?data='.$topik->lampiran_file) ?>"> <b><?php echo $topik->lampiran_file; ?></b></a></li>
                                        </ul>
                                        <?php } ?>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

                <?php if($topik->hak_akses == "private" && $topik->tahun_lulus != $tahunlulus_saya){ ?>

                <?php }else{ ?>

                    <div class="alert alert-primary" role="alert">
                    Ada <b id="total_komentar"><?php  echo $totalkomentar; ?></b> Komentar <?php if($topik->status_topik == "N"){ ?> | <b> Diskusi Ditutup</b> <?php } ?>
                    </div>
                    <?php if($topik->status_topik != "N"): ?>
                    <?php $id_topik = $this->uri->segment(3); ?>
                    <form id="form_diskusi" method="post">
                        <div class="form-group">
                            <textarea id="textarea_diskusi" class="form-control" required name="isi_diskusi" rows="3" placeholder="Assalamualaikum..."></textarea>
                        </div>
                        <div class="row">
                            <div class="col mt-3">
                            <div class="drop-zone" style="height: 19px;">
                                <span class="drop-zone__prompt">Drag file atau klik kolom ini</span>
                                <input type="file" name="myFile" id="file_diskusi" class="drop-zone__input">
                            </div>
                            <input type="hidden" name="id_topik" value="<?php echo $id_topik; ?>">
                            </div>
                            <div class="col mt-3" >
                            <button style="float: right;" class="btn btn-success" type="submit"> Kirimkan</button>
                            </div>
                        </div>
                    </form><br>
                    <?php endif; ?>
                    <div class="d-flex justify-content-center">
                        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status" id="spinner">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    
                    <div id="konten-diskusi"></div>
                    <ul class="list-group list-group-flush" id="list_diskusi">
                        <?php foreach ($diskusi as $list): ?>
                        <li class="list-group-item"><i class="fas fa-user"></i> <?php echo $list->nama_alumni; ?> , <small class="text-muted">Commented On <?php echo $list->tanggal; ?></small></li>
                        <li class="list-group-item">                          
                            <div class="row">
                            <div class="col-2">
                                <img id="image-diskusi" src="<?php echo base_url('assets/user/img/'.$list->foto_alumni) ?>" alt="" class="img-fluid rounded-circle" width="80px">
                            </div>
                            <div class="col-9">
                                <p style="font-size: 14px;"><?php echo $list->isi_diskusi; ?></p>
                                <?php if($list->lampiran_file == "kosong"){}else{ ?>
                                    <small>Lampiran file : </small>
                                    <small><a href="<?php echo base_url('main/downloadfiletopik?data='.$list->lampiran_file); ?>"><?php echo $list->lampiran_file; ?></a></small>
                                <?php } ?>
                            </div>
                            </div>                                           
                        </li>
                        <?php endforeach; ?>                                     
                    </ul>
                <?php } ?>
                </section>
                
            </div>
                <?php $this->load->view('user/forum/info_topik.php'); ?>
            </div>
        </div>    
    </div>
</section>