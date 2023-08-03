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
    $('#KategoriDonasi').DataTable();
    $('#SuksesDonasi').DataTable();
    $('#Rekening').DataTable();
    $('#spinner').hide();

    $('#DataDonasi').DataTable({
        "processing" : true,
        "serverSide" : true,
        "responsive" : true,
        "order" : [],
        "ajax" : {
            'url' : '<?php echo base_url('admin/ModulDonasi/listdonasi') ?>',
            'type' : 'POST'
        },
        "columnDefs":[
            {
                'target':[0],
                'orderable':false
            }
        ]
    });

    $('#KontribusiDonasi').DataTable({
        "processing" : true,
        "serverSide" : true,
        "responsive" : true,
        "order" : [],
        "ajax" : {
            'url' : '<?php echo base_url('admin/ModulDonasi/listkontribusi') ?>',
            'type' : 'POST'
        },
        "columnDefs":[
            {
                'target':[0],
                'orderable':false
            }
        ]
    });

    $('#DonasiSelesai').DataTable({
        "processing" : true,
        "serverSide" : true,
        "responsive" : true,
        "order" : [],
        "ajax" : {
            'url' : '<?php echo base_url('admin/ModulDonasi/listdonasiselesai') ?>',
            'type' : 'POST'
        },
        "columnDefs":[
            {
                'target':[0],
                'orderable':false
            }
        ]
    });

    $('#tambah_rekening').submit(function(e){
        e.preventDefault();

        $.ajax({
            url : '<?php echo base_url('admin/ModulDonasi/tambahrekening_action')?>',
            type : 'POST',
            data : $(this).serialize(),
            beforeSend : function(){
                $('#spinner').show();
            },
            complete : function(){
                $('#spinner').hide();
            },
            success : function(data){
                $('#tambah_rekening').trigger("reset");
                swal(data);
            }

        });
    });

    $('#edit_rekening').submit(function(e){
        e.preventDefault();
        $.ajax({
            url : '<?php echo base_url('admin/ModulDonasi/editrekening_action')?>',
            type : 'POST',
            data : $(this).serialize(),
            beforeSend : function(){
                $('#spinner').show();
            },
            complete : function(){
                $('#spinner').hide();
            },
            success : function(data){
                $('#edit_rekening').trigger("reset");
                swal(data)
                .then((value) => {
                    location.reload();
                })
            }

        });

    })

    $('#edit_kategoridonasi').submit(function(e){
        e.preventDefault();
        $.ajax({
            data : $(this).serialize(),
            type : 'POST',
            url : '<?php echo base_url('admin/ModulDonasi/editkategori_action') ?>',
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

    $('#tambah_kategoridonasi').submit(function(e){
        e.preventDefault();
        $.ajax({
            data : $(this).serialize(),
            type : 'POST',
            url : '<?php echo base_url('admin/ModulDonasi/tambahkategori_action') ?>',
            beforeSend : function(){
                $('#spinner').show();
            },
            complete : function(){
                $('#spinner').hide();
            },
            success : function(data){
                swal(data);
                $('#tambah_kategoridonasi').trigger("reset");
            }
        });
    });

    $('#update_statusbayar').submit(function(e){
        e.preventDefault();
        $.ajax({
            url : '<?php echo base_url('admin/ModulDonasi/perbaruhistatus') ?>',
            type : 'POST',
            beforeSend : function(){
                $('#spinner').show();
            },
            complete : function(){
                $('#spinner').hide();
            },
            data : $('#update_statusbayar').serialize(),
            success : function(data){
                swal(data)
                .then((value) => {
                    location.reload();
                });
            }
            
        })
    })

    $('#tambah_donasi').submit(function(e){
        e.preventDefault();
        $.ajax({
            url : '<?php echo base_url('admin/ModulDonasi/tambahdonasi_action'); ?>',
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
                $('#tambah_donasi').trigger("reset");
                swal(data);
            }, 
            error : function(data){
                console.log(data);
            }
        });
    });

    $('#edit_donasi').submit(function(e){
        e.preventDefault();
        $.ajax({
            url : '<?php echo base_url('admin/ModulDonasi/editdata_action'); ?>',
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
                $('#edit_donasi').trigger("reset");
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
