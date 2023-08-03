<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<?php foreach ($web as $x): ?>
<title><?php echo $this->session->flashdata('location'); ?> - <?php echo $x->nama_website; ?></title>
<meta content="" name="description">
<meta content="" name="keywords">

<!-- Favicons -->
<link href="<?php echo base_url('assets/img/'.$x->logo) ?>" rel="icon" type="image/gif" sizes="16x16">
<?php endforeach; ?>
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
<link href="<?php echo base_url('assets/vendor/aos/aos.css') ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/vendor/bootstrap-icons/bootstrap-icons.css') ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/vendor/boxicons/css/boxicons.min.css') ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/vendor/glightbox/css/glightbox.min.css') ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/vendor/swiper/swiper-bundle.min.css') ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/css/style.css') ?>" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url('assets/css/mycss.css') ?>">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
<link rel="stylesheet" href="<?= base_url() ?>assets/leaflet/leaflet-search/dist/leaflet-search.src.css" />
    <style>
        #map { height: 550px; }
    </style>
    </style>


</head>