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
$('#Foto').DataTable();
$('#Video').DataTable();
$('#spinner').hide();
$('#video_galeri').hide();

$(document).ready(function(){
    $('#flexRadioDefault1').click(function(e){
        $('#foto_galeri').show();
        $('#video_galeri').hide();

    });

    $('#flexRadioDefault2').click(function(e){
        $('#video_galeri').show();
        $('#foto_galeri').hide();
    });

    $('#tambah_galeri').submit(function(e){
        e.preventDefault();
        $.ajax({
            url : '<?php echo base_url('admin/ModulGaleri/tambahgaleri_action') ?>',
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
                $('#tambah_galeri').trigger("reset");
                swal(data);
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
