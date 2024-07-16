<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Import CSV</h5>
                <form action="<?= site_url('Back_office_config/process_import') ?>" method="post" enctype="multipart/form-data">
                    <div class="row mb-3">
                        <label for="service" class="col-sm-2 col-form-label">Services</label>
                        <div class="col-sm-10">
                            <input type="file" name="service" id="service" class="form-control">
                            <?= form_error('service', '<div class="text-danger">', '</div>'); ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="travaux" class="col-sm-2 col-form-label">Travaux</label>
                        <div class="col-sm-10">
                            <input type="file" name="travaux" id="travaux" class="form-control">
                            <?= form_error('travaux', '<div class="text-danger">', '</div>'); ?>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary px-4 fw-bold">Importer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Date de référence</h5>
                <form class="row gx-3" action="<?= base_url('BackOffice/dashboard/reference_date') ?>" method="post">
                    <div class="col-12 mb-3">
                        <label for="reference_date" class="form-label">Choisir une date</label>
                        <input type="date" class="form-control" name="reference_date" id="reference_date" value="<?= $this->session->userdata('reference_date') ?>" required>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary px-4 fw-bold">Modifier</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
