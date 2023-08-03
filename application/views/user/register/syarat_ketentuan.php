<div class="col-sm-4">
    <section id="team" class="team section-bg" style="background-color: white;" >
        <div data-aos="fade-up" style="margin-top: -20px;">    
            <div class="card">
                <?php foreach ($web as $x): ?>
                <div class="card-header" style="background-color: white;">
                    Syarat Dan Ketentuan
                </div>
                <div class="card-body">
                    <?php echo $x->syarat; ?>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header" style="background-color: white;">
                    Tentang Alumni
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        <?php echo $x->tentang; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>                          
</div>