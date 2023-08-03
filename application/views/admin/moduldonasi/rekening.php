<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Data Rekening</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Data Rekening</li>
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
                    <a href="<?php echo base_url('admin/ModulDonasi/tambahrekening') ?>" type="button" class="btn btn-primary">Tambah</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped" id="Rekening">
                        <thead>
                            <tr>
                            <th scope="col">Jenis Pembayaran</th>
                            <th scope="col">No Rekening</th>
                            <th scope="col">Atas Nama</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $x): ?>
                            <tr>
                                <td><?php echo $x->nama_tipepembayaran ?></td>
                                <td><?php echo $x->rekening; ?></td>
                                <td><?php echo $x->atas_nama; ?></td>
                                <td><center><a href="<?php echo base_url('admin/ModulDonasi/editrekening/'.$x->id_tipepembayaran) ?>" ><span class="badge bg-primary"><i class="fas fa-edit"></i></span></a> <a href="<?php echo base_url('admin/ModulDonasi/hapusrekening/'.$x->id_tipepembayaran) ?>" onclick="return confirm('Anda yakin mau menghapus ini')"><span class="badge bg-danger"><i class="fas fa-trash"></i></span></a></center></td>
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