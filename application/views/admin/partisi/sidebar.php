<aside class="main-sidebar sidebar-dark-primary elevation-4">
<!-- Brand Logo -->
<a href="<?php echo base_url('admin/dashboard') ?>" class="brand-link">
    <img src="<?php echo base_url('assets/admin/') ?>dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Hallo Admin</span>
</a>

<?php foreach ($profil as $x): ?>
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
        <img src="<?php echo base_url('assets/admin/profil/'.$x->gambar) ?>" class="img-circle elevation-2" alt="User Image">
    </div>
    <div class="info">
        <a href="#" class="d-block"><?php echo $x->nama_admin; ?></a>
    </div>
    </div>
<?php endforeach; ?>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <?php if($this->session->flashdata('location') == "Dashboard"){ ?>
                <a href="<?php echo base_url('admin/dashboard') ?>" class="nav-link active">
            <?php }else{ ?>
                <a href="<?php echo base_url('admin/dashboard') ?>" class="nav-link">
            <?php } ?>
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                Dashboard
                </p>
            </a>
        </li>

        <?php if($this->session->flashdata('location') == "Tahun Lulus" || $this->session->flashdata('location') == "Tambah Tahun Lulus" || $this->session->flashdata('location') == "Data Alumni" || $this->session->flashdata('location') == "Lihat Alumni" || $this->session->flashdata('location') == "Acc Alumni" || $this->session->flashdata('location') == "Tambah Alumni"){ ?>
        <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
        <?php }else{ ?>
        <li class="nav-item">
            <a href="#" class="nav-link">
        <?php } ?>
                <i class="nav-icon fas fa-users"></i>
                <p>
                Modul Alumni

                <i class="right fas fa-angle-left"></i>
                <?php if($total_alumni_acc != 0){ ?>
                    <span class="badge badge-info right">New</span>
                <?php } ?>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <?php if($this->session->flashdata('location') == "Tahun Lulus" || $this->session->flashdata('location') == "Tambah Tahun Lulus"){ ?>
                    <a href="<?php echo base_url('admin/ModulAlumni') ?>" class="nav-link active">
                <?php }else{ ?>
                    <a href="<?php echo base_url('admin/ModulAlumni') ?>" class="nav-link">
                <?php } ?>
                    <i class="far fa-circle nav-icon"></i>
                    <p>Tahun Kelulusan</p>
                </a>
                </li>
                <li class="nav-item">
                <?php if($this->session->flashdata('location') == "Tambah Alumni"){ ?>
                    <a href="<?php echo base_url('admin/ModulAlumni/tambahalumni') ?>" class="nav-link active">
                <?php }else{ ?>
                    <a href="<?php echo base_url('admin/ModulAlumni/tambahalumni') ?>" class="nav-link">
                <?php } ?>
                        <i class="far fa-circle nav-icon"></i>
                        <p>Tambah Alumni</p>
                    </a>
                </li>
                <li class="nav-item">
                <?php if($this->session->flashdata('location') == "Data Alumni" || $this->session->flashdata('location') == "Lihat Alumni"){ ?>
                    <a href="<?php echo base_url('admin/ModulAlumni/data') ?>" class="nav-link active">
                <?php }else{ ?>
                    <a href="<?php echo base_url('admin/ModulAlumni/data') ?>" class="nav-link">
                <?php } ?>
                        <i class="far fa-circle nav-icon"></i>
                        <p>Data Alumni</p>
                    </a>
                </li>
                <li class="nav-item">
                <?php if($this->session->flashdata('location') == "Acc Alumni"){ ?>
                    <a href="<?php echo base_url('admin/ModulAlumni/acc') ?>" class="nav-link active">
                <?php }else{ ?>
                    <a href="<?php echo base_url('admin/ModulAlumni/acc') ?>" class="nav-link">
                <?php } ?>
                        <i class="far fa-circle nav-icon"></i>
                        <p>Acc Alumni </p>
                        <?php if($total_alumni_acc != 0){ ?>
                        <span class="badge badge-info right"><?php echo $total_alumni_acc; ?></span>
                        <?php } ?>
                    </a>
                </li>
            </ul>
        </li>


        <?php if($this->session->flashdata('location') == "Kategori Berita" || $this->session->flashdata('location') == "ListBerita" || $this->session->flashdata('location') == "TambahBerita" || $this->session->flashdata('location') == "KontribusiBerita"){ ?>
        <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
        <?php }else{ ?>
        <li class="nav-item">
            <a href="#" class="nav-link">
        <?php } ?>
                <i class="fas fa-newspaper nav-icon"></i>
                <p>
                Modul Berita
                <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <?php if($this->session->flashdata('location') == "Kategori Berita"){ ?>
                    <a href="<?php echo base_url('admin/ModulBerita/kategori') ?>" class="nav-link active">
                <?php }else{ ?>
                    <a href="<?php echo base_url('admin/ModulBerita/kategori') ?>" class="nav-link">
                <?php } ?>
                    <i class="far fa-circle nav-icon"></i>
                    <p>Kategori Berita</p>
                </a>
                </li>

                <li class="nav-item">
                <?php if($this->session->flashdata('location') == "ListBerita"){ ?>
                    <a href="<?php echo base_url('admin/ModulBerita/berita') ?>" class="nav-link active">
                <?php }else{ ?>
                    <a href="<?php echo base_url('admin/ModulBerita/berita') ?>" class="nav-link">
                <?php } ?>
                    <i class="far fa-circle nav-icon"></i>
                    <p>Berita</p>
                </a>
                </li>

                <li class="nav-item">
                <?php if($this->session->flashdata('location') == "TambahBerita"){ ?>
                    <a href="<?php echo base_url('admin/ModulBerita/tambahberita') ?>" class="nav-link active">
                <?php }else{ ?>
                    <a href="<?php echo base_url('admin/ModulBerita/tambahberita') ?>" class="nav-link">
                <?php } ?>
                    <i class="far fa-circle nav-icon"></i>
                    <p>Tambah Berita</p>
                </a>
                </li>

                <li class="nav-item">
                <?php if($this->session->flashdata('location') == "KontribusiBerita"){ ?>
                    <a href="<?php echo base_url('admin/ModulBerita/kontribusi') ?>" class="nav-link active">
                <?php }else{ ?>
                    <a href="<?php echo base_url('admin/ModulBerita/kontribusi') ?>" class="nav-link">
                <?php } ?>
                    <i class="far fa-circle nav-icon"></i>
                    <p>Kontribusi Berita</p>
                    <?php if($beritabelumacc != 0){ ?>
                    <span class="badge badge-info right"><?php echo $beritabelumacc; ?></span>
                    <?php } ?>
                </a>
                </li>
            </ul>


        <?php if($this->session->flashdata('location') == "Kategori Topik" || ($this->session->flashdata('location') == "Data Topik")){ ?>
        <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
        <?php }else{ ?>
        <li class="nav-item">
            <a href="#" class="nav-link">
        <?php } ?>
                <i class="fas fa-comment-dots nav-icon"></i>
                <p>
                Modul Forum
                <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <?php if($this->session->flashdata('location') == "Kategori Topik"){ ?>
                    <a href="<?php echo base_url('admin/ModulForum/kategori') ?>" class="nav-link active">
                <?php }else{ ?>
                    <a href="<?php echo base_url('admin/ModulForum/kategori') ?>" class="nav-link">
                <?php } ?>
                    <i class="far fa-circle nav-icon"></i>
                    <p>Kategori Topik</p>
                </a>
                </li>

                <li class="nav-item">
                <?php if($this->session->flashdata('location') == "Data Topik"){ ?>
                    <a href="<?php echo base_url('admin/ModulForum/data') ?>" class="nav-link active">
                <?php }else{ ?>
                    <a href="<?php echo base_url('admin/ModulForum/data') ?>" class="nav-link">
                <?php } ?>
                    <i class="far fa-circle nav-icon"></i>
                    <p>Kontribusi Topik</p>
                </a>
                </li>

            </ul>
            
        </li>


    <?php if($this->session->flashdata('location') == "Kategori Donasi" || $this->session->flashdata('location') == "Tambah Donasi" || $this->session->flashdata('location') == "Data Donasi" || $this->session->flashdata('location') == "Kontribusi Donasi"){ ?>
        <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
        <?php }else{ ?>
        <li class="nav-item">
            <a href="#" class="nav-link">
        <?php } ?>
                <i class="fas fa-hand-holding-usd nav-icon"></i>
                <p>
                Modul Donasi
                <i class="right fas fa-angle-left"></i>
                <?php if($donasiproses != 0){ ?>
                    <span class="badge badge-info right">New</span>
                <?php } ?>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <?php if($this->session->flashdata('location') == "Kategori Donasi"){ ?>
                    <a href="<?php echo base_url('admin/ModulDonasi/kategori') ?>" class="nav-link active">
                <?php }else{ ?>
                    <a href="<?php echo base_url('admin/ModulDonasi/kategori') ?>" class="nav-link">
                <?php } ?>
                    <i class="far fa-circle nav-icon"></i>
                    <p>Kategori Donasi</p>
                </a>
                </li>

                <li class="nav-item">
                <?php if($this->session->flashdata('location') == "Tambah Donasi"){ ?>
                    <a href="<?php echo base_url('admin/ModulDonasi/tambahdonasi') ?>" class="nav-link active">
                <?php }else{ ?>
                    <a href="<?php echo base_url('admin/ModulDonasi/tambahdonasi') ?>" class="nav-link">
                <?php } ?>
                    <i class="far fa-circle nav-icon"></i>
                    <p>Tambah Donasi</p>
                </a>
                </li>

                <li class="nav-item">
                <?php if($this->session->flashdata('location') == "Data Donasi"){ ?>
                    <a href="<?php echo base_url('admin/ModulDonasi/data') ?>" class="nav-link active">
                <?php }else{ ?>
                    <a href="<?php echo base_url('admin/ModulDonasi/data') ?>" class="nav-link">
                <?php } ?>
                    <i class="far fa-circle nav-icon"></i>
                    <p>Data Donasi</p>
                </a>
                </li>

                <li class="nav-item">
                <?php if($this->session->flashdata('location') == "Kontribusi Donasi"){ ?>
                    <a href="<?php echo base_url('admin/ModulDonasi/kontribusi') ?>" class="nav-link active">
                <?php }else{ ?>
                    <a href="<?php echo base_url('admin/ModulDonasi/kontribusi') ?>" class="nav-link">
                <?php } ?>
                    <i class="far fa-circle nav-icon"></i>
                    <p>Kontribusi Donasi</p>
                    <?php if($donasiproses != 0){ ?>
                    <span class="badge badge-info right"><?php echo $donasiproses; ?></span>
                    <?php } ?>
                </a>
                </li>

            </ul>
            
        </li>


        <?php if($this->session->flashdata('location') == "Donasi Selesai"  || $this->session->flashdata('location') == "Rekening"){ ?>
        <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
        <?php }else{ ?>
        <li class="nav-item">
            <a href="#" class="nav-link">
        <?php } ?>
        <i class="fas fa-money-bill-alt nav-icon"></i>
                <p>
                Modul Keuangan
                <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <?php if($this->session->flashdata('location') == "Donasi Selesai"){ ?>
                    <a href="<?php echo base_url('admin/ModulDonasi/donasiselesai') ?>" class="nav-link active">
                <?php }else{ ?>
                    <a href="<?php echo base_url('admin/ModulDonasi/donasiselesai') ?>" class="nav-link">
                <?php } ?>
                    <i class="far fa-circle nav-icon"></i>
                    <p>Donasi Selesai</p>
                </a>
                </li>

                <li class="nav-item">
                <?php if($this->session->flashdata('location') == "Rekening"){ ?>
                    <a href="<?php echo base_url('admin/ModulDonasi/rekening') ?>" class="nav-link active">
                <?php }else{ ?>
                    <a href="<?php echo base_url('admin/ModulDonasi/rekening') ?>" class="nav-link">
                <?php } ?>
                    <i class="far fa-circle nav-icon"></i>
                    <p>Rekening</p>
                </a>
                </li>

            </ul>
            
        </li>


        <?php if($this->session->flashdata('location') == "Galeri Kegiatan"){ ?>
        <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
        <?php }else{ ?>
        <li class="nav-item">
            <a href="#" class="nav-link">
        <?php } ?>
        <i class="fas fa-photo-video nav-icon"></i>
                <p>
                Modul Galeri
                <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <!-- <li class="nav-item">
                <?php if($this->session->flashdata('location') == "Foto"){ ?>
                    <a href="<?php echo base_url('admin/ModulGaleri/foto') ?>" class="nav-link active">
                <?php }else{ ?>
                    <a href="<?php echo base_url('admin/ModulGaleri/foto') ?>" class="nav-link">
                <?php } ?>
                    <i class="far fa-circle nav-icon"></i>
                    <p>Foto</p>
                </a>
                </li>

                <li class="nav-item">
                <?php if($this->session->flashdata('location') == "Video"){ ?>
                    <a href="<?php echo base_url('admin/ModulGaleri/video') ?>" class="nav-link active">
                <?php }else{ ?>
                    <a href="<?php echo base_url('admin/ModulGaleri/video') ?>" class="nav-link">
                <?php } ?>
                    <i class="far fa-circle nav-icon"></i>
                    <p>Video</p>
                </a>
                </li> -->


                <li class="nav-item">
                <?php if($this->session->flashdata('location') == "Galeri Kegiatan"){ ?>
                    <a href="<?php echo base_url('admin/ModulGaleri/data') ?>" class="nav-link active">
                <?php }else{ ?>
                    <a href="<?php echo base_url('admin/ModulGaleri/data') ?>" class="nav-link">
                <?php } ?>
                    <i class="far fa-circle nav-icon"></i>
                    <p>Galeri Kegiatan</p>
                </a>
                </li>
            </ul>
            
        </li>
        

        <?php if($this->session->flashdata('location') == "Profil" || $this->session->flashdata('location') == "Website" || $this->session->flashdata('location') == "LandingPage"){ ?>
        <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
        <?php }else{ ?>
        <li class="nav-item">
            <a href="#" class="nav-link">
        <?php } ?>
        <i class="fas fa-cog nav-icon"></i>
                <p>
                Pengaturan
                <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                <?php if($this->session->flashdata('location') == "Profil"){ ?>
                    <a href="<?php echo base_url('admin/ModulSetting/profil') ?>" class="nav-link active">
                <?php }else{ ?>
                    <a href="<?php echo base_url('admin/ModulSetting/profil') ?>" class="nav-link">
                <?php } ?>
                    <i class="far fa-circle nav-icon"></i>
                    <p>Profil</p>
                </a>
                </li>
            </ul>

            <ul class="nav nav-treeview">
                <li class="nav-item">
                <?php if($this->session->flashdata('location') == "Website"){ ?>
                    <a href="<?php echo base_url('admin/ModulSetting/website') ?>" class="nav-link active">
                <?php }else{ ?>
                    <a href="<?php echo base_url('admin/ModulSetting/website') ?>" class="nav-link">
                <?php } ?>
                    <i class="far fa-circle nav-icon"></i>
                    <p>Website</p>
                </a>
                </li>
            </ul>

            <ul class="nav nav-treeview">
                <li class="nav-item">
                <?php if($this->session->flashdata('location') == "LandingPage"){ ?>
                    <a href="<?php echo base_url('admin/ModulSetting/landingpage') ?>" class="nav-link active">
                <?php }else{ ?>
                    <a href="<?php echo base_url('admin/ModulSetting/landingpage') ?>" class="nav-link">
                <?php } ?>
                    <i class="far fa-circle nav-icon"></i>
                    <p>Landing Page</p>
                </a>
                </li>
            </ul>
            
        </li>



    </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>