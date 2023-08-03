<?php foreach ($data as $x):?>
<?php
    $originalDate = $x->tanggal_donasidibuat;
    $newDate = date("d F Y", strtotime($originalDate));
?>
<section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <ol>
                <li><a href="<?php echo base_url('main'); ?>">Home</a></li>
                <li><a href="<?php echo base_url('main/donasi') ?>">Donasi</a></li>
                <li><a href="<?php echo base_url('main/detaildonasi/'.$this->uri->segment(3)) ?>"><?php echo $x->judul_donasi; ?></a></li>
                <li>Transaksi Pembayaran</li>
            </ol>
            <?php $this->load->view('user/partisi/cariberita.php') ?>
        </div>
    </div>
</section>
<section class="inner-page">
    <div class="container">
        <span class="badge bg-primary"><i class="far fa-circle"></i> <?php echo $x->nama_kategoridonasi; ?></span><br><br>
        <h2 style="margin-top: 0px;"><?php echo $x->judul_donasi; ?></h2>
        <small style="font-size: 13px;"><i class="far fa-user"></i> Administrator &bull; <i class="far fa-calendar-alt"></i> <?php echo $newDate; ?> &bull; <i class="fas fa-bolt"></i> dilihat <?php echo $x->total_dilihat; ?></small>
<?php endforeach; ?>
        <div class="row">                
            <div class="col-sm-8" >  

                <section id="team" class="team section-bg" style="background-color: white;" >
                    <form id="bayar_donasi" method="post">
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Total Donasi</label>
                            <div class="col-sm-10">
                                <input type="text" name="total_donasi" id="nominal_donasi" class="form-control" placeholder="Rp.0" required>
                            </div>
                        </div>
                        <input type="hidden" name="id_donasi" value="<?php echo $this->uri->segment(3); ?>">
                        <input type="hidden" name="nisn" value="<?php echo $_SESSION['nisn_session'] ?>">
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Nama Donatur</label>
                            <div class="col-sm-10">
                                <input type="text" name="nama_alumni" id="nama_alumni" class="form-control" required value="<?php echo $_SESSION['nama_session'] ?>" readonly>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Tahun Angkatan</label>
                            <div class="col-sm-10">
                                <input type="number" name="tahun_angkatan" id="tahun_angkatan" class="form-control" required value="<?php echo $tahun_lulus; ?>" readonly>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Doa Anda</label>
                            <div class="col-sm-10">
                            <textarea id="textarea_diskusi" class="form-control" name="doa_donatur" rows="3" placeholder="Semoga Berkah..."></textarea>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Metode Pembayaran <a data-bs-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i class="far fa-question-circle"></i></a></label>
                            <div class="col-sm-10">
                                <select class="form-select" aria-label="Default select example" required name="id_tipepembayaran" id="rekening_tujuan" required>
                                    <option value="">Pilih Metode Pembayaran</option>
                                    <?php foreach ($tipepembayaran as $x): ?>
                                    <option value="<?php echo $x->id_tipepembayaran ?>"><?php echo $x->rekening; ?> A/N <?php echo $x->atas_nama; ?> (<?php echo $x->nama_tipepembayaran; ?>)</option>
                                    <?php endforeach; ?>
                                </select>

                                <div class="collapse" id="collapseExample">
                                    <div class="card card-body">
                                        <p>Langkah Pembayaran</p>
                                        <p>1. Tentukan pilihan Anda, Berdonasi dengan menggunakan ATM atau menggunakan OVO</p>
                                        <p>2. Jika anda ingin berdonasi menggunakan ATM. anda cukup mentransfer uang donasi anda ke <u>No Rekening</u> yang tersedia pada form diatas</p>
                                        <p>3. Jika anda ingin bedonasi menggunakan OVO, Pastikan NoHp tujuan sesuai dengan form diatas</p>
                                        <p>4. Jangan Lupa foto bukti transfernya</p>
                                        <p>5. Lalu Upload Bukti transfer pada form upload bukti transfer yang terdapat dibawah</p>
                                        <p>6. Pastikan data isian form sudah benar lalu, Klik Tombol Donasi Sekarang, lalu admin akan mengkonfirmasi dana anda apakah sudah masuk atau belum max (1 x 24 jam) </p>
                                        <p>7. Selamat Anda berhasil melakukan donasi. Donasi anda akan bermanfaat bagi orang lain</p>
                                    </div>
                                </div>
                            </div>                    
                        </div>

                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Bukti Transfer </label>
                            <div class="col-sm-10">
                                <div class="drop-zone">
                                    <span class="drop-zone__prompt">Drag file atau Klik Kolom ini untuk upload bukti transfer</span>
                                    <input type="file" name="bukti_transfer" class="drop-zone__input" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                        <div class="callout callout-primary">
                            <h4>Pastikan Data Yang anda inputkan Sudah Benar</h4>
                            Admin perlu memeriksa data - data donasi yang anda sumbangkan, Proses ini memakan waktu max 1 x 24 Jam agar donasi anda terferivikasi. Terima kasih telah berdonasi, Donasi anda akan sangat bermanfaat bagi orang lain. 
                        </div>  
                            </div>
                        </div>

                        <button class="btn btn-primary" type="button" disabled style="float:right;" id="spinner">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Loading...
                        </button>        
                        <button class="btn btn-primary" type="submit" style="float: right;" id="tombol_submit">Donasi Sekarang</button>
                    </form>
                </section>
            </div>
            <?php $this->load->view('user/donasi/samping.php') ?>
            </div>
        </div>    
    </div>
</section>
