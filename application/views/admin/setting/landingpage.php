<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Landing Page</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Landing Page</li>
            </ol>
            </div>
        </div>
        </div>
    </div>

    <section class="content">
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Default box -->
                <div class="card">
                <div class="card-header">
                    Edit Banner Ke -1
                </div>
                <div class="card-body">
                    <?php foreach ($data as $x): ?>
                    <form id="edit_banner1" method="post">
                        <div class="mb-3 row">
                            <label for="nama_alumni" class="col-lg-2 col-form-label" >Caption Banner</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="sub1" name="sup_1" value="<?php echo $x->sup_1; ?>"  required>
                            </div>
                        </div>

                    <div class="mb-3 row" id="foto_galeri">
                        <label for="nama_alumni" class="col-sm-2 col-form-label">Gambar</label>
                        <div class="col-sm-10">
                            <div class="drop-zone">
                                <span class="drop-zone__prompt">Kosongkan Kolom Ini Jika Gak diubah</span>
                                <input type="file" id="gambar" name="myFile" class="drop-zone__input">
                            </div>
                            <small style="font-size: 12px;"><i>Banner : <a href="<?php echo base_url('assets/img/banner/'.$x->lp_1) ?>" target="__BLANK"><?php echo $x->lp_1; ?></a> </i></small>
                        </div>
                    </div>

                        <button type="submit" class="btn btn-primary" style="float: right;"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner1"></span> Update</button>
                    </form>
                    <?php endforeach; ?>
                </div>
                </div>


                <div class="card">
                <div class="card-header">
                    Edit Banner Ke -2
                </div>
                <div class="card-body">
                    <?php foreach ($data as $x): ?>
                    <form id="edit_banner2" method="post">
                        <div class="mb-3 row">
                            <label for="nama_alumni" class="col-lg-2 col-form-label" >Caption Banner</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="sup_2" name="sup_2" value="<?php echo $x->sup_2; ?>"  required>
                            </div>
                        </div>
                    <div class="mb-3 row" id="foto_galeri">
                        <label for="nama_alumni" class="col-sm-2 col-form-label">Gambar</label>
                        <div class="col-sm-10">
                            <div class="drop-zone">
                                <span class="drop-zone__prompt">Kosongkan Kolom Ini Jika Gak diubah</span>
                                <input type="file" id="gambar" name="myFile" class="drop-zone__input">
                            </div>
                            <small style="font-size: 12px;"><i>Banner : <a href="<?php echo base_url('assets/img/banner/'.$x->lp_2) ?>" target="__BLANK"><?php echo $x->lp_2; ?></a> </i></small>
                        </div>
                    </div>

                        <button type="submit" class="btn btn-primary" style="float: right;"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner2"></span> Update</button>
                    </form>
                    <?php endforeach; ?>
                </div>
                </div>

                <div class="card">
                <div class="card-header">
                    Edit Banner Ke -3
                </div>
                <div class="card-body">
                    <?php foreach ($data as $x): ?>
                    <form id="edit_banner3" method="post">
                        <div class="mb-3 row">
                            <label for="nama_alumni" class="col-lg-2 col-form-label" >Caption Banner</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="sub3" name="sup_3" value="<?php echo $x->sup_3; ?>"  required>
                            </div>
                        </div>
                    <div class="mb-3 row" id="foto_galeri">
                        <label for="nama_alumni" class="col-sm-2 col-form-label">Gambar</label>
                        <div class="col-sm-10">
                            <div class="drop-zone">
                                <span class="drop-zone__prompt">Kosongkan Kolom Ini Jika Gak diubah</span>
                                <input type="file" id="gambar" name="myFile" class="drop-zone__input">
                            </div>
                            <small style="font-size: 12px;"><i>Banner : <a href="<?php echo base_url('assets/img/banner/'.$x->lp_3) ?>" target="__BLANK"><?php echo $x->lp_3; ?></a> </i></small>
                        </div>
                    </div>

                        <button type="submit" class="btn btn-primary" style="float: right;"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner3"></span> Update</button>
                    </form>
                    <?php endforeach; ?>
                </div>
                </div>
            </div>
            </div>
      </div>
    </div>
    </section>
</div>