<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Tahun Kelulusan</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Tahun Kelulusan</li>
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
                    <a class="btn btn-primary" href="<?php echo base_url('admin/ModulAlumni/tambahtahunlulus') ?>" role="button">Tambah Data</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped" id="TahunLulus">
                        <thead>
                            <tr>
                            <th scope="col">No</th>
                            <th scope="col">Tahun Lulus</th>
                            <th scope="col">Total Alumni</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach ($tahun_lulus as $x): ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $x->tahun_lulus; ?></td>
                                <td><?php echo $x->total_alumni; ?></td>
                                <td><a href="<?php echo base_url('admin/ModulAlumni/hapustahunlulus/'.$x->tahun_lulus) ?>" onclick="return confirm('Yakin Mau Menghapus Data ini ?')"><span class="badge badge-danger"><i class="fas fa-trash"></i></span></a></td>
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