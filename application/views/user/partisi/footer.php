<!-- ======= Footer ======= -->
<footer id="footer">
<div class="footer-newsletter">
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
        <h4>Subscribe Sekarang</h4>
        <p>Dapatkan Notifikasi Terbaru Mengenai Berita Alumni</p>
        <form id="subscribe" method="post">
            <input type="email" name="email" required><input type="submit" value="Subscribe">
        </form>
        </div>
    </div>
    </div>
</div>

<?php foreach ($web as $x): ?>
<div class="footer-top">
    <div class="container">
    <div class="row">

        <div class="col-lg-3 col-md-6 footer-contact">
        <h3><img src="<?php echo base_url() ?>assets/img/logo.png" alt="" class="img-fluid" width="45px"> Alumni<a href="index.html"><span>Ku</span></a></h3>
        <p>
            Ikatan Seleruh Alumni <br>
            Pesantren Alhikmah Jumapolo<br>
            Jawa Tengah <br><br>
            <strong>Whatsapp:</strong> <?php echo $x->no_wa; ?><br>
            <strong>Email:</strong> <?php echo $x->email; ?><br>
        </p>
        </div>

        <div class="col-lg-3 col-md-6 footer-links">
        <h4>Menu Alumni</h4>
        <ul>
            <li><i class="bx bx-chevron-right"></i> <a href="<?php echo base_url() ?>">Home</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="<?php echo base_url('main/beritaalumni') ?>">Berita</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="<?php echo base_url('main/donasi') ?>">Donasi</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="<?php echo base_url('main/cariaalumni') ?>">Cari Alumni</a></li>
        </ul>
        </div>

        <div class="col-lg-3 col-md-6 footer-links">
        <h4>Daftarkan Diri Anda</h4>
        <ul>
            <li><i class="bx bx-chevron-right"></i> <a href="<?php echo base_url('main/login') ?>">Login</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="<?php echo base_url('main/register') ?>">Register</a></li>
        </ul>
        </div>

        <div class="col-lg-3 col-md-6 footer-links">
        <h4>Social Networks</h4>
        <p>Ikuti kami di sosial media dibawah</p>
        <div class="social-links mt-3">
            <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
            <a href="<?php echo $x->facebook; ?>" class="facebook"><i class="bx bxl-facebook"></i></a>
            <a href="<?php echo $x->instagram; ?>" class="instagram"><i class="bx bxl-instagram"></i></a>
            <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
            <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
        </div>
        </div>

    </div>
    </div>
</div>

<div class="container py-4">
    <div class="copyright">
    <?php echo $x->footer; ?>
    </div>
    <div class="credits">
    <!-- All the links in the footer should remain intact. -->
    <!-- You can delete the links only if you purchased the pro version. -->
    <!-- Licensing information: https://bootstrapmade.com/license/ -->
    <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/bizland-bootstrap-business-template/ -->
    Created by <a href="mailto:ardhikayoviyanto@gmail.com">ardhikayoviyanto@gmail.com</a>
    </div>
</div>
</footer><!-- End Footer -->
<?php endforeach; ?>

