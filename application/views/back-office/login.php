<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Login - Back Office</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <link href="<?= base_url('assets/img/favicon.png') ?>" rel="icon">
    <link href="<?= base_url('assets/img/apple-touch-icon.png') ?>" rel="apple-touch-icon">

    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <link href="<?= base_url('assets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/bootstrap-icons/bootstrap-icons.css') ?>" rel="stylesheet">

    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
</head>

<body>
<main>
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                        <div class="d-flex justify-content-center py-4">
                            <a href="" class="logo d-flex align-items-center w-auto">
                                <img src="<?= base_url('assets/img/logo.png') ?>" alt="">
                                <span class="d-none d-lg-block">Mada Auto</span>
                            </a>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Login du Back Office</h5>
                                    <p class="text-center small">Entrer vos identifiants pour vous connecter</p>
                                </div>

                                <?= form_open('backoffice/verify_login',
                                    array(
                                        'class' => 'row g-3',
                                        'method' => 'post'
                                    )); ?>
                                <div class="col-12">
                                    <label for="email" class="form-label">Email</label>
                                    <?= form_input(array(
                                        'type' => 'email',
                                        'name' => 'email',
                                        'class' => 'form-control',
                                        'id' => 'email',
                                        'required' => 'required',
                                        'value' =>'admin@gmail.com'
                                    )); ?>
                                    <div class="invalid-feedback">
                                        Entrer un email valide
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="password" class="form-label">Mot de passe</label>
                                    <?= form_password(array(
                                        'name' => 'password',
                                        'class' => 'form-control',
                                        'id' => 'password',
                                        'required' => 'required',
                                        'value' =>'admin123'
                                    )); ?>
                                    <div class="invalid-feedback">
                                        Veuillez entrer votre mot de passe !
                                    </div>
                                </div>
                                <div class="col-12">
                                    <?= form_submit(array(
                                        'name'  => 'submit',
                                        'value' => 'Connexion',
                                        'class' => 'btn btn-primary w-100 fw-bold p-2'
                                    )); ?>
                                </div>

                                <?php
                                var_dump($this->session->userdata("user"));
                                $error_message = $this->session->flashdata('error');
                                ?>
                                <?php if (!empty($error_message)) : ?>
                                    <div class="col-12">
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <i class="bi bi-exclamation-octagon me-1"></i>
                                            <?= $error_message ?>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?= form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

<script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
</body>

</html>
