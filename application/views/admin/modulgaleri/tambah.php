<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Tambah Galeri</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Tambah Galeri</li>
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
                    Form Tambah Galeri
                </div>
                <div class="card-body">
                    <form id="tambah_galeri" method="post">
                        <div class="mb-3 row">
                            <label for="nama_alumni" class="col-lg-2 col-form-label" >Judul Kegiatan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama_tipepembayaran" name="judul_kegiatan" placeholder="Contoh : Kegiatan Buka Bersama, dll" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                        <label for="nama_alumni" class="col-sm-2 col-form-label">Type</label>
                        <div class="col-sm-10">
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="type" id="flexRadioDefault1" required value="foto" checked>
                                <label class="custom-control-label" for="flexRadioDefault1" style="font-weight: normal;">
                                    Foto
                                </label>
                                </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="type" id="flexRadioDefault2" required value="video">
                                <label class="custom-control-label" for="flexRadioDefault2" style="font-weight: normal;">
                                    Video
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 row" id="video_galeri">
                        <label for="nama_alumni" class="col-sm-2 col-form-label">Link Youtube</label>
                        <div class="col-sm-10">
                            <textarea id="video_galeri" class="form-control" name="file" rows="4" placeholder="Masukkan Link Youtube"></textarea>
                        </div>
                    </div>

                    <div class="mb-3 row" id="foto_galeri">
                        <label for="nama_alumni" class="col-sm-2 col-form-label">Foto</label>
                        <div class="col-sm-10">
                            <div class="drop-zone">
                                <span class="drop-zone__prompt">Drag Foto atau Klik kolom ini</span>
                                <input type="file" id="foto_galeri" name="myFile" class="drop-zone__input">
                            </div>
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