<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Kategori Donasi</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Kategori Donasi</li>
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
                    <a href="<?php echo base_url('admin/ModulDonasi/tambahkategori'); ?>" type="button" class="btn btn-primary">Tambah</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped" id="KategoriDonasi">
                        <thead>
                            <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Kategori</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach ($data as $x): ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $x->nama_kategoridonasi; ?></td>
                                <td><a href="<?php echo base_url('admin/ModulDonasi/editkategori/'.$x->id_kategoridonasi) ?>" ><span class="badge bg-primary"><i class="fas fa-edit"></i></span></a> <a href="<?php echo base_url('admin/ModulDonasi/hapuskategori/'.$x->id_kategoridonasi) ?>" onclick="return confirm('Yakin Mau Menghapus Kategori Ini')"><span class="badge bg-danger"><i class="fas fa-trash"></i></span></a> </td>
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