<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Tambah Donasi</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Tambah Donasi</li>
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
                    <h6>Silahkan Isi Form Dibawah</h6>
                </div>
                <div class="card-body">

                    <form id="tambah_donasi" method="post">
                        <div class="mb-3 row">
                            <label for="nama_alumni" class="col-lg-2 col-form-label" >Judul Donasi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama_alumni" name="judul_donasi" placeholder="Judul Donasi" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="nama_alumni" class="col-sm-2 col-form-label">Pilih Kategori Donasi</label>
                            <div class="col-sm-10">
                                <select class="form-control" aria-label="Default select example" required name="id_kategoridonasi" id="tahun_lulus">
                                    <option value="">Pilih Kategori Donasi</option>
                                    <?php foreach ($list_kategoridonasi as $list): ?>
                                    <option value="<?php echo $list->id_kategoridonasi; ?>"><?php echo $list->nama_kategoridonasi ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="nama_alumni" class="col-sm-2 col-form-label">Target Dana</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="target_dana" id="nominal_donasi" required placeholder="Rp 0">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="nama_alumni" class="col-sm-2 col-form-label">Donasi Dibuka</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" name="donasi_dibuka" id="donasi_dibuka" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="nama_alumni" class="col-sm-2 col-form-label">Donasi Ditutup</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" name="donasi_ditutup" id="donasi_ditutup" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="nama_alumni" class="col-sm-2 col-form-label">Detail Program</label>
                            <div class="col-sm-10">
                                <textarea id="detail_program" class="form-control" name="detail_program" rows="10" required placeholder="Tuliskan Program Donasi"></textarea>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="nama_alumni" class="col-sm-2 col-form-label">Gambar thumbnail</label>
                            <div class="col-sm-10">
                                <div class="drop-zone">
                                    <span class="drop-zone__prompt">Drag Gambar atau Klik kolom ini</span>
                                    <input type="file" name="myFile" class="drop-zone__input" required>
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

<script>
    var fnf = document.getElementById("nominal_donasi");
fnf.addEventListener('keyup', function(evt){
    var n = parseInt(this.value.replace(/\D/g,''),10);
    fnf.value = n.toLocaleString();
}, false);
</script>