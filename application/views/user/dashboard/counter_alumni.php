<section id="counts" class="counts">
    <div class="container" data-aos="fade-up">
        <div class="row">
            <?php foreach ($tahun_lulus as $x): ?>
            <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
            <br>
                <?php if($x->total_alumni != 0): ?>
                <div class="count-box">
                    <i class="bi bi-people"></i>
                    <span data-purecounter-start="0" data-purecounter-end="<?php echo $x->total_alumni; ?>" data-purecounter-duration="1" class="purecounter"></span>
                    <p>Alumni <?php echo $x->tahun_lulus; ?></p>
                </div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section><!-- End Counts Section -->