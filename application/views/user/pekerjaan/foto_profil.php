<div class="card">
    <div class="card-body">
        <div class="text-center">
            <a href="#" id="foto_alumni" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><img src="<?php echo base_url('assets/user/img/'.$last_login['foto_alumni']) ?>" class="img-fluid rounded-circle" alt="..." width="170px"></a>                                     
            <p class="mt-3" style="color: green;"><i class="fas fa-check-circle"></i> Terferivikasi</p>
            <h5 class="mt-3"><?php echo $_SESSION['nama_session']; ?></h5>
            <p>Alumni <?php echo $last_login['tahun_lulus']; ?> <br>
                <small>Aktif, <?php if($last_login['hari'] != 0){echo $last_login['hari']." hari "; } if($last_login['jam'] != 0){echo $last_login['jam']." jam "; } ?> <?php echo $last_login['menit']." menit yang lalu" ?></small>
            </p>                                        
        </div>
    </div>
</div>

