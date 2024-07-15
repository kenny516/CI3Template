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
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Unity Pugh</td>
                        <td>9958</td>
                        <td>Curicó</td>
                        <td>2005/02/11</td>
                        <td>2005-02-11</td>
                    </tr>
                    <tr>
                        <td>Theodore Duran</td>
                        <td>8971</td>
                        <td>Dhanbad</td>
                        <td>1999/04/07</td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const table = document.querySelector('.datatable tbody');

        table.querySelectorAll('tr').forEach(row => {
            const datePaymentCell = row.children[4];
            if (!datePaymentCell.innerText.trim()) {
                const dateInput = document.createElement('input');
                dateInput.type = 'date';
                dateInput.className = 'form-control';
                dateInput.addEventListener('change', function() {
                    datePaymentCell.innerText = dateInput.value;
                });
                datePaymentCell.appendChild(dateInput);
            }
        });
    });
</script>
