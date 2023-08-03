<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0"> Tambah Galeri Kegiatan : <?php echo $nama_kegiatan; ?></h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active"> <?php echo "Edit Galeri Kegiatan : ".$nama_kegiatan; ?></li>
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/ModulGaleri/detail/'.$this->uri->segment(4)) ?>"><?php echo $nama_kegiatan; ?></a></li>
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
                    Form Edit Galeri
                </div>
                <div class="card-body">
                    <?php foreach ($data as $x): ?>
                    <form id="edit_detail" method="post">
                    
                    <input type="hidden" name="id_galeri" value="<?php echo $this->uri->segment(4); ?>">
                    <input type="hidden" name="id" value="<?php echo $this->uri->segment(5); ?>">
                    <input type="hidden" name="type" value="<?php echo $x->type; ?>">

                    <?php if($x->type == "video"){ ?>

                    <div class="mb-3 row" id="video_galeri">
                        <label for="nama_alumni" class="col-sm-2 col-form-label">Link Youtube</label>
                        <div class="col-sm-10">
                            <textarea id="video_galeri" class="form-control" name="file" rows="4" placeholder="Masukkan Link Youtube"><?php echo $x->file; ?></textarea>
                        </div>
                    </div>

                    <?php }else{ ?>

                    <div class="mb-3 row" id="foto_galeri">
                        <label for="nama_alumni" class="col-sm-2 col-form-label">Foto</label>
                        <div class="col-sm-10">
                            <div class="drop-zone">
                                <span class="drop-zone__prompt">Drag Foto atau Klik kolom ini</span>
                                <input type="file" id="foto_galeri" name="myFile" class="drop-zone__input">
                            </div>
                            <small style="font-size: 12px;"><i>Gambar Terpasang : <a href="<?php echo base_url('assets/galeri/'.$x->file) ?>" target="__BLANK"><?php echo $x->file; ?></a> </i></small>
                        </div>
                    </div>
                    
                    <?php } ?>
                        <button type="submit" class="btn btn-primary" style="float: right;"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner"></span> Update</button>
                    </form>
                    <?php endforeach; ?>
                </div>
                </div>
            </div>
            </div>
      </div>
    </div>
    </section>
</div>