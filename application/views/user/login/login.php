<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('user/partisi/head.php') ?>
<body>

<?php $this->load->view('user/partisi/navbar.php') ?>

<main id="main">
<?php $this->load->view('user/login/content.php') ?>
</main>

<?php $this->load->view('user/partisi/footer.php') ?>
<?php $this->load->view('user/partisi/js.php') ?>
<script src="<?php echo base_url(); ?>assets/js/dropzone.js"></script>
<script>
    $("#textarea_diskusi").each(function () {
    this.setAttribute("style", "height:" + (this.scrollHeight) + "px;overflow-y:hidden;");
    }).on("input", function () {
    this.style.height = "auto";
    this.style.height = (this.scrollHeight) + "px";
    });

    $(document).on('click', '.toggle-password', function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $("#password");
    input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
    });

    $(document).ready(function(){
        $('#spinner').hide();
    });
</script>

<script>
<?php if($this->uri->segment(3) == "nisnfalse"){?>
    swal("NIA atau password salah");
<?php }else if($this->uri->segment(3) == "aktifasi"){ ?>
    swal("Akun belum diaktifasi admin");
<?php }else if($this->uri->segment(3) == "captchawrong"){ ?>
    swal("Captcha Salah");
<?php } ?>
</script>


</body>

</html>