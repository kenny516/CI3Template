<div class="container-fluid page-header">
    <h1 class="display-3 text-uppercase text-white mb-3">Rendez-vous</h1>
    <div class="d-inline-flex text-white">
        <h6 class="text-uppercase m-0"><a class="text-white" href="<?= site_url('front-office/Home'); ?>">Home</a></h6>
        <h6 class="text-body m-0 px-3">/</h6>
        <h6 class="text-uppercase text-body m-0">Rendez-vous</h6>
    </div>
</div>

<div class="container-fluid pb-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <h2 class="mb-4">Formulaire</h2>
                <?= form_open('rendezvous/submit'); ?>
                <div class="mb-5">
                    <div class="row">
                        <div class="col-6 form-group">
                            <select class="custom-select px-4" style="height: 50px;" name="service" aria-label="service">
                                <option selected>Type de service</option>
                                <option value="1">Location 1</option>
                                <option value="2">Location 2</option>
                                <option value="3">Location 3</option>
                            </select>
                        </div>
                        <div class="col-6 form-group">
                            <select class="custom-select px-4" style="height: 50px;" name="slot" aria-label="slot">
                                <option selected>Choix de slot</option>
                                <option value="1">Slot 1</option>
                                <option value="2">Slot 2</option>
                                <option value="3">Slot 3</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 form-group">
                            <div class="date" id="date2" data-target-input="nearest">
                                <input type="text" class="form-control p-4 datetimepicker-input" name="date-debut" aria-label="date-debut" placeholder="Date de début"
                                       data-target="#date2" data-toggle="datetimepicker"/>
                            </div>
                        </div>
                        <div class="col-6 form-group">
                            <div class="time" id="time2" data-target-input="nearest">
                                <input type="text" class="form-control p-4 datetimepicker-input" name="heure-debut" aria-label="heure-debut" placeholder="Heure"
                                       data-target="#time2" data-toggle="datetimepicker"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                    </div>
                    <button class="btn btn-block btn-primary py-3" type="submit">Confirmer</button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>
