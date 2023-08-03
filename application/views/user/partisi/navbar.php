<!-- ======= Top Bar ======= -->
<section id="topbar" class="d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
    <div class="contact-info d-flex align-items-center">
        <b>Aktifitas</b>&nbsp;<marquee> <?php foreach ($listberita as $x){ echo "<a href='".base_url('main/bacaberita/'.$x->id_berita)."' style='color:white;'>".$x->judul_berita."</a>"." , "; } ?></marquee>
    </div>
    <div class="social-links d-none d-md-flex align-items-center">
        <?php foreach ($web as $x): ?>
        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="<?php echo $x->facebook; ?>" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="<?php echo $x->instagram; ?>" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
    </div>
    </div>
</section>
<!-- ======= Header ======= -->
<header id="header" class="d-flex align-items-center">
<div class="container d-flex align-items-center justify-content-between">
    <h1 class="logo"><a href="<?php echo base_url('main') ?>"><img src="<?php echo base_url('assets/img/'.$x->logo); ?>" alt="" class="img-fluid"> Alumni<span>Ku</span></a></h1>
    <?php endforeach; ?>

    <nav id="navbar" class="navbar">
    <ul>
        <?php if($this->session->flashdata('location') == "Home"){ ?>
        <li><a class="nav-link scrollto active" href="<?php echo base_url('main'); ?>">Home</a></li>
        <?php }else{ ?>
        <li><a class="nav-link scrollto" href="<?php echo base_url('main'); ?>">Home</a></li>
        <?php } ?>
        
        <?php if($this->session->flashdata('location') == "Berita Alumni"){ ?>
        <li><a class="nav-link scrollto active" href="<?php echo base_url('main/beritaalumni'); ?>">Berita</a></li>
        <?php }else{ ?>
        <li><a class="nav-link scrollto" href="<?php echo base_url('main/beritaalumni'); ?>">Berita</a></li>
        <?php } ?>

        <?php if($this->session->flashdata('location') == "Donasi"){ ?>
        <li><a class="nav-link scrollto active" href="<?php echo base_url('main/donasi') ?>">Donasi</a></li>
        <?php }else{ ?>
        <li><a class="nav-link scrollto" href="<?php echo base_url('main/donasi') ?>">Donasi</a></li>
        <?php } ?>

        <?php if($this->session->flashdata('location') == "Cari Alumni"){ ?>
            <li><a class="nav-link scrollto active" href="<?php echo base_url('main/carialumni'); ?>">Cari Alumni</a></li>
        <?php }else{ ?>
            <li><a class="nav-link scrollto" href="<?php echo base_url('main/carialumni'); ?>">Cari Alumni</a></li>
        <?php } ?>

        <?php if($this->session->flashdata('location') == "GisAlumni"){ ?>
            <li><a class="nav-link scrollto active" href="<?php echo base_url('main/gisalumni'); ?>">GIS Alumni</a></li>
        <?php }else{ ?>
            <li><a class="nav-link scrollto" href="<?php echo base_url('main/gisalumni'); ?>">GIS Alumni</a></li>
        <?php } ?>

        <li class="dropdown active"><a href="#"><span>Forum</span> <i class="bi bi-chevron-down"></i></a>
        <ul>
            <li><a href="<?php echo base_url('main/diskusi') ?>">Semua Topik</a></li>
            <li><a href="<?php echo base_url('main/buattopik'); ?>">Buat Topik Baru</a></li>
        </ul>
        </li>
        
        <?php if(isset($_SESSION['nisn_session'])){ ?>

            <?php if($this->session->flashdata('location') == "Dashboard Alumni" || $this->session->flashdata('location') == "Edit Profil" || $this->session->flashdata('location') == "Pesan" || $this->session->flashdata('location') == "Topik Anda" || $this->session->flashdata('location') == "Edit Topik"){ ?>
            <li><a class="nav-link scrollto active" href="<?php echo base_url('main/login'); ?>">Halo Alumni</a></li>
            <?php }else{ ?>
            <li><a class="nav-link scrollto" href="<?php echo base_url('main/login'); ?>">Halo Alumni</a></li>
            <?php } ?>

            <li><a class="nav-link scrollto" href="<?php echo base_url('main/logoutsystem') ?>">Logout</a></li>

        <?php }else{ ?>

        <?php if($this->session->flashdata('location') == "Register"){ ?>
        <li><a class="nav-link scrollto active" href="<?php echo base_url('main/register'); ?>">Register</a></li>
        <?php }else{ ?>
        <li><a class="nav-link scrollto" href="<?php echo base_url('main/register'); ?>">Register</a></li>
        <?php } ?>

        <?php if($this->session->flashdata('location') == "Login"){ ?>
        <li><a class="nav-link scrollto active" href="<?php echo base_url('main/login'); ?>">Login</a></li>
        <?php }else{ ?>
        <li><a class="nav-link scrollto" href="<?php echo base_url('main/login'); ?>">Login</a></li>
        <?php } ?>

        <?php } ?>
    </ul>
    <i class="bi bi-list mobile-nav-toggle"></i>
    </nav>

</div>
</header><!-- End Header -->