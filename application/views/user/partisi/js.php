<div id="preloader"></div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

<!-- Vendor JS Files -->
<script src="<?php echo base_url() ?>assets/vendor/aos/aos.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/php-email-form/validate.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/purecounter/purecounter.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/waypoints/noframework.waypoints.js"></script>
<!-- Template Main JS File -->
<script src="<?php echo base_url() ?>assets/js/main.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

<script>
$('#subscribe').submit(function(e){
    e.preventDefault();
    $.ajax({
        data : $(this).serialize(),
        type : 'POST',
        url : '<?php echo base_url('main/savesubscribe') ?>',
        success : function(data){
            swal(data);
            $('#subscribe').trigger("reset");
        }
    });
});
</script>