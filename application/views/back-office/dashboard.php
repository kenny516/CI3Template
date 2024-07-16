<div class="dashboard">
    <div class="row">
        <div class="col-lg-9">
            <div class="card">
                <div class="card-body pb-0">
                    <h5 class="card-title">Illustration des paiements</h5>
                    <div id="chart" style="min-height: 400px;" class="echart"></div>

                    <script>
                        document.addEventListener("DOMContentLoaded", () => {
                            echarts.init(document.querySelector("#chart")).setOption({
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
                                            value: 1048, // Montant payé
                                            name: 'Payés'
                                        },
                                        {
                                            value: 735, // Montant impayé
                                            name: 'Impayés'
                                        }
                                    ]
                                }]
                            });
                        });
                    </script>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="col-xxl-12">
                <div class="card info-card revenue-card">
                    <div class="card-body">
                        <h5 class="card-title">Chiffre d'affaire total</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-currency-dollar"></i>
                            </div>
                            <div class="ps-3">
                                <h6>3,264 Ar</h6>
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
                        <tbody>
                        <tr>
                            <td>
                                <a href="#" class="text-primary fw-bold">Ut inventore ipsa voluptas nulla</a>
                            </td>
                            <td class="fw-bold">6 Ar</td>
                        </tr>
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
                        <input type="date" class="form-control" name="date" aria-label="date">
                        <button type="button" class="btn btn-primary ms-4 text-nowrap">Voir résultats</button>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="ps-3">
                            <h6>25</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
