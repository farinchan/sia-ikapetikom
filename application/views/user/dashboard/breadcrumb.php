<div class="container w-75 mt-5">
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
    <?php foreach ($web as $x): ?>
    <div class="carousel-inner">
        <div class="carousel-item active">
        <img src="<?php echo base_url('assets/img/banner/'.$x->lp_1); ?>" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
            <h1 style="color: rgb(61, 63, 66);"><?php echo $x->nama_website; ?></h1>
            <p style="color: rgb(61, 63, 66);"><?php echo $x->sup_1; ?></p>
        </div>
        </div>
        <div class="carousel-item">
        <img src="<?php echo base_url('assets/img/banner/'.$x->lp_2); ?>" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
            <h1 style="color: rgb(61, 63, 66);"><?php echo $x->nama_website; ?></h1>
            <p style="color: rgb(61, 63, 66);"><?php echo $x->sup_2; ?></p>
        </div>
        </div>
        <div class="carousel-item">
        <img src="<?php echo base_url('assets/img/banner/'.$x->lp_3); ?>" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
            <h1 style="color: rgb(61, 63, 66);"><?php echo $x->nama_website; ?></h1>
            <p style="color: rgb(61, 63, 66);"><?php echo $x->sup_3; ?></p>
        </div>
        </div>
    </div>
    <?php endforeach; ?>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"  data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"  data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
    </div>
</div>    