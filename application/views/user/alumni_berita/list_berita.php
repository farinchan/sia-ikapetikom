<section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <ol>
                <li><a href="<?php echo base_url('main'); ?>">Home</a></li>
                <li><a href="<?php echo base_url('main/profil'); ?>">Dashboard Alumni</a></li>
                <li>List Berita Anda</li>
            </ol>
            <?php $this->load->view('user/partisi/cariberita.php') ?>
        </div>
    </div>
</section>
<section class="inner-page">
    <div class="container">
        <h2 style="margin-top: -30px;">List Berita Anda </h2>
        <div class="row">                

            <section id="team" class="team section-bg" style="background-color: white;" >
                <div data-aos="fade-up" style="margin-top: -20px;">    
                    <div class="card">
                        <div class="card-header" style="background-color: white;">
                            <?php echo $totalberita_published; ?> Berita <span class="badge bg-success">published</span>  | <?php echo $totalberita_unpublished; ?> Berita <span class="badge bg-danger">Unpublished</span>
                            <ul class="navbar-nav" style="float: right;">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: black;">
                                        Menu Berita
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink">
                                        <li><a class="dropdown-item active" href="<?php echo base_url('main/berita'); ?>">List Berita</a></li>
                                        <li><a class="dropdown-item" href="<?php echo base_url('main/tambahberita'); ?>">Tambah Berita</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                        
                            <table class="table table-bordered" id="list_berita">
                                <thead>
                                    <tr>
                                    <th scope="col">Judul</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Tanggal Posting</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Dilihat</th>
                                    <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>  
                     
         </div>
        </div>    
    </div>
</section>