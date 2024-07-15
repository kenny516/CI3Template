<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title">Liste</h5>
                        Ajouter
                    <a type="button" href="<?= site_url('BackOffice/services/form') ?>" class="btn btn-primary">
                    <i class="ms-1 bi bi-plus-circle"></i>
                    </a>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Identifiant</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Durée</th>
                        <th scope="col">Prix</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($services as $service): ?>
                        <tr>
                            <td><?= $service['id_service'] ?></td>
                            <td><?= $service['nom'] ?></td>
                            <td><?= $service['duree'] ?></td>
                            <td><?= $service['prix'] ?></td>
                            <td class="d-flex justify-content-evenly">
                                <a href="<?= site_url('BackOffice/services/form/' . $service['id_service']) ?>" type="button" class="btn btn-dark" ><i class="bi bi-pencil-fill"></i></a>
                                <a href="<?= site_url('BackOffice/services/delete/' . $service['id_service']) ?>" type="button" class="btn btn-danger"><i class="bi bi-trash-fill"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
