<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Importation CSV</h5>
                <?= form_open('BackOffice/services/save', ['method' => 'post']); ?>
                <div class="row mb-3">
                    <label for="nom" class="col-sm-2 col-form-label">Services</label>
                    <div class="col-sm-10">
                        <?= form_input([
                            'name' => 'service',
                            'id' => 'service',
                            'class' => 'form-control',
                            'type' => 'file',
                            'value' => $nom ?? ''
                        ]); ?>
                        <?= form_error('service', '<div class="text-danger">', '</div>'); ?>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nom" class="col-sm-2 col-form-label">Travaux</label>
                    <div class="col-sm-10">
                        <?= form_input([
                            'name' => 'travaux',
                            'id' => 'travaux',
                            'class' => 'form-control',
                            'type' => 'file',
                            'value' => $nom ?? ''
                        ]); ?>
                        <?= form_error('travaux', '<div class="text-danger">', '</div>'); ?>
                    </div>
                </div>
                <div>
                    <?= form_submit('submit', 'Importer', ['class' => 'btn btn-primary px-4 fw-bold']); ?>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>
