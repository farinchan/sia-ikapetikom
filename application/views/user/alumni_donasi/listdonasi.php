<section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <ol>
                <li><a href="<?php echo base_url('main'); ?>">Home</a></li>
                <li><a href="<?php echo base_url('main/profil'); ?>">Dashboard Alumni</a></li>
                <li>Donasi Anda</li>
            </ol>
            <?php $this->load->view('user/partisi/cariberita.php') ?>
        </div>
    </div>
</section>
<section class="inner-page">
    <div class="container">
        <h2 style="margin-top: -30px;"><?php if(isset($_GET['data'])){ ?> <?php if($_GET['data'] == "all"){echo "Data Seluruh Donasi"; }else if($_GET['data'] == "success"){echo "Donasi Berhasil"; }else if($_GET['data'] == "process"){echo "Donasi Sedang Proses"; }else{echo "Donasi Gagal diproses"; } ?> <?php } ?></h2>
        <div class="row">                

            <section id="team" class="team section-bg" style="background-color: white;" >
                <div data-aos="fade-up" style="margin-top: -20px;">    
                    <div class="card">
                        <div class="card-header" style="background-color: white;">
                            <ul class="navbar-nav" style="float: right;">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: black;">
                                        Filter
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink">
                                        <li><a class="dropdown-item" href="<?php echo base_url('main/alumnidonasi?data=all'); ?>">Semua <span style="float: right;" class="badge bg-info rounded-pill"><?php echo $all; ?></span></a></li>
                                        <li><a class="dropdown-item" href="<?php echo base_url('main/alumnidonasi?data=success'); ?>">Success <span style="float: right;" class="badge bg-info rounded-pill"><?php echo $success; ?></span></a></li>
                                        <li><a class="dropdown-item" href="<?php echo base_url('main/alumnidonasi?data=process'); ?>">Process <span style="float: right;" class="badge bg-info rounded-pill"><?php echo $process; ?></span></a></li>
                                        <li><a class="dropdown-item" href="<?php echo base_url('main/alumnidonasi?data=gagal'); ?>">Gagal <span style="float: right;" class="badge bg-info rounded-pill"><?php echo $gagal; ?></span></a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                        
                            <table class="table table-bordered" id="list_donasi">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Judul Donasi</th>
                                        <th scope="col">Waktu Donasi</th>
                                        <th scope="col">Jumlah Donasi</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; foreach ($data as $x): ?>
                                    <tr>
                                        <th scope="row"><?php echo $i++; ?></th>
                                        <td><?php echo $x->judul_donasi; ?></td>
                                        <td><?php echo $x->tanggal_bayar; ?></td>
                                        <td><?php echo  "Rp. ".number_format($x->total_donasi, 2, ',', '.') ?></td>
                                        <?php if($x->status_pembayaran == "Y"){ ?>
                                        <td><i style="color:green">Sukses</i></td>
                                        <?php }else if($x->status_pembayaran == "N"){ ?>
                                        <td><i style="color:blue">Proses</i></td>
                                        <?php }else{ ?>
                                        <td><i style="color:red">Gagal</i></td>
                                        <?php } ?>
                                        <td><center><a href="<?php echo base_url('main/alumnidetaildonasi/'.$x->id_transaksi) ?>"><span class="badge rounded-pill bg-primary">Detail</span></a></center></td>
                                    </tr>
                                    <?php endforeach; ?>
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