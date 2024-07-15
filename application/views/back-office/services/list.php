<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Liste</h5>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Identifiant</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Durée</th>
                        <th scope="col">Prix</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($services as $service): ?>
                        <tr>
                            <td><?= $service['id'] ?></td>
                            <td><?= $service['nom'] ?></td>
                            <td><?= $service['duree'] ?></td>
                            <td><?= $service['prix'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
