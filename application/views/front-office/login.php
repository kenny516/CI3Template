<div class="container-fluid page-header">
    <h1 class="display-3 text-uppercase text-white mb-3">Login</h1>
    <div class="d-inline-flex text-white">
        <h6 class="text-uppercase m-0"><a class="text-white" href="<?= site_url('front-office/Home'); ?>">Home</a></h6>
        <h6 class="text-body m-0 px-3">/</h6>
        <h6 class="text-uppercase text-body m-0">Login</h6>
    </div>
</div>

<div class="container-fluid py-5">
    <div class="container pt-5 pb-3">
        <div class="row justify-content-center">
            <div class="col-lg-6 mb-5">
                <div class="bg-secondary p-5">
                    <h2 class="text-primary mb-4 text-center">Connectez-vous</h2>
                    <form>
                        <div class="form-group mb-4">
                            <input type="text" class="form-control p-4" aria-label="numero-voiture" name="numero-voiture" placeholder="Numéro de voiture" required="required">
                        </div>
                        <div class="form-group mb-4">
                            <select class="custom-select px-4" name="type-voiture" aria-label="type-voiture" style="height: 50px;">
                                <option selected>Type de voiture</option>
                                <option value="2">Location 2</option>
                                <option value="1">4 * 4</option>
                                <option value="3">Location 3</option>
                            </select>
                        </div>
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-block btn-primary py-3" style="font-weight: bold;">Se connecter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
