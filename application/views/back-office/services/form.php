<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Formulaire</h5>
                <?= form_open('BackOffice/services/save', ['method' => 'post']); ?>
                <?= form_input([
                    'name' => 'type',
                    'id' => 'type',
                    'class' => 'form-control',
                    'type' => 'hidden',
                    'value' => isset($id_service) ? 'update' : ''
                ]); ?>
                <?= form_input([
                    'name' => 'id_service',
                    'id' => 'id_service',
                    'class' => 'form-control',
                    'type' => 'hidden',
                    'value' => $id_service ?? ''
                ]); ?>
                <div class="row mb-3">
                    <label for="nom" class="col-sm-2 col-form-label">Nom</label>
                    <div class="col-sm-10">
                        <?= form_input([
                            'name' => 'nom',
                            'id' => 'nom',
                            'class' => 'form-control',
                            'type' => 'text',
                            'value' => $nom ?? ''
                        ]); ?>
                        <?= form_error('nom', '<div class="text-danger">', '</div>'); ?>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="duree" class="col-sm-2 col-form-label">Durée</label>
                    <div class="col-sm-10">
                        <?= form_input([
                            'name' => 'duree',
                            'id' => 'duree',
                            'class' => 'form-control',
                            'type' => 'time',
                            'value' => $duree ?? ''
                        ]); ?>
                        <?= form_error('duree', '<div class="text-danger">', '</div>'); ?>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="prix" class="col-sm-2 col-form-label">Prix</label>
                    <div class="col-sm-10">
                        <?= form_input([
                            'name' => 'prix',
                            'id' => 'prix',
                            'class' => 'form-control',
                            'type' => 'number',
                            'value' => $prix ?? ''
                        ]); ?>
                        <?= form_error('prix', '<div class="text-danger">', '</div>'); ?>
                    </div>
                </div>
                <div>
                    <?= form_submit('submit', 'Soumettre', ['class' => 'btn btn-primary px-4 fw-bold']); ?>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>
