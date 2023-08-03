<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Profil</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Profil Saya</li>
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
                    Edit Profil saya
                </div>
                <div class="card-body">
                    <?php foreach ($data as $x): ?>
                    <form id="edit_admin" method="post">
                        <div class="mb-3 row">
                            <label for="nama_alumni" class="col-lg-2 col-form-label" >Nama Admin</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama_admin" name="nama_admin" value="<?php echo $x->nama_admin; ?>"  required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="nama_alumni" class="col-lg-2 col-form-label" >Email Admin</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email_admin" name="email_admin" value="<?php echo $x->email_admin; ?>" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="nama_alumni" class="col-lg-2 col-form-label" >Username</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="username" name="username" value="<?php echo $x->username; ?>" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="nama_alumni" class="col-lg-2 col-form-label" >Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Kosongkan Jika Gak diubah">
                            </div>
                        </div>

                    <div class="mb-3 row" id="foto_galeri">
                        <label for="nama_alumni" class="col-sm-2 col-form-label">Foto</label>
                        <div class="col-sm-10">
                            <div class="drop-zone">
                                <span class="drop-zone__prompt">Kosongkan Kolom Ini Jika Gak diubah</span>
                                <input type="file" id="gambar" name="myFile" class="drop-zone__input">
                            </div>
                        </div>
                    </div>

                        <button type="submit" class="btn btn-primary" style="float: right;"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner"></span> Update</button>
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