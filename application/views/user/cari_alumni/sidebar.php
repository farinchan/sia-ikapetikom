<section id="team" class="team section-bg" style="background-color: white;" >
    <div data-aos="fade-up" style="margin-top: -20px;">    
        <div class="card">
            <div class="card-header" style="background-color: white;">
                Kategori Berita
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a href="<?php echo base_url('main/beritaadmin') ?>" id="populer">Postingan Admin</a>                                              
                        <span class="badge bg-primary rounded-pill"><?php echo $total_berita_admin; ?></span>
                    </li>
                    <?php foreach ($kategori_berita as $kategori): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a href="<?php echo base_url('main/beritakategori/'.$kategori->id_kategoriberita) ?>" id="populer"><?php echo $kategori->nama_kategoriberita; ?></a>                                              
                        <span class="badge bg-primary rounded-pill"><?php echo $kategori->jumlahberita; ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <div data-aos="fade-up">    
            <div class="card mt-4">
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
        </div>
    </div>
</section>  