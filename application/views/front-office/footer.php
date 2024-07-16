<div class="container-fluid bg-secondary py-5 px-sm-3 px-md-5" style="margin-top: 90px;">
    <div class="row justify-content-around pt-5">
        <div class="col-lg-3 col-md-6 mb-5">
            <h4 class="text-uppercase text-light mb-4">Get In Touch</h4>
            <p class="mb-2"><i class="fa fa-map-marker-alt text-white mr-3"></i>123 Street, New York, USA</p>
            <p class="mb-2"><i class="fa fa-phone-alt text-white mr-3"></i>+012 345 67890</p>
            <p><i class="fa fa-envelope text-white mr-3"></i>info@example.com</p>
            <h6 class="text-uppercase text-white py-2">Follow Us</h6>
            <div class="d-flex justify-content-start">
                <a class="btn btn-lg btn-dark btn-lg-square mr-2" href="#"><i class="fab fa-twitter"></i></a>
                <a class="btn btn-lg btn-dark btn-lg-square mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                <a class="btn btn-lg btn-dark btn-lg-square mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                <a class="btn btn-lg btn-dark btn-lg-square" href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-5">
            <h4 class="text-uppercase text-light mb-4">Car Gallery</h4>
            <div class="row mx-n1">
                <?php for($i = 1; $i <= 6; $i++): ?>
                    <div class="col-4 px-1 mb-2">
                        <a href="">
                            <img class="w-100" src="<?= base_url(sprintf('assets/img/gallery-%d.jpg', $i)) ?>" alt="">
                        </a>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid bg-dark py-4 px-sm-3 px-md-5">
    <p class="mb-2 text-center text-body">&copy; <a href="#">Mada Auto</a>. Tous droits réservés.</p>
    <p class="m-0 text-center text-body">
        <a href="#">Kenny ETU00XXXX</a>,
        <a href="#">Kevin ETU002546</a>,
        <a href="#">Tiary ETU003057</a>
    </p>
</div>
