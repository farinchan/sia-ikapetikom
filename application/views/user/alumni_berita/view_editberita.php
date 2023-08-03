<section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <ol>
                <li><a href="<?php echo base_url('main'); ?>">Home</a></li>
                <li><a href="<?php echo base_url('main/profil'); ?>">Dashboard Alumni</a></li>
                <li><a href="<?php echo base_url('main/berita'); ?>">List Berita</a></li>
                <li>Edit Berita</li>
            </ol>
            <?php $this->load->view('user/partisi/cariberita.php') ?>
        </div>
    </div>
</section>
<section class="inner-page">
    <div class="container">
        <h2 style="margin-top: -30px;">Edit Berita </h2>
        <div class="row">                

            <section id="team" class="team section-bg" style="background-color: white;" >
                <div data-aos="fade-up" style="margin-top: -20px;">    
                    <div class="card">
                        <div class="card-header" style="background-color: white;">
                            <ul class="navbar-nav" style="float: right;">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: black;">
                                        Menu Berita
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink">
                                        <li><a class="dropdown-item" href="<?php echo base_url('main/berita'); ?>">List Berita</a></li>
                                        <li><a class="dropdown-item active" href="<?php echo base_url('main/tambahberita'); ?>">Tambah Berita</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                        
                            <form id="editberita_form" method="post">
                                <?php foreach ($berita as $x): ?>
                                <div class="mb-3 row">
                                    <label for="nama_alumni" class="col-lg-2 col-form-label" >Judul Berita</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nama_alumni" name="judul_berita" placeholder="Judul Berita" required value="<?php echo $x->judul_berita; ?>">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="nama_alumni" class="col-sm-2 col-form-label">Pilih Kategori Berita</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" aria-label="Default select example" required name="id_kategoriberita" id="tahun_lulus">
                                            <option value="">Pilih Kategori Berita</option>
                                            <?php foreach ($list_kategoriberita as $list): ?>
                                            <?php if($list->id_kategoriberita == $x->id_kategoriberita){ ?>
                                            <option selected value="<?php echo $list->id_kategoriberita; ?>"><?php echo $list->nama_kategoriberita ?></option>
                                            <?php }else{ ?>
                                            <option value="<?php echo $list->id_kategoriberita; ?>"><?php echo $list->nama_kategoriberita ?></option>
                                            <?php } ?>
                                            <?php endforeach; ?>
                                        </select>
                                        <small style="font-size: 12px;"><i>Request ke admin jika ingin menambahkan kategori berita baru</i></small>
                                    </div>
                                </div>

                                <input type="hidden" name="id_berita" value="<?php echo $x->id_berita; ?>">

                                <div class="mb-3 row">
                                    <label for="nama_alumni" class="col-sm-2 col-form-label">Isi Berita</label>
                                    <div class="col-sm-10">
                                        <textarea id="isi_berita" class="form-control" name="isi_berita" rows="10" required><?php echo $x->isi_berita ?></textarea>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="nama_alumni" class="col-sm-2 col-form-label">Gambar</label>
                                    <div class="col-sm-10">
                                        <div class="drop-zone">
                                            <span class="drop-zone__prompt">Drag Gambar atau Klik kolom ini</span>
                                            <input type="file" name="myFile" class="drop-zone__input">
                                        </div>
                                        <small style="font-size: 12px;"><i>Gambar Terpasang : <a href="<?php echo base_url('assets/berita/'.$x->gambar_berita) ?>" target="__BLANK"><?php echo $x->gambar_berita; ?></a> </i></small>
                                    </div>
                                </div>

                                 <?php endforeach; ?>               
                                <button type="submit" class="btn btn-primary" style="float: right;"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner"></span> Update</button>
                            </form>

                        </div>
                    </div>
                </div>
            </section>  
                     
         </div>
        </div>    
    </div>
</section>