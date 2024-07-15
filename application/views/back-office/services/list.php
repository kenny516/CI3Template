<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title">Liste</h5>
                    <a type="button" href="#" class="btn btn-primary">
                        Ajouter
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
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($services as $service): ?>
                        <tr>
                            <td><?= $service['id_service'] ?></td>
                            <td><?= $service['nom'] ?></td>
                            <td><?= $service['duree'] ?></td>
                            <td><?= $service['prix'] ?></td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Modifier</a></li>
                                        <li><a class="dropdown-item" href="#">Supprimer</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
