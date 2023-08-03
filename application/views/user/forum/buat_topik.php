<section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <ol>
                <li><a href="<?php echo base_url('main') ?>">Home</a></li>
                <li>Buat Topik baru</li>
            </ol>
            <?php $this->load->view('user/partisi/cariberita.php') ?>
        </div>
    </div>
</section>
<section class="inner-page">
    <div class="container">
        <h2 style="margin-top: 0px;">Buat Topik Baru</h2>
        <div class="row">                
            <div class="col-sm-8" >                
                <section id="team" class="team section-bg" style="background-color: white;" >
                    <form id="form_tambahtopik" method="post">
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Kategori</label>
                            <div class="col-sm-10">
                                <select class="form-select" id="kategori_post" aria-label="Default select example" required name="kategori_topik">
                                    <option value="">Pilih Kategori</option>
                                    <?php foreach ($list_kategori as $list): ?>
                                    <option value="<?php echo $list->id_kategoritopik; ?>">- <?php echo strtoupper($list->nama_kategoritopik); ?> - </option>
                                    <?php endforeach; ?>
                                </select>
                                <small style="font-size: 12px;"><i>Untuk menambah kategori topik yang baru silahkan request ke admin</i></small>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Judul</label>
                            <div class="col-sm-10">
                                <input type="text" name="judul_topik" id="judul_post" class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Hak Akses</label>
                            <div class="col-sm-10">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="hak_akses" id="flexRadioDefault1" value="private">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Private (Hanya Alumni Anda)
                                    </label>
                                    </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="hak_akses" id="flexRadioDefault2" checked value="public">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Public (Semua Alumni)
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Postingan Anda</label>
                            <div class="col-sm-10">
                                <textarea id="textarea_diskusi" class="form-control" name="isi_topik" rows="13" placeholder="Assalamualaikum..." required></textarea>
                            </div>                    
                        </div>

                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Lampiran File </label>
                            <div class="col-sm-10">
                                <div class="drop-zone" style="height: 19px;">
                                    <span class="drop-zone__prompt">Drag file atau Klik Kolom ini untuk upload file</span>
                                    <input type="file" name="myFile" class="drop-zone__input">
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-primary" type="submit" style="float: right;"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner"></span> Posting</button>
                    </form>

                </section>
            </div>
            
            <?php $this->load->view('user/forum/info_topik.php'); ?>

            </div>
        </div>    
    </div>
</section>