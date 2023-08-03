<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Data Donasi Selesai</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Data Donasi Selesai</li>
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
                Data Donasi Selesai
                <a href="<?php echo base_url('admin/ModulDonasi/exportDonasiSelesai') ?>" type="button" class="btn btn-secondary btn-sm" style="float: right;">Export</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped" id="DonasiSelesai">
                        <thead>
                            <tr>
                            <th scope="col">Judul Donasi</th>
                            <th scope="col">Success</th>
                            <th scope="col">Process</th>
                            <th scope="col">Ditolak</th>
                            <th scope="col">Target Dana</th>
                            <th scope="col">Terkumpul</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
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