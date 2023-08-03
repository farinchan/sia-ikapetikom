<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Data Alumni</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Data Alumni</li>
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
                    <h6>Data Seluruh Alumni</h6>
                </div>
                <div class="card-body">
                    <div class="btn-group mb-3" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modal-default">Import</button>
                        <a href="<?php echo base_url('admin/ModulAlumni/exportalumni') ?>" type="button" class="btn btn-secondary btn-sm">Export</a>
                    </div>
                    <table class="table table-bordered table-striped" id="list_alumni">
                        <thead>
                            <tr>
                                <th scope="col">NIA</th>
                                <th scope="col">Nama Alumni</th>
                                <th scope="col">Kelulusan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Satuan Kerja / Kampus</th>
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

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Import Excel</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="excel" method="post">
        <div class="modal-body">
          <div class="form-group">
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="customFile" name="excel" required accept=".xls, .xlsx">
              <label class="custom-file-label" for="customFile">Klik disini</label>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" type="button" disabled id="spinner">
              Loading...
          </button>  
          <button type="submit" class="btn btn-primary" id="submit">Import</button>
        </div>
        </form>
      </div>
    </div>
  </div>