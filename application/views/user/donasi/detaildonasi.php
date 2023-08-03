<?php foreach ($data as $x): ?>
<?php
    $originalDate = $x->tanggal_donasidibuat;
    $newDate = date("d F Y", strtotime($originalDate));

    $date1 = new DateTime(date('Y-m-d', strtotime($x->donasi_ditutup)));
    $date2 = new DateTime();
    $date3 = new DateTime(date('Y-m-d', strtotime($x->donasi_dibuka)))
?>
<section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <ol>
                <li><a href="<?php echo base_url('main') ?>">Home</a></li>
                <li><a href="<?php echo base_url('main/donasi') ?>">Donasi</a></li>
                <li><?php echo $x->judul_donasi; ?></li>
            </ol>
            <?php $this->load->view('user/partisi/cariberita.php') ?>
        </div>
    </div>
</section>
<section class="inner-page">
    <div class="container">
        <span class="badge bg-primary"><i class="far fa-circle"></i> <?php echo $x->nama_kategoridonasi; ?></span><br><br>
        <h2 style="margin-top: 0px;"><?php echo $x->judul_donasi; ?></h2>
        <small style="font-size: 13px;"><i class="far fa-user"></i> Administrator &bull; <i class="far fa-calendar-alt"></i> <?php echo $newDate; ?> &bull; <i class="fas fa-bolt"></i> dilihat <?php echo $x->total_dilihat; ?></small>
        <div class="row">                
            <div class="col-sm-8" >                
                <section id="team" class="team section-bg" style="background-color: white;" >
                    <div data-aos="fade-up" style="margin-top: -20px;">    
                        <img src="<?php echo base_url('assets/donasi/img/'.$x->gambar_donasi) ?>" alt="" class="img-fluid"><br>
                        <small><i>Donasi dipublikasikan oleh admin</i></small>
                        <br><br>

                        <table class="table">
                            <tbody>
                                <tr>
                                <th scope="row">Donasi Dibuka</th>
                                <td><?php echo $x->donasi_dibuka; ?></td>
                                </tr>
                                <tr>
                                <th scope="row">Donasi Ditutup</th>
                                <td><?php echo $x->donasi_ditutup; ?></td>
                                </tr>
                                <tr>
                                <th scope="row">Target Dana</th>
                                <td colspan="2">Rp. <?php echo number_format($x->target_dana, 2, ',', '.') ?></td>
                                </tr>
                                <tr>
                                <th scope="row">Total Donatur</th>
                                <td colspan="2"><?php echo $total_donatur; ?> Orang</td>
                                </tr>
                                <tr>
                                <th scope="row">Dana Terkumpul</th>
                                <td colspan="2">Rp. <?php echo number_format($danaterkumpul, 2, ',', '.') ?></td>
                                </tr>
                                <tr>
                                <th scope="row">Waktu Tersisa</th>
                                <?php if($date1 < $date2){ ?>
                                <td colspan="2">Donasi Ditutup</td>
                                <?php }else{ ?>
                                <td colspan="2"><?php echo $date1->diff($date2)->days." Hari Lagi" ?></td>
                                <?php } ?>
                                </tr>
                            </tbody>
                            </table>
                            <div class="d-grid gap-2 col-6 mx-auto">
                                <?php if(isset($_SESSION['nisn_session'])){ ?>

                                <?php if($date2 < $date3){ ?>
                                    
                                <a href="#" type="button" class="btn btn-primary disabled">Donasi Belum Dibuka...</a>

                                <?php }else if($date2 > $date1){ ?>
                                
                                <a href="#" type="button" class="btn btn-primary disabled">Donasi Ditutup...</a>

                                <?php }else{ ?>
                                
                                <a href="<?php echo base_url('main/bayardonasi/'.$x->id_donasi) ?>" type="button" class="btn btn-primary">Donasi Sekarang</a>

                                <?php } ?>

                                <?php }else{ ?>
                                <a href="#" type="button" class="btn btn-primary disabled">Anda Belum Login...</a>
                                <?php } ?>
                            </div>

                            <div class="d-grid gap-2 col-6 mx-auto mt-4">
                            <a type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Perbandingan Donasi</a>
                        </div>
                            
                            <hr>
                            <br>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Detail Program</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Doa Donatur</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Daftar Donatur</button>
                            </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <br>
                                <p>
                                    <?php echo $x->detail_program; ?>
                                </p>
                            </div>

                            <?php endforeach; ?>

                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <br>
                                <ul class="list-group" id="data_doa">

                                </ul>
                                <div id='pagination_doa'></div>                                  
                            </div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                <br>
                                <p>
                                    <table class="table" id="DonaturList">
                                        <thead>
                                            <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Tanggal</th>
                                            <th scope="col">Nama Donatur</th>
                                            <th scope="col">Nominal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1; foreach ($donatur as $x): ?>
                                            <?php
                                              $originalDate = $x->tanggal_bayar;
                                              $newDate = date("d F Y", strtotime($originalDate));  
                                            ?>
                                            <tr>
                                                <th scope="row"><?php echo $i++; ?></th>
                                                <td><?php echo $newDate; ?></td>
                                                <td><?php echo $x->nama_alumni; ?></td>
                                                <td><?php echo  "Rp. ".number_format($x->total_donasi, 2, ',', '.') ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                        </table>
                                </p>
                            </div>
                            </div>
                    </div>
                </section>
                
            </div>
            <?php $this->load->view('user/donasi/samping.php'); ?>
            </div>
        </div>    
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Perbandingan Donasi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="text-center">

        <div class="row">
          
          <?php foreach ($perbandingan as $x): ?>
          <div class="col-sm">
            <div class="card border-success mb-3" style="max-width: 18rem;">
              <div class="card-header text-black border-success" style="background-color: white;">Alumni Tahun <?php echo $x->tahun_lulus; ?></div>
              <div class="card-body">
                <h5 class="card-title">Dana Terkumpul</h5>
                <h5 class="text-success">Rp. <?php echo number_format($x->total_donasi, 2, ',', '.') ?></h5>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
          
        </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>