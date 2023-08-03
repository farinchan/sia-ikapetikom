<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Tambah Kegiatan</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Tambah Kegiatan</li>
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/ModulGaleri/data') ?>">Data Kegiatan</a></li>
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
                    Form Tambah Kegiatan
                </div>
                <div class="card-body">
                    <form id="tambah_kegiatan" method="post">
                        <div class="mb-3 row">
                            <label for="nama_alumni" class="col-lg-2 col-form-label" >Judul Kegiatan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="judul_kegiatan" name="judul_kegiatan" placeholder="Contoh : Kegiatan Buka Bersama, dll" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" style="float: right;"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner"></span> Tambah</button>
                    </form>
                </div>
                </div>
            </div>
            </div>
      </div>
    </div>
    </section>
</div>