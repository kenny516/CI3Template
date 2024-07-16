<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <br>
                <form action="<?= site_url('Back_office_csv/process_import') ?>" method="post" enctype="multipart/form-data">
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
</div>
