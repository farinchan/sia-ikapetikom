<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Tahun Kelulusan</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Tambah Tahun Lulus</li>
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/ModulAlumni') ?>">Tahun Kelulusan</a></li>
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
                    <h6>Tambah Tahun Lulus</h6>
                </div>
                <div class="card-body">
                    <form id="tambah_tahun" method="post">
                        <div class="mb-3 row">
                            <label for="tahun_lulus" class="col-sm-2 col-form-label">Tahun Lulus</label>
                            <div class="col-sm-12">
                            <input type="number" class="form-control" required name="tahun_lulus">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner"></span>
                            Simpan
                        </button>
                    </form>
                </div>
                </div>
            </div>
            </div>
      </div>
    </div>
    </section>
</div>