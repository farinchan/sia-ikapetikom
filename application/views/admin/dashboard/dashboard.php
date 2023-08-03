<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('admin/partisi/head.php'); ?>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
<?php $this->load->view('admin/partisi/navbar.php'); ?>
<?php $this->load->view('admin/partisi/sidebar.php'); ?>

<?php $this->load->view('admin/dashboard/content.php'); ?>
<?php $this->load->view('admin/partisi/footer.php') ?>
</div>
<?php $this->load->view('admin/partisi/js.php') ?>
<script>
    $('#Loglogin').DataTable({
        "processing" : true,
        "serverSide" : true,
        "responsive" : true,
        "pageLength" : 6,
        "lengthChange": false,
        "searching" : false,
        "order" : [],
        "ajax" : {
            'url' : '<?php echo base_url('admin/dashboard/loglogin') ?>',
            'type' : 'POST'
        },
        "columnDefs":[
            {
                'target':[0],
                'orderable':false
            }
        ]
    });
</script>
</body>
</html>
