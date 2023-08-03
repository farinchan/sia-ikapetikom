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


<script>
$('#list_donasi').DataTable();
</script>
</body>
</html>