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
                    <?php if($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
                    <?php endif; ?>
                    <?= form_open('front-office/Login/authenticate'); ?>
                    <div class="form-group mb-4">
                        <?= form_input([
                            'name' => 'numero-voiture',
                            'id' => 'numero-voiture',
                            'class' => 'form-control p-4',
                            'type' => 'text',
                            'value' => $numero_voiture ?? '',
                            'placeholder' => "Numéro de voiture"
                        ]); ?>
                        <?= form_error('numero-voiture', '<div class="text-danger">', '</div>'); ?>
                    </div>
                    <div class="form-group mb-4">
                        <select class="custom-select px-4" name="type-voiture" style="height: 50px;">
                            <option value="" selected>Type de voiture...</option>
                            <?php foreach ($type_voiture as $t_v): ?>
                                <option value="<?= $t_v['id_type_voiture'] ?>"><?= $t_v['description'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('type-voiture', '<div class="text-danger">', '</div>'); ?>
                    </div>
                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-block btn-primary py-3" style="font-weight: bold;">Se connecter</button>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
