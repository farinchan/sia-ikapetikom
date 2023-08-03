<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('admin/partisi/head.php'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/dropzone.css">
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
<?php $this->load->view('admin/partisi/navbar.php'); ?>
<?php $this->load->view('admin/partisi/sidebar.php'); ?>

<?php echo $content; ?>
<?php $this->load->view('admin/partisi/footer.php') ?>
</div>
<?php $this->load->view('admin/partisi/js.php') ?>
<script src="<?php echo base_url(); ?>assets/js/dropzone.js"></script>
<script>
$(document).ready(function(){
    $('#spinner').hide();
    $('#spinner1').hide();
    $('#spinner2').hide();
    $('#spinner3').hide();

    
    $('#edit_admin').submit(function(e){
        e.preventDefault();
        $.ajax({
            url : '<?php echo base_url('admin/ModulSetting/updateprofilAction') ?>',
            type : 'POST',
            data : new FormData(this),
            dataType : 'JSON',
            contentType : false,
            cache : false,
            processData : false,
            beforeSend : function(){
                $('#spinner').show();
            },
            complete : function(){
                $('#spinner').hide();
            },
            success : function(data){
                swal(data)
                .then((value) => {
                    location.reload();
                });
            },
            error : function(data){
                console.log(data);
            }
        });
    });

    $('#edit_website').submit(function(e){
        e.preventDefault();
        $.ajax({
            url : '<?php echo base_url('admin/ModulSetting/editwebsite') ?>',
            type : 'POST',
            data : new FormData(this),
            dataType : 'JSON',
            contentType : false,
            cache : false,
            processData : false,
            beforeSend : function(){
                $('#spinner').show();
            },
            complete : function(){
                $('#spinner').hide();
            },
            success : function(data){
                swal(data)
                .then((value) => {
                    location.reload();
                });
            },
            error : function(data){
                console.log(data);
            }
        });
    });

    $('#edit_banner1').submit(function(e){
        e.preventDefault();
        $.ajax({
            url : '<?php echo base_url('admin/ModulSetting/editbanner1') ?>',
            type : 'POST',
            data : new FormData(this),
            dataType : 'JSON',
            contentType : false,
            cache : false,
            processData : false,
            beforeSend : function(){
                $('#spinner1').show();
            },
            complete : function(){
                $('#spinner1').hide();
            },
            success : function(data){
                swal(data)
                .then((value) => {
                    location.reload();
                });
            },
            error : function(data){
                console.log(data);
            }
        });
    });

    $('#edit_banner2').submit(function(e){
        e.preventDefault();
        $.ajax({
            url : '<?php echo base_url('admin/ModulSetting/editbanner2') ?>',
            type : 'POST',
            data : new FormData(this),
            dataType : 'JSON',
            contentType : false,
            cache : false,
            processData : false,
            beforeSend : function(){
                $('#spinner2').show();
            },
            complete : function(){
                $('#spinner2').hide();
            },
            success : function(data){
                swal(data)
                .then((value) => {
                    location.reload();
                });
            },
            error : function(data){
                console.log(data);
            }
        });
    });

    $('#edit_banner3').submit(function(e){
        e.preventDefault();
        $.ajax({
            url : '<?php echo base_url('admin/ModulSetting/editbanner3') ?>',
            type : 'POST',
            data : new FormData(this),
            dataType : 'JSON',
            contentType : false,
            cache : false,
            processData : false,
            beforeSend : function(){
                $('#spinner3').show();
            },
            complete : function(){
                $('#spinner3').hide();
            },
            success : function(data){
                swal(data)
                .then((value) => {
                    location.reload();
                });
            },
            error : function(data){
                console.log(data);
            }
        });
    });
})
</script>
</body>
</html>
