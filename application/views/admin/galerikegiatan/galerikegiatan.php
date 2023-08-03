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
$('#Galeri').DataTable();
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


    $('#tambah_kegiatan').submit(function(e){
        e.preventDefault();
        $.ajax({
            url : '<?php echo base_url('admin/ModulGaleri/tambahkegiatan_action') ?>',
            type : 'POST',
            data : $(this).serialize(),
            beforeSend : function(){
                $('#spinner').show();
            },
            complete : function(){
                $('#spinner').hide();
            },
            success : function(data){
                swal(data);
                $('#tambah_kegiatan').trigger("reset");
            },
            error : function(error){
                console.load(error);
            }

        })
    });

    $('#tambah_detail').submit(function(e){
        e.preventDefault();
        $.ajax({
            url : '<?php echo base_url('admin/ModulGaleri/tambahdetail_action') ?>',
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
                $('#tambah_detail').trigger("reset");
                swal(data);
            }, 
            error : function(data){
                console.log(data);
            }
        });
    });

    $('#edit_kegiatan').submit(function(e){
        e.preventDefault();
        $.ajax({
            url : '<?php echo base_url('admin/ModulGaleri/editkegiatan_action') ?>',
            type : 'POST',
            data : $(this).serialize(),
            beforeSend : function(){
                $('#spinner').show();
            },
            complete : function(){
                $('#spinner').hide();
            },
            success : function(data){
                swal(data)
                .then((result) => {
                    location.reload(); 
                });
            },
            error : function(error){
                console.load(error);
            }

        })
    });
});
</script>
</body>
</html>
