<div class="col-sm-4">
    <section id="team" class="team section-bg" style="background-color: white;" >
        <div data-aos="fade-up" style="margin-top: -20px;">    
            <div class="card">
                <div class="card-header" style="background-color: white;">
                    Kategori tracer
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="<?php echo base_url('main/traceradmin') ?>" id="populer">Postingan Admin</a>                                              
                            <span class="badge bg-primary rounded-pill"><?php echo $total_tracer_admin; ?></span>
                        </li>
                        <?php foreach ($kategori_tracer as $kategori): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="<?php echo base_url('main/tracerkategori/'.$kategori->id_kategoritracer) ?>" id="populer" ><?php echo $kategori->nama_kategoritracer; ?></a>                                              
                            <span class="badge bg-primary rounded-pill"><?php echo $kategori->jumlahtracer; ?></span>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header" style="background-color: white;">
                    Kategori Donasi
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="" id="populer">Covid-19</a>                                              
                            <span class="badge bg-primary rounded-pill">14</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="" id="populer">Panti Asuhan</a>                                                
                            <span class="badge bg-primary rounded-pill">2</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="" id="populer">Korban Bencana</a>                                                
                            <span class="badge bg-primary rounded-pill">1</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="" id="populer">Sekolah</a>
                            <span class="badge bg-primary rounded-pill">1</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="" id="populer">Masjid</a>
                            <span class="badge bg-primary rounded-pill">1</span>
                        </li>
                        </ul>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header" style="background-color: white;">
                    Postingan Populer
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        <?php foreach ($tracerpopuler as $populer): ?>
                        <?php
                            $originalDate = $populer->tanggal_posting;
                            $newDate = date("d F Y", strtotime($originalDate));
                        ?>
                        <div class="row mt-4">
                            <div class="col">
                                <img src="<?php echo base_url('assets/tracer/'.$populer->gambar_tracer) ?>" alt="" width="140px">
                            </div>
                            <div class="col">
                                <p>
                                    <a id="populer" href="<?php echo base_url('main/bacatracer/'.$populer->id_tracer); ?>" ><?php echo $populer->judul_tracer; ?></a><br>
                                    <small style="font-size: 11px;"><i class="far fa-calendar-alt"></i> <?php echo $newDate; ?> &bull; <i class="fas fa-bolt"></i> dilihat <?php echo $populer->total_dilihat; ?></small>
                                </p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>                          
</div>