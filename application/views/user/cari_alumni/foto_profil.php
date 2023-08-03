<div class="card">
    <div class="card-body">
        <div class="text-center">
            <img src="<?php echo base_url('assets/user/img/'.$last_login['foto_alumni']) ?>" class="img-fluid rounded-circle" alt="..." width="170px">                                    
            <p class="mt-3" style="color: green;"><i class="fas fa-check-circle"></i> Terferivikasi</p>
            <?php foreach ($data_profil as $x): ?>
            <h5 class="mt-3"><?php echo $x->nama_alumni; ?></h5>
            <?php endforeach; ?>
            <p>Alumni <?php echo $last_login['tahun_lulus']; ?> <br>
                <small>Aktif, <?php if($last_login['hari'] != 0){echo $last_login['hari']." hari "; } if($last_login['jam'] != 0){echo $last_login['jam']." jam "; } ?> <?php echo $last_login['menit']." menit yang lalu" ?></small>
            </p>                                        
        </div>
    </div>
</div>
