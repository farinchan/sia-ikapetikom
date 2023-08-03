<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Galeri Kegiatan : <?php echo $nama_kegiatan; ?></h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active"> <?php echo $nama_kegiatan; ?></li>
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/ModulGaleri/data') ?>">Data Kegiatan</a></li>
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
                    Data Galeri : <?php echo $nama_kegiatan; ?>
                    <a href="<?php echo base_url('admin/ModulGaleri/tambahdetail/'.$this->uri->segment(4)) ?>" type="button" class="btn btn-primary btn-sm" style="float: right;">Tambah</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped" id="Galeri">
                        <thead>
                            <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama File</th>
                            <th scope="col">Type</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach ($data as $x): ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <?php if($x->type == "video"){ ?>
                                    <td><a href="<?php echo $x->file; ?>"><?php echo $x->file; ?></a></td>
                                <?php }else{ ?>
                                    <td><a href="<?php echo base_url('assets/galeri/'.$x->file) ?>"><?php echo $x->file; ?></a></td>
                                <?php } ?>
                                <td><?php echo $x->type; ?></td>
                                <?php if($x->type == "video"){ ?>
                                    <td><center><a href="<?php echo base_url('admin/ModulGaleri/editdetail/'.$this->uri->segment(4)."/".$x->id) ?>" ><span class="badge bg-primary"><i class="fas fa-edit"></i></span></a> <a href="<?php echo $x->file; ?>"><span class="badge bg-success"><i class="fas fa-eye"></i></span></a> <a href="<?php echo base_url('admin/ModulGaleri/hapus_videodetail/'.$this->uri->segment(4)."/".$x->id) ?>" onclick="return confirm('Anda yakin mau menghapus ini')"><span class="badge bg-danger"><i class="fas fa-trash"></i></span></a></center></td>
                                <?php }else{ ?>
                                    <td><center><a href="<?php echo base_url('admin/ModulGaleri/editdetail/'.$this->uri->segment(4)."/".$x->id)  ?>" ><span class="badge bg-primary"><i class="fas fa-edit"></i></span></a> <a href="<?php echo base_url('admin/modulgaleri/download/'.$x->file) ?>"><span class="badge bg-success"><i class="fas fa-download"></i></span></a> <a href="<?php echo base_url('admin/ModulGaleri/hapus_fotodetail/'.$this->uri->segment(4)."/".$x->id) ?>" onclick="return confirm('Anda yakin mau menghapus ini')"><span class="badge bg-danger"><i class="fas fa-trash"></i></span></a></center></td>
                                <?php } ?>
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