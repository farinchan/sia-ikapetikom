<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Donasi : <?php echo $namadonasi; ?></h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Success Diproses</li>
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/ModulDonasi/kontribusi') ?>">Kontribusi Donasi</a></li>
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
                    Data Donatur Sudah Diproses
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped" id="SuksesDonasi">
                        <thead>
                            <tr>
                            <th scope="col">No</th>
                            <th scope="col">Donatur</th>
                            <th scope="col">Taggal Donasi</th>
                            <th scope="col">Nominal</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach ($data as $x): ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $x->nama_alumni ?></td>
                                <td><?php echo $x->tanggal_bayar; ?></td>
                                <td><?php echo "Rp. ".number_format($x->total_donasi, 2, ',', '.'); ?></td>
                                <td><a href="<?php echo base_url('admin/ModulDonasi/detail/'.$x->id_donasi.'/'.$x->id_transaksi) ?>"><span class="badge bg-primary">Lihat</a></td>
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