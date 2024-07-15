<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Liste des devis</h5>
                <table class="table datatable">
                    <thead>
                    <tr>
                        <th>Matricule de voiture</th>
                        <th>Service</th>
                        <th>Slot</th>
                        <th data-type="date" data-format="YYYY/DD/MM">Date de début</th>
                        <th>Date de paiement</th>
                        <th style="display: none;">ID</th> <!-- Colonne cachée pour l'ID -->
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($rendez_vous)): ?>
                        <?php foreach ($rendez_vous as $devis): ?>
                            <tr>
                                <td><?= htmlspecialchars($devis['immatriculation']) ?></td>
                                <td><?= htmlspecialchars($devis['service_nom']) ?></td>
                                <td><?= htmlspecialchars($devis['slot_designation']) ?></td>
                                <td><?= htmlspecialchars($devis['date_debut']) ?></td>
                                <td><?= htmlspecialchars($devis['date_paiement']) ?></td>
                                <td style="display: none;"><?= htmlspecialchars($devis['id']) ?></td> <!-- Colonne cachée pour l'ID -->
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6">No records found.</td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/js/jQuery3.7.1.js') ?>"></script>
<script>
    $(document).ready(function() {
        $('.datatable tbody tr').each(function() {
            const row = $(this);
            const datePaymentCell = row.find('td:nth-child(5)');
            const idCell = row.find('td:nth-child(6)'); // Correction: récupération de l'ID dans la colonne cachée

            if (!datePaymentCell.text().trim()) {
                const dateInput = $('<input>', {
                    type: 'date',
                    class: 'form-control',
                    change: function() {
                        const dateValue = $(this).val();
                        const rendezVousId = idCell.text().trim(); // Récupération de l'ID de la ligne
                        const originalDate = datePaymentCell.text().trim(); // Sauvegarde de la date d'origine

                        $.ajax({
                            url: '<?= site_url("Back_office_quotation/update_paiement") ?>',
                            type: 'POST',
                            data: { id: rendezVousId, date_paiement: dateValue },
                            dataType: 'json', // Spécifiez que la réponse est JSON
                            success: function(response) {
                                if (response.success) {
                                    datePaymentCell.text(dateValue);
                                    console.log('Date de paiement mise à jour avec succès:', response.success);
                                } else {
                                    alert('Erreur lors de la mise à jour de la date de paiement : ' + response.success);
                                    // Réinitialisation de la valeur du champ de formulaire à sa valeur d'origine
                                    $(dateInput).val(originalDate);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error('Erreur lors de la mise à jour de la date de paiement:', error);
                                alert('Erreur lors de la mise à jour de la date de paiement.');
                                // Réinitialisation de la valeur du champ de formulaire à sa valeur d'origine
                                $(dateInput).val(originalDate);
                            }
                        });
                    }
                });
                datePaymentCell.append(dateInput);
            }
        });
    });
</script>
