<div class="col-sm-4">
    <section id="team" class="team section-bg" style="background-color: white;" >
        <div data-aos="fade-up" style="margin-top: -20px;">    
            <div class="card">
                <div class="card-header" style="background-color: white;">
                    Jumlah Topik
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <?php foreach ($jumlahtopik_angkatan as $topik): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a id="populer">Alumni <?php echo $topik->tahun_lulus; ?></a>                                              
                            <span class="badge bg-primary rounded-pill"><?php echo $topik->total_topik; ?></span>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header" style="background-color: white;">
                    Topik Populer
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        <ul class="list-group list-group-flush">
                            <?php foreach ($list_topikpopuler as $list): ?>
                            <li class="list-group-item"><a href="<?php echo base_url('main/bacatopik/'.$list->id_topik) ?>" id="populer"><?php echo $list->judul_topik; ?></a><br><small style="font-size: 12px;"><i class="far fa-user"></i> <?php echo $list->nama_alumni; ?> &bull; <i class="fas fa-bolt"></i> dilihat <?php echo $list->total_dilihat; ?></small></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                </div>
        </div>
    </section>                          
</div>