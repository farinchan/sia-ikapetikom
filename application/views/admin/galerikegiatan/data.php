<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Daftar Kegiatan</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Daftar Kegiatan</li>
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
                    Daftar Kegiatan
                    <a href="<?php echo base_url('admin/ModulGaleri/tambahkegiatan') ?>" type="button" class="btn btn-primary btn-sm" style="float: right;">Tambah</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped" id="Galeri">
                        <thead>
                            <tr>
                            <th scope="col">No</th>
                            <th scope="col">Judul Kegiatan</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach ($data as $x): ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $x->judul_kegiatan ?></td>
                                <td><center><a href="<?php echo base_url('admin/ModulGaleri/editkegiatan/'.$x->id_galeri)  ?>" ><span class="badge bg-primary"><i class="fas fa-edit"></i></span></a> <a href="<?php echo base_url('admin/ModulGaleri/detail/'.$x->id_galeri)  ?>"><span class="badge bg-success"><i class="fas fa-eye"></i></span></a> <a href="<?php echo base_url('admin/ModulGaleri/hapuskegiatan/'.$x->id_galeri) ?>" onclick="return confirm('Anda yakin mau menghapus ini')"><span class="badge bg-danger"><i class="fas fa-trash"></i></span></a></center></td>
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