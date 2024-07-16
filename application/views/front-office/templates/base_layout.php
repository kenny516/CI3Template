<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Mada Auto</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <link href="<?= base_url('assets/img/favicon.png'); ?>" rel="icon">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Rubik&display=swap"
          rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">

    <link href="<?= base_url('assets/vendor/owlcarousel/assets/owl.carousel.min.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/tempusdominus/css/tempusdominus-bootstrap-4.min.css'); ?>" rel="stylesheet" />

    <link href="<?= base_url('assets/css/bootstrap-4.min.css') ?>" rel="stylesheet">

    <link href="<?= base_url('assets/css/frontoffice-style.css'); ?>" rel="stylesheet">
</head>

<body>
<?php $this->load->view(FRONT_OFFICE_VIEW_FOLDER . 'templates/header'); ?>

<?php $this->load->view($content); ?>

<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="owl-carousel vendor-carousel">
           <?php for ($i = 1; $i <= 8; $i++): ?>
                <div class="bg-light p-4">
                    <img src="<?= base_url(sprintf('assets/img/vendor-%d.png', $i)); ?>" alt="">
                </div>
           <?php endfor; ?>
        </div>
    </div>
</div>

<?php $this->load->view(FRONT_OFFICE_VIEW_FOLDER . 'templates/footer'); ?>

<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>

<script src="<?= base_url('assets/js/jQuery3.7.1.js'); ?>"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets/vendor/easing/easing.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/waypoints/waypoints.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/owlcarousel/owl.carousel.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/tempusdominus/js/moment.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/tempusdominus/js/moment-timezone.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/tempusdominus/js/tempusdominus-bootstrap-4.min.js'); ?>"></script>

<script src="<?= base_url('assets/js/frontoffice-main.js'); ?>"></script>
</body>

</html>
