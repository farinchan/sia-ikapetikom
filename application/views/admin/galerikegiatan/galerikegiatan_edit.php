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
$('#spinner').hide();

$(document).ready(function(){
    $('#edit_detail').submit(function(e){
    e.preventDefault();
    $.ajax({
        url : '<?php echo base_url('admin/ModulGaleri/editdetail_action') ?>',
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
})
});
</script>
</body>
</html>
