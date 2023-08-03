<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('user/partisi/head.php') ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/dropzone.css">
<?php $this->load->view('user/partisi/datatables_css'); ?>
<body>
<?php $this->load->view('user/partisi/navbar.php') ?>

<main id="main">
<?php echo $content; ?>
</main>
<?php $this->load->view('user/partisi/footer.php') ?>
<?php $this->load->view('user/partisi/js.php') ?>
<?php $this->load->view('user/partisi/datatables_js'); ?>

<script src="<?php echo base_url(); ?>assets/js/dropzone.js"></script>
<?php
    if($this->uri->segment(3) == "dlt"){
?>
<script>swal("Berita berhasil dihapus");</script>
<?php } ?>

<script>
$('#isi_berita').summernote({
    placeholder: 'Tulis Isi Berita Disini',
    height: 370,
    dialogsInBody: true,
    dialogsFade: false
});

$('#spinner').hide();
$('#filter_alumni').DataTable();

$('#tambah_beritaform').submit(function(e){
    e.preventDefault();
    $.ajax({
        url : '<?php echo base_url('main/tambahberita_action'); ?>',
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
            $('#tambah_beritaform').trigger("reset");
            swal(data);
            $('#isi_berita').summernote('code', '');
        }, 
        error : function(data){
            console.log(data);
        }
    });
});

$('#list_berita').DataTable({
    "processing" : true,
    "serverSide" : true,
    "responsive" : true,
    "order" : [],
    "ajax" : {
        'url' : '<?php echo base_url('main/listberita') ?>',
        'type' : 'POST'
    },
    "columnDefs":[
        {
            'target':[0],
            'orderable':false
        }
    ]
});

$('#editberita_form').submit(function(e){
    e.preventDefault();
    $.ajax({
        url : '<?php echo base_url('main/editberita_action'); ?>',
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
            $('#editberita_form').trigger("reset");
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



</script>
</body>
</html>