<div class="col-sm-4">
    <section id="team" class="team section-bg" style="background-color: white;" >
        <div data-aos="fade-up" style="margin-top: -20px;">    
            <div class="card">
                <div class="card-header" style="background-color: white;">
                    Kategori Donasi
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <?php foreach ($kategori_donasi as $x): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="<?php echo base_url('main/kategoridonasi/'.$x->id_kategoridonasi) ?>" id="populer"><?php echo $x->nama_kategoridonasi; ?></a>                                              
                            <span class="badge bg-primary rounded-pill"><?php echo $x->jumlah; ?>  </span>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header" style="background-color: white;">
                    Pengumpulan Dana Terbesar
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <?php $i=0; foreach ($danaterbesar as $x): ?>
                        <?php $hasil_rupiah = number_format($x->donasi_terkumpul,2,',','.'); ?>
                        <?php if($i == 0): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-success">
                            <a href="<?php echo base_url('main/detaildonasi/'.$x->id_donasi) ?>" id="populer"><?php echo $x->judul_donasi; ?></a>                                              
                            <span class="badge bg-success rounded-pill">Rp. <?php echo $hasil_rupiah ?></span>
                        </li>
                        <?php endif; ?>
                        <?php if($i==1): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-primary">
                            <a href="<?php echo base_url('main/detaildonasi/'.$x->id_donasi) ?>" id="populer"><?php echo $x->judul_donasi; ?></a>                                                
                            <span class="badge bg-primary rounded-pill">Rp. <?php echo $hasil_rupiah ?></span>
                        </li>
                        <?php endif; ?>
                        <?php if($i == 2): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-danger">
                            <a href="<?php echo base_url('main/detaildonasi/'.$x->id_donasi) ?>" id="populer"><?php echo $x->judul_donasi; ?></a>                                                
                            <span class="badge bg-danger rounded-pill">Rp. <?php echo $hasil_rupiah ?></span>
                        </li>
                        <?php endif; ?>
                        <?php if($i == 3): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-secondary">
                            <a href="<?php echo base_url('main/detaildonasi/'.$x->id_donasi) ?>" id="populer"><?php echo $x->judul_donasi; ?></a>
                            <span class="badge bg-secondary rounded-pill">Rp. <?php echo $hasil_rupiah ?></span>
                        </li>
                        <?php endif; ?>
                        <?php if($i == 4): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-dark">
                            <a href="<?php echo base_url('main/detaildonasi/'.$x->id_donasi) ?>" id="populer"><?php echo $x->judul_donasi; ?></a>
                            <span class="badge bg-dark rounded-pill">Rp. <?php echo $hasil_rupiah ?></span>
                        </li>
                        <?php endif; ?>
                        <?php $i++; endforeach; ?>
                        </ul>
                </div>
            </div>
            
            <div class="card mt-4">
                <div class="card-header" style="background-color: white;">
                    Metode Pembayaran
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="text-center">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT8vFVcegGIFZCNhaz6yoWaNGd1P1hqsI9jEeQalcZOoKLby-u41GjOJc2mTYlO4SpdrS8&usqp=CAU" class="img-fluid" alt="...">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>                          
</div>