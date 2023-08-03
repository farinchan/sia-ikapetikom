<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Galeri Foto</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Galeri Foto</li>
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
                    Galeri Foto
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped" id="Foto">
                        <thead>
                            <tr>
                            <th scope="col">Judul Kegiatan</th>
                            <th scope="col">Type</th>
                            <th scope="col">Nama File</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $x): ?>
                            <tr>
                                <td><?php echo $x->judul_kegiatan ?></td>
                                <td><?php echo $x->type; ?></td>
                                <td><a href="<?php echo base_url('assets/galeri/'.$x->file) ?>"><?php echo $x->file; ?></a></td>
                                <td><center><a href="<?php echo base_url('admin/modulgaleri/edit/'.$x->id) ?>" ><span class="badge bg-primary"><i class="fas fa-edit"></i></span></a> <a href="<?php echo base_url('admin/modulgaleri/download/'.$x->file) ?>" ><span class="badge bg-success"><i class="fas fa-download"></i></span></a> <a href="<?php echo base_url('admin/modulgaleri/hapus_foto/'.$x->id) ?>" onclick="return confirm('Anda yakin mau menghapus ini')"><span class="badge bg-danger"><i class="fas fa-trash"></i></span></a></center></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
            </div>
      </div>
    </div>
    </section>
</div>