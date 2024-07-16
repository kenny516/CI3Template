<div class="dashboard">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body pb-0">
                    <h5 class="card-title">Illustration des paiements</h5>
                    <div id="chart" style="min-height: 400px;" class="echart"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="col-xxl-12">
                <div class="card info-card revenue-card">
                    <div class="card-body">
                        <h5 class="card-title">Chiffre d'affaire total</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-currency-dollar"></i>
                            </div>
                            <div class="ps-3">
                                <h6 id="chiffre-affaire"></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="card top-selling overflow-auto">
                <div class="card-body pb-0">
                    <h5 class="card-title">Chiffre d'affaire par type de voiture</h5>
                    <table class="table table-borderless">
                        <thead>
                        <tr>
                            <th scope="col">Désignation</th>
                            <th scope="col">Revenu</th>
                        </tr>
                        </thead>
                        <tbody id="car-revenue-table">
                        <tr></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card info-card customers-card">
                <div class="card-body">
                    <h5 class="card-title">Voitures traitées par jour</h5>
                    <div class="d-flex align-items-center mb-3">
                        <input type="date" id="date-input" class="form-control" name="date" aria-label="date">
                        <button type="button" id="date-submit" class="btn btn-primary ms-4 text-nowrap">Voir résultats</button>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="ps-3">
                            <h6 id="cars-treated">Aucun pour le moment</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function initChart(montantPaye, montantImpaye) {
        const chart = echarts.init(document.querySelector("#chart"));
        chart.setOption({
            tooltip: {
                trigger: 'item'
            },
            legend: {
                top: '5%',
                left: 'center'
            },
            series: [{
                name: 'Paiement',
                type: 'pie',
                radius: ['40%', '70%'],
                avoidLabelOverlap: false,
                label: {
                    show: false,
                    position: 'center'
                },
                emphasis: {
                    label: {
                        show: true,
                        fontSize: '18',
                        fontWeight: 'bold'
                    }
                },
                labelLine: {
                    show: false
                },
                data: [
                    {
                        value: montantPaye,
                        name: 'Payés'
                    },
                    {
                        value: montantImpaye,
                        name: 'Impayés'
                    }
                ]
            }]
        });
    }

    $(document).ready(function() {
        const date_reference = '<?= $reference_date ?>';
        $.when(
            $.ajax({
                url: '<?= site_url('Back_office_dashboard/montantPayeParDateReference'); ?>',
                type: 'POST',
                data: {date_reference: date_reference},
                dataType: 'json'
            }),
            $.ajax({
                url: '<?= site_url('Back_office_dashboard/montantImpayeParDateReference'); ?>',
                type: 'POST',
                data: {date_reference: date_reference},
                dataType: 'json'
            }),
            $.ajax({
                url: '<?= site_url('Back_office_dashboard/chiffreAffaireParTypeVoiture'); ?>',
                type: 'POST',
                dataType: 'json',
                success: function(data) {
                    let totalRevenue = 0;
                    let rows = '';
                    data.forEach(item => {
                        totalRevenue += parseFloat(item.chiffre_affaire_par_type_voiture);
                        rows += `<tr>
                                    <td><a href="#" class="text-primary fw-bold">${item.description_type_voiture}</a></td>
                                    <td class="fw-bold">${item.chiffre_affaire_par_type_voiture} Ar</td>
                                </tr>`;
                    });
                    $('#chiffre-affaire').text(`${totalRevenue} Ar`);
                    $('#car-revenue-table').html(rows);
                }
            })
        ).done(function(paidData, unpaidData) {
            initChart(paidData[0].montant_paye_par_date_reference, unpaidData[0].montant_impaye_par_date_reference);
        });
    });

    $('#date-submit').click(function() {
        const date_details = $('#date-input').val();
        $.ajax({
            url: '<?= site_url('Back_office_dashboard/voituresTraiteesParDate'); ?>',
            type: 'POST',
            data: {date_details: date_details},
            dataType: 'json',
            success: function(data) {
                const nbVoitures = data === null ? 0 : data.nb_voitures;
                $('#cars-treated').text(nbVoitures);
            }
        });
    });
</script>
