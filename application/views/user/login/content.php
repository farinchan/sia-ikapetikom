<section class="breadcrumbs">
<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <ol>
            <li><a href="<?php echo base_url('main'); ?>">Home</a></li>
            <li>Login Alumni</li>
        </ol>
        <?php $this->load->view('user/partisi/cariberita.php') ?>
    </div>
</div>
</section>
<section class="inner-page">
<div class="container">

    <div class="row">                
        <div class="col-sm-8" >                
            <section id="team" class="team section-bg" style="background-color: white;" >

                <div class="card" style="border: none;">
                <div class="card-body">
                    <div class="container">
                    <h3 style="margin-top: -70px; margin-bottom: 40px;">Login Aplikasi</h3><hr><br>
                        <form id="form_login" method="POST" action="<?php echo base_url('main/actionlogin') ?>">
                            <div class="mb-3 row">
                                <label for="nama_alumni" class="col-sm-2 col-form-label">NIA</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nisn" name="nisn" placeholder="Masukkan NIA anda">
                                </div>
                            </div>

                            <div class="row mt-4">
                                <label for="nama_alumni" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-eye fa-1x toggle-password"></i></span>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                    </div>
                                    <small style="font-size: 12px;"><i>Jika lupa dengan password anda silahkan hubungi admin</i></small>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <label for="nama_alumni" class="col-sm-2 col-form-label">Coba Hitung</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="text" name="number_1" class="form-control" readonly value="<?php echo $number_1; ?>" style="background-color:whitesmoke; text-align:center;">
                                        <span class="input-group-text"> + </span>
                                        <input type="text" name="number_2" class="form-control" readonly value="<?php echo $number_2; ?>" style="background-color: whitesmoke; text-align:center;">
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 row">
                                <label for="nama_alumni" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="captcha" name="captcha" placeholder="Jawaban Anda">
                                </div>
                            </div>

                            <button class="btn btn-primary mt-5" type="submit">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner"></span> Login
                            </button>
                        </form>
                    </div>
                </div>
                </div>
            </section>
        </div>
        <?php $this->load->view('user/register/syarat_ketentuan.php'); ?>
        </div>
    </div>    
</div>
</section>