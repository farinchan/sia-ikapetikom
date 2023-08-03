<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Tambah Berita</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Tambah Berita</li>
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/ModulBerita/berita') ?>">Berita</a></li>
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
                    Tambah Berita
                </div>
                <div class="card-body">

                <form id="tambah_beritaform" method="post">
                    <div class="mb-3 row">
                        <label for="nama_alumni" class="col-lg-2 col-form-label" >Judul Berita</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama_alumni" name="judul_berita" placeholder="Judul Berita" required>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama_alumni" class="col-sm-2 col-form-label">Pilih Kategori Berita</label>
                        <div class="col-sm-10">
                            <select class="form-control" aria-label="Default select example" required name="id_kategoriberita" id="tahun_lulus">
                                <option value="">Pilih Kategori Berita</option>
                                <?php foreach ($list_kategoriberita as $list): ?>
                                <option value="<?php echo $list->id_kategoriberita; ?>"><?php echo $list->nama_kategoriberita ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama_alumni" class="col-sm-2 col-form-label">Status Berita</label>
                        <div class="col-sm-10">
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="status_berita" id="flexRadioDefault11" value="Y" required>
                                <label class="custom-control-label" for="flexRadioDefault11" style="font-weight: normal;">
                                    Published
                                </label>
                                </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="status_berita" id="flexRadioDefault22" value="N" required>
                                <label class="custom-control-label" for="flexRadioDefault22" style="font-weight: normal;">
                                    Unpublished
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama_alumni" class="col-sm-2 col-form-label">Isi Berita</label>
                        <div class="col-sm-10">
                            <textarea id="isi_berita" class="form-control" name="isi_berita" rows="10"></textarea>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama_alumni" class="col-sm-2 col-form-label">Gambar</label>
                        <div class="col-sm-10">
                            <div class="drop-zone">
                                <span class="drop-zone__prompt">Drag Gambar atau Klik kolom ini</span>
                                <input type="file" name="myFile" class="drop-zone__input">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary" style="float: right;"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner"></span> Simpan</button>
                </form>

                </div>
                </div>
            </div>
            </div>
      </div>
    </div>
    </section>
</div>