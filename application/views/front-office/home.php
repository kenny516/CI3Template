<div class="container-fluid p-0" style="margin-bottom: 90px;">
    <div id="header-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="w-100" src="<?= base_url('assets/img/carousel-1.jpg'); ?>" alt="Image">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 900px;">
                        <h4 class="text-white text-uppercase mb-md-3">Réparation Automobile</h4>
                        <h1 class="display-1 text-white mb-md-4">Les Meilleurs Services de Réparation dans Votre Région</h1>
                        <a href="<?= site_url('front-office/Appointment'); ?>" class="btn btn-primary py-md-3 px-md-5 mt-2">Prendre Rendez-vous</a>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="w-100" src="<?= base_url('assets/img/carousel-2.jpg'); ?>" alt="Image">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 900px;">
                        <h4 class="text-white text-uppercase mb-md-3">Entretien Automobile</h4>
                        <h1 class="display-1 text-white mb-md-4">Qualité et Fiabilité pour Tous Vos Besoins</h1>
                        <a href="<?= site_url('front-office/Appointment'); ?>" class="btn btn-primary py-md-3 px-md-5 mt-2">Prendre Rendez-vous</a>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
            <div class="btn btn-dark" style="width: 45px; height: 45px;">
                <span class="carousel-control-prev-icon mb-n2"></span>
            </div>
        </a>
        <a class="carousel-control-next" href="#header-carousel" data-slide="next">
            <div class="btn btn-dark" style="width: 45px; height: 45px;">
                <span class="carousel-control-next-icon mb-n2"></span>
            </div>
        </a>
    </div>
</div>

<div class="container-fluid py-5">
    <div class="container pt-5 pb-3">
        <h1 class="display-1 text-primary text-center">01</h1>
        <h1 class="display-4 text-uppercase text-center mb-5">Bienvenue à <span class="text-primary">Mada
                    Auto</span></h1>
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <img class="w-75 mb-4" src="<?= base_url('assets/img/about.png'); ?>" alt="">
                <p>Chez Mada Auto, nous offrons des services de réparation et d'entretien de la plus haute qualité. Que ce soit pour une réparation majeure ou un entretien de routine, notre équipe de professionnels expérimentés est là pour vous aider. Nous utilisons uniquement des pièces de qualité supérieure et les dernières technologies pour garantir que votre véhicule fonctionne parfaitement.</p>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-4 mb-2">
                <div class="d-flex align-items-center bg-light p-4 mb-4" style="height: 150px;">
                    <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary ml-n4 mr-4"
                         style="width: 100px; height: 100px;">
                        <i class="fa fa-2x fa-headset text-secondary"></i>
                    </div>
                    <h4 class="text-uppercase m-0">Support 10h/j</h4>
                </div>
            </div>
            <div class="col-lg-4 mb-2">
                <div class="d-flex align-items-center bg-secondary p-4 mb-4" style="height: 150px;">
                    <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary ml-n4 mr-4"
                         style="width: 100px; height: 100px;">
                        <i class="fa fa-2x fa-car text-secondary"></i>
                    </div>
                    <h4 class="text-light text-uppercase m-0">Rendez-vous à nos horaires</h4>
                </div>
            </div>
            <div class="col-lg-4 mb-2">
                <div class="d-flex align-items-center bg-light p-4 mb-4" style="height: 150px;">
                    <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary ml-n4 mr-4"
                         style="width: 100px; height: 100px;">
                        <i class="fa fa-2x fa-map-marker-alt text-secondary"></i>
                    </div>
                    <h4 class="text-uppercase m-0">Nombreux points de service</h4>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Services Start -->
<div class="container-fluid py-5">
    <div class="container pt-5 pb-3">
        <h1 class="display-1 text-primary text-center">02</h1>
        <h1 class="display-4 text-uppercase text-center mb-5">Nos Services</h1>
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-2">
                <div class="service-item d-flex flex-column justify-content-center px-4 mb-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="d-flex align-items-center justify-content-center bg-primary ml-n4"
                             style="width: 80px; height: 80px;">
                            <i class="fa fa-2x fa-car text-secondary"></i>
                        </div>
                        <h1 class="display-2 text-white mt-n2 m-0">01</h1>
                    </div>
                    <h4 class="text-uppercase mb-3">Réparation Automobile</h4>
                    <p class="m-0">Nous offrons des services de réparation complets pour tous les types de véhicules. Nos techniciens qualifiés utilisent des outils modernes pour diagnostiquer et réparer rapidement tout problème.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-2">
                <div class="service-item active d-flex flex-column justify-content-center px-4 mb-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="d-flex align-items-center justify-content-center bg-primary ml-n4"
                             style="width: 80px; height: 80px;">
                            <i class="fa fa-2x fa-oil-can text-secondary"></i>
                        </div>
                        <h1 class="display-2 text-white mt-n2 m-0">02</h1>
                    </div>
                    <h4 class="text-uppercase mb-3">Entretien Régulier</h4>
                    <p class="m-0">Assurez la longévité de votre véhicule avec notre service d'entretien régulier. Nous effectuons des vidanges, des changements de filtres, et bien plus encore pour que votre voiture fonctionne comme neuve.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-2">
                <div class="service-item d-flex flex-column justify-content-center px-4 mb-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="d-flex align-items-center justify-content-center bg-primary ml-n4"
                             style="width: 80px; height: 80px;">
                            <i class="fa fa-2x fa-tools text-secondary"></i>
                        </div>
                        <h1 class="display-2 text-white mt-n2 m-0">03</h1>
                    </div>
                    <h4 class="text-uppercase mb-3">Diagnostic et Réparation</h4>
                    <p class="m-0">Nos experts utilisent les dernières technologies pour diagnostiquer avec précision tout problème mécanique ou électrique et effectuer les réparations nécessaires.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-2">
                <div class="service-item d-flex flex-column justify-content-center px-4 mb-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="d-flex align-items-center justify-content-center bg-primary ml-n4"
                             style="width: 80px; height: 80px;">
                            <i class="fa fa-2x fa-paint-roller text-secondary"></i>
                        </div>
                        <h1 class="display-2 text-white mt-n2 m-0">04</h1>
                    </div>
                    <h4 class="text-uppercase mb-3">Peinture et Carrosserie</h4>
                    <p class="m-0">Redonnez un coup de neuf à votre véhicule avec nos services de peinture et de carrosserie. Nous utilisons des matériaux de haute qualité pour des résultats durables.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-2">
                <div class="service-item d-flex flex-column justify-content-center px-4 mb-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="d-flex align-items-center justify-content-center bg-primary ml-n4"
                             style="width: 80px; height: 80px;">
                            <i class="fa fa-2x fa-spray-can text-secondary"></i>
                        </div>
                        <h1 class="display-2 text-white mt-n2 m-0">05</h1>
                    </div>
                    <h4 class="text-uppercase mb-3">Nettoyage et Détail</h4>
                    <p class="m-0">Gardez votre voiture propre et impeccable avec notre service de nettoyage et de détail. Nous offrons des nettoyages intérieurs et extérieurs complets pour un véhicule éclatant.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-2">
                <div class="service-item d-flex flex-column justify-content-center px-4 mb-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="d-flex align-items-center justify-content-center bg-primary ml-n4"
                             style="width: 80px; height: 80px;">
                            <i class="fa fa-2x fa-wrench text-secondary"></i>
                        </div>
                        <h1 class="display-2 text-white mt-n2 m-0">06</h1>
                    </div>
                    <h4 class="text-uppercase mb-3">Service d'Urgence</h4>
                    <p class="m-0">Nous sommes là pour vous en cas de panne ou d'urgence. Nos techniciens interviennent rapidement pour remettre votre véhicule sur la route le plus vite possible.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Services End -->

<!-- Team Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <h1 class="display-1 text-primary text-center">03</h1>
        <h1 class="display-4 text-uppercase text-center mb-5">Notre équipe</h1>
        <div class="owl-carousel team-carousel position-relative" style="padding: 0 30px;">
            <div class="team-item">
                <div class="position-relative py-4">
                    <h4 class="text-uppercase">RAMAROZATOVO Tahiry Kevin</h4>
                    <p class="m-0">Front-end</p>
                    <div
                        class="team-social position-absolute w-100 h-100 d-flex align-items-center justify-content-center">
                        <a class="btn btn-lg btn-primary btn-lg-square mx-1" href="#"><i
                                class="fab fa-twitter"></i></a>
                        <a class="btn btn-lg btn-primary btn-lg-square mx-1" href="#"><i
                                class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-lg btn-primary btn-lg-square mx-1" href="#"><i
                                class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
            <div class="team-item">
                <div class="position-relative py-4">
                    <h4 class="text-uppercase">MBOLATSIORY Rihantiana Tiarintsoa</h4>
                    <p class="m-0">Back-end et base de données</p>
                    <div
                        class="team-social position-absolute w-100 h-100 d-flex align-items-center justify-content-center">
                        <a class="btn btn-lg btn-primary btn-lg-square mx-1" href="#"><i
                                class="fab fa-twitter"></i></a>
                        <a class="btn btn-lg btn-primary btn-lg-square mx-1" href="#"><i
                                class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-lg btn-primary btn-lg-square mx-1" href="#"><i
                                class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
            <div class="team-item">
                <div class="position-relative py-4">
                    <h4 class="text-uppercase">ANDRIATSIRAFY CHAN Kenny</h4>
                    <p class="m-0">Intégration</p>
                    <div
                        class="team-social position-absolute w-100 h-100 d-flex align-items-center justify-content-center">
                        <a class="btn btn-lg btn-primary btn-lg-square mx-1" href="#"><i
                                class="fab fa-twitter"></i></a>
                        <a class="btn btn-lg btn-primary btn-lg-square mx-1" href="#"><i
                                class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-lg btn-primary btn-lg-square mx-1" href="#"><i
                                class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Team End -->
