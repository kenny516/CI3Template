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
                <?php if($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
                <?php endif; ?>
                <?php if($this->session->flashdata('success')): ?>
                    <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
                <?php endif; ?>
                <?= form_open('front-office/Appointment/submit'); ?>
                <div class="mb-5">
                    <div class="row">
                        <div class="col-12 form-group">
                            <select class="custom-select px-4" style="height: 50px;" name="service" aria-label="service">
                                <option value="" selected>Type de service...</option>
                                <?php foreach ($services as $service): ?>
                                    <option value="<?= $service['id_service'] ?>"><?= $service['nom'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('service', '<div class="text-danger">', '</div>'); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 form-group">
                            <div class="date" id="date2" data-target-input="nearest">
                                <input type="text" class="form-control p-4 datetimepicker-input" name="date-debut" aria-label="date-debut" placeholder="Date de début"
                                       data-target="#date2" data-toggle="datetimepicker"/>
                                <?= form_error('date-debut', '<div class="text-danger">', '</div>'); ?>
                            </div>
                        </div>
                        <div class="col-6 form-group">
                            <div class="time" id="time2" data-target-input="nearest">
                                <input type="text" class="form-control p-4 datetimepicker-input" name="heure-debut" aria-label="heure-debut" placeholder="Heure"
                                       data-target="#time2" data-toggle="datetimepicker"/>
                                <?= form_error('heure-debut', '<div class="text-danger">', '</div>'); ?>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-block btn-primary py-3" type="submit">Confirmer</button>
                </div>
                <?= form_close(); ?>
            </div>
            <div class="col-lg-4">
                <div class="bg-secondary p-5 mb-5">
                    <h2 class="text-primary mb-4">Exportation en PDF</h2>
                    <a href="<?= base_url('FrontOffice/quotation/pdf') ?>" class="btn btn-block btn-primary py-3">Exporter</a>
                </div>
            </div>
        </div>
    </div>
</div>
