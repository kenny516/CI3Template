<div class="row">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Utilisation par jour</h5>
            <div class="row mb-3">
                <div class="col-lg-3">
                    <input type="date" id="date-input" class="form-control" name="date" aria-label="date">
                    <div class="invalid-feedback">
                        Vous devez entrer une date
                    </div>
                </div>
                <div class="col-lg-3">
                    <button type="button" id="fetch-button" class="btn btn-primary ms-4 text-nowrap">Voir résultats</button>
                </div>
            </div>
            <ul class="nav nav-tabs nav-tabs-bordered d-flex" id="borderedTabJustified" role="tablist">
                <li class="nav-item flex-fill" role="presentation">
                    <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-slot-A" type="button" role="tab" aria-controls="home" aria-selected="true">Slot A</button>
                </li>
                <li class="nav-item flex-fill" role="presentation">
                    <button class="nav-link w-100" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-slot-B" type="button" role="tab" aria-controls="profile" aria-selected="false">Slot B</button>
                </li>
                <li class="nav-item flex-fill" role="presentation">
                    <button class="nav-link w-100" id="contact-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-slot-C" type="button" role="tab" aria-controls="contact" aria-selected="false">Slot C</button>
                </li>
            </ul>
            <div class="tab-content pt-4" id="borderedTabJustifiedContent">
                <div class="tab-pane fade show active" id="bordered-justified-slot-A" role="tabpanel">
                    <ol class="list-group list-group-numbered" id="slot-A-content"></ol>
                </div>
                <div class="tab-pane fade" id="bordered-justified-slot-B" role="tabpanel">
                    <ol class="list-group list-group-numbered" id="slot-B-content"></ol>
                </div>
                <div class="tab-pane fade" id="bordered-justified-slot-C" role="tabpanel">
                    <ol class="list-group list-group-numbered" id="slot-C-content"></ol>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#fetch-button').click(function() {
            const date = $('#date-input').val();
            if (!date) {
                $('#date-input').addClass('is-invalid');
                return;
            } else {
                $('#date-input').removeClass('is-invalid');
            }

            $.ajax({
                url: '<?= site_url('Back_office_slot/fetch_data'); ?>',
                type: 'POST',
                data: {date: date},
                dataType: 'json',
                success: function(response) {
                    $('#slot-A-content').empty();
                    $('#slot-B-content').empty();
                    $('#slot-C-content').empty();

                    // Parcourir les résultats et remplir les slots
                    $.each(response, function(slot, appointments) {
                        $.each(appointments, function(index, appointment) {
                            var listItem = '<li class="list-group-item d-flex justify-content-between align-items-start">' +
                                '<div class="ms-2 me-auto">' +
                                '<div class="fw-bold">Matricule: ' + appointment.matricule_voiture + '</div>' +
                                '<span>Date de début: ' + appointment.date_debut + '</span>' +
                                '</div>' +
                                '<span class="badge bg-primary rounded-pill">' + appointment.type_service + '</span>' +
                                '</li>';

                            if (slot === 'A') {
                                $('#slot-A-content').append(listItem);
                            } else if (slot === 'B') {
                                $('#slot-B-content').append(listItem);
                            } else if (slot === 'C') {
                                $('#slot-C-content').append(listItem);
                            }
                        });
                    });
                }
            });
        });
    });
</script>
