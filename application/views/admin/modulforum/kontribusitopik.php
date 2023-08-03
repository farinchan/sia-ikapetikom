<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Data Topik</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Data Topik</li>
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
                    Data Topik Diskusi
                    <a href="<?php echo base_url('admin/ModulForum/exportTopik') ?>" type="button" class="btn btn-secondary btn-sm" style="float: right;">Export</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped" id="list_topik">
                        <thead>
                            <tr>
                            <th scope="col">Nama Pembuat</th>
                            <th scope="col">Judul Topik</th>
                            <th scope="col">Tanggal Dibuat</th>
                            <th scope="col">Status</th>
                            <th scope="col">Total Dilihat</th>
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