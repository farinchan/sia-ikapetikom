<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Pengaturan Website</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Pengaturan Website</li>
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
                    Edit Data Website
                </div>
                <div class="card-body">
                <?php foreach ($data as $x): ?>
                <form id="edit_website" method="post">
                    <div class="mb-3 row">
                        <label for="nama_website" class="col-lg-2 col-form-label" >Nama Website</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama_website" name="nama_website" required value="<?php echo $x->nama_website; ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama_website" class="col-lg-2 col-form-label" >Email Website</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" name="email" required value="<?php echo $x->email; ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama_website" class="col-lg-2 col-form-label" >No WA</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="no_wa" name="no_wa" required value="<?php echo $x->no_wa; ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama_website" class="col-lg-2 col-form-label" >Link Facebook</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="facebook" name="facebook" required value="<?php echo $x->facebook; ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama_website" class="col-lg-2 col-form-label" >Link Instagram</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="instagram" name="instagram" required value="<?php echo $x->instagram; ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama_website" class="col-lg-2 col-form-label" >Footer</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="footer" name="footer" required value="<?php echo $x->footer; ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama_alumni" class="col-sm-2 col-form-label">Syarat Dan Ketentuan</label>
                        <div class="col-sm-10">
                            <textarea id="detail_program" class="form-control" name="syarat" rows="10" required><?php echo $x->syarat; ?></textarea>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama_alumni" class="col-sm-2 col-form-label">Tentang Alumni</label>
                        <div class="col-sm-10">
                            <textarea id="detail_program" class="form-control" name="tentang" rows="10" required><?php echo $x->tentang; ?></textarea>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama_alumni" class="col-sm-2 col-form-label">Logo</label>
                        <div class="col-sm-10">
                            <div class="drop-zone">
                                <span class="drop-zone__prompt">Drag Gambar atau Klik kolom ini</span>
                                <input type="file" name="myFile" class="drop-zone__input">
                            </div>
                            <small style="font-size: 12px;"><i>Logo Terpasang : <a href="<?php echo base_url('assets/img/'.$x->logo) ?>" target="__BLANK"><?php echo $x->logo; ?></a> </i></small>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary" style="float: right;"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner"></span> Edit</button>
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