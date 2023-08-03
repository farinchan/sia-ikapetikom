<?php foreach ($data as $y): ?>
<section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <ol>
                <li><a href="<?php echo base_url('main'); ?>">Home</a></li>
                <li><a href="<?php echo base_url('main/profil'); ?>">Dashboard Alumni</a></li>
                <li><a href="<?php echo base_url('main/alumnidonasi'); ?>">Donasi Anda</a></li>
                <li><?php echo $y->judul_donasi; ?></li>
            </ol>
            <?php $this->load->view('user/partisi/cariberita.php') ?>
        </div>
    </div>
</section>
<section class="inner-page">
    <div class="container">
        <h2 style="margin-top: -30px;">Detail Donasi</h2>
        <div class="row">                


            <section id="team" class="team section-bg" style="background-color: white;" >
                <div data-aos="fade-up" style="margin-top: -20px;">    
                    <div class="card">
                        <div class="card-header" style="background-color: white;">
                            Donasi : <?php echo $y->judul_donasi; ?>
                        </div>
                        <div class="card-body">
                        
                        <form id="bayar_donasi" method="post">
                            <div class="mb-3 row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Total Donasi</label>
                                <div class="col-sm-10">
                                    <input type="text" name="total_donasi" id="nominal_donasi" class="form-control" placeholder="Rp.0" required readonly value="<?php echo  "Rp. ".number_format($y->total_donasi, 2, ',', '.') ?>">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Nama Donatur</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nama_alumni" id="nama_alumni" class="form-control" required value="<?php echo $_SESSION['nama_session'] ?>" readonly>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Doa Anda</label>
                                <div class="col-sm-10">
                                <textarea id="textarea_diskusi" class="form-control" name="doa_donatur" rows="3" placeholder="Semoga Berkah..." readonly><?php echo $y->doa_donatur; ?></textarea>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Metode Pembayaran</label>
                                <div class="col-sm-10">
                                    <select class="form-select" aria-label="Default select example" required name="id_tipepembayaran" id="rekening_tujuan" required disabled>
                                        <option value="">Pilih Metode Pembayaran</option>
                                        <?php foreach ($tipepembayaran as $x): ?>
                                        <?php if($x->id_tipepembayaran == $y->id_tipepembayaran){ ?>
                                        <option selected value="<?php echo $x->id_tipepembayaran ?>"><?php echo $x->rekening; ?> A/N <?php echo $x->atas_nama; ?> (<?php echo $x->nama_tipepembayaran; ?>)</option>
                                        <?php }else{ ?>
                                        <option value="<?php echo $x->id_tipepembayaran ?>"><?php echo $x->rekening; ?> A/N <?php echo $x->atas_nama; ?> (<?php echo $x->nama_tipepembayaran; ?>)</option>
                                        <?php } ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>                    
                            </div>

                            <div class="mb-3 row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Bukti Transfer </label>
                                <div class="col-sm-10">
                                    <ol class="list-group list-group-numbered">
                                        <li class="list-group-item"><a href="<?php echo base_url('main/download_buktitransfer?data='.$y->bukti_transfer) ?>"><?php echo $y->bukti_transfer; ?></a></li>
                                    </ol>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="staticEmail" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <?php if($y->status_pembayaran == "N"){ ?>
                                    <div class="callout callout-primary">
                                        Status Donasi : <b>Processing</b><br>
                                        Admin perlu memeriksa data - data donasi yang anda sumbangkan, Proses ini memakan waktu max 1 x 24 Jam agar donasi anda terferivikasi. Terima kasih telah berdonasi, Donasi anda akan sangat bermanfaat bagi orang lain. 
                                    </div>  
                                    <?php } ?>

                                    <?php if($y->status_pembayaran == "T"){ ?>
                                    <div class="callout callout-danger">
                                        Status Donasi : <b>Ditolak</b><br>
                                        Admin mendeteksi kalau ada kesalahan saat anda berdonasi, yakni ketidakvalid an bukti transfer yang anda upload. Silahkan lakukan donasi Ulang di form donasi
                                    </div>  
                                    <?php } ?>

                                    <?php if($y->status_pembayaran == "Y"){ ?>
                                    <div class="callout callout-success">
                                        Status Donasi : <b>Terverifikasi</b><br>
                                        Anda sudah melakukan donasi, dan dana sudah masuk ke sistem. Terima kasih telah berdonasi, Donasi anda akan sangat bermanfaat bagi orang lain. 
                                    </div>  
                                    <?php } ?>
                                </div>
                            </div>

                        </form>

                        </div>
                    </div>
                </div>
            </section>  
         </div>
        </div>    
    </div>
</section>
<?php endforeach; ?>
