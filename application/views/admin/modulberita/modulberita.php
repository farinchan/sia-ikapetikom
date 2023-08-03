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

    $('#isi_berita').summernote({
        placeholder: 'Tulis Isi Berita Disini',
        height: 450,
        dialogsInBody: true,
        dialogsFade: false
    });

    $('#edit_kategoriberita').submit(function(e){
        e.preventDefault();
        $.ajax({
            url : '<?php echo base_url('admin/ModulBerita/editkategori_action') ?>',
            data : $('#edit_kategoriberita').serialize(),
            type : 'POST',
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
            }
        });
    });

    $('#tambah_kategoriberita').submit(function(e){
        e.preventDefault();
        $.ajax({
            url : '<?php echo base_url('admin/ModulBerita/tambahkategori_action') ?>',
            data : $('#tambah_kategoriberita').serialize(),
            type : 'POST',
            beforeSend : function(){
                $('#spinner').show();
            },
            complete : function(){
                $('#spinner').hide();
            },
            success : function(data){
                swal(data)
                .then((value) => {
                    $('#tambah_kategoriberita').trigger("reset");
                });
            }
        });
    });

    $('#tambah_beritaform').submit(function(e){
        e.preventDefault();
        $.ajax({
            url : '<?php echo base_url('admin/ModulBerita/tambahberita_action') ?>',
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

        $('#editberita_form').submit(function(e){
        e.preventDefault();
        $.ajax({
            url : '<?php echo base_url('admin/ModulBerita/editberita_action'); ?>',
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


    $('#list_berita').DataTable({
        "processing" : true,
        "serverSide" : true,
        "responsive" : true,
        "order" : [],
        "ajax" : {
            'url' : '<?php echo base_url('admin/ModulBerita/listberita') ?>',
            'type' : 'POST'
        },
        "columnDefs":[
            {
                'target':[0],
                'orderable':false
            }
        ]
    });

    $('#kontribusi_berita').DataTable({
        "processing" : true,
        "serverSide" : true,
        "responsive" : true,
        "order" : [],
        "ajax" : {
            'url' : '<?php echo base_url('admin/ModulBerita/listkontribusiberita') ?>',
            'type' : 'POST'
        },
        "columnDefs":[
            {
                'target':[0],
                'orderable':false
            }
        ]
    });
});
</script>
</body>
</html>
