<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Edit Kategori Topik</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Edit Kategori</li>
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/ModulForum/kategori') ?>">Kategori Topik</a></li>
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
                    <h6>Edit Kategori</h6>
                </div>
                <div class="card-body">
                    <?php foreach ($data as $x): ?>
                    <form id="edit_kategoritopik" method="post">
                        <div class="mb-3 row">
                            <label for="tahun_lulus" class="col-sm-2 col-form-label">Edit Kategori Topik</label>
                            <div class="col-sm-12">
                            <input type="text" class="form-control" required name="nama_kategoritopik" value="<?php echo $x->nama_kategoritopik; ?>">
                            </div>
                            <input type="hidden" name="id_kategoritopik" value="<?php echo $x->id_kategoritopik; ?>">
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner"></span>
                            Update
                        </button>
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