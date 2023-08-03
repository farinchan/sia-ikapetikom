<?php foreach ($data as $topik): ?>
<section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <ol>
                <li><a href="<?php echo base_url('main'); ?>">Home</a></li>
                <li><a href="<?php echo base_url('main/alumnilisttopik'); ?>">List Topik</a></li>
                <li><?php echo $topik->judul_topik ?></li>
            </ol><br>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Cari Diskusi" aria-label="Search"><br>
                <button class="btn btn-outline-info" type="submit">Cari</button>
            </form>
        </div>
    </div>
</section>
<section class="inner-page">
    <div class="container">
        <h2 style="margin-top: 0px;">Edit Topik</h2>
             
            <section id="team" class="team section-bg" style="background-color: white;" >
                <form id="form_edittopik" method="post">
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Kategori</label>
                        <div class="col-sm-10">
                            <select class="form-select" id="kategori_post" aria-label="Default select example" required name="kategori_topik">
                                <option value="">Pilih Kategori</option>
                                <?php foreach ($list_kategori as $list): ?>
                                <?php if($topik->id_kategoritopik == $list->id_kategoritopik){ ?>
                                <option selected value="<?php echo $list->id_kategoritopik; ?>">- <?php echo strtoupper($list->nama_kategoritopik); ?> - </option>
                                <?php }else{ ?>
                                <option value="<?php echo $list->id_kategoritopik; ?>">- <?php echo strtoupper($list->nama_kategoritopik); ?> - </option>
                                <?php } ?>
                                <?php endforeach; ?>
                            </select>
                            <small style="font-size: 12px;"><i>Untuk menambah kategori topik yang baru silahkan request ke admin</i></small>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Judul</label>
                        <div class="col-sm-10">
                            <input type="text" name="judul_topik" id="judul_post" class="form-control" required value="<?php echo $topik->judul_topik; ?>">
                        </div>
                    </div>
                    
                    <input type="hidden" name="id_topik" value="<?php echo $topik->id_topik; ?>">

                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Hak Akses</label>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="hak_akses" id="flexRadioDefault1" value="private" <?php if($topik->hak_akses == 'private'){ ?> checked <?php } ?>>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Private (Hanya Alumni Anda)
                                </label>
                                </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="hak_akses" id="flexRadioDefault2"  value="public" <?php if($topik->hak_akses == 'public'){ ?> checked <?php } ?>>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Public (Semua Alumni)
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status_topik" id="flexRadioDefault11" value="Y" <?php if($topik->status_topik == 'Y'){ ?> checked <?php } ?>>
                                <label class="form-check-label" for="flexRadioDefault11">
                                    Diskusi dibuka
                                </label>
                                </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status_topik" id="flexRadioDefault22"  value="N" <?php if($topik->status_topik == 'N'){ ?> checked <?php } ?>>
                                <label class="form-check-label" for="flexRadioDefault22">
                                    Diskusi ditutup
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Postingan Anda</label>
                        <div class="col-sm-10">
                            <textarea id="textarea_diskusi" class="form-control" name="isi_topik" rows="13" placeholder="Assalamualaikum..." required><?php echo $topik->isi_topik; ?></textarea>
                        </div>                    
                    </div>

                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Lampiran File </label>
                        <div class="col-sm-10">
                            <div class="drop-zone" style="height: 19px;">
                                <span class="drop-zone__prompt">Drag file atau Klik Kolom ini untuk upload file</span>
                                <input type="file" name="myFile" class="drop-zone__input">
                            </div>
                            <?php if($topik->lampiran_file != "kosong"){ ?>
                            <small style="font-size: 12px;">Lampiran File : <a href="<?php echo base_url('main/downloadfiletopik?data='.$topik->lampiran_file) ?>"><?php echo $topik->lampiran_file; ?></a></small><br>
                            <small style="font-size: 12px;">(*) Kosongkan Jika tidak ingin diubah</i></small>
                            <?php } ?>

                        </div>
                    </div>

                    <button class="btn btn-primary" type="submit" style="float: right;"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner"></span> Update</button>
                </form>
                <?php endforeach; ?>
            </section>

        </div>    
    </div>
</section>