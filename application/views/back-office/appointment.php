<style>
    #calendar td.fc-day:hover {
        cursor: pointer;
    }
</style>

<div id="calendar"></div>
<div class="modal fade" id="appointmentModal" tabindex="-1" aria-labelledby="appointmentModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Ajouter un rendez-vous</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="appointmentForm">
                    <div class="mb-3">
                        <label for="voiture" class="form-label small">Voitures</label>
                        <select id="voiture" name="voiture" class="form-select" required>
                            <option selected>Choisir une voiture...</option>
                            <?php foreach ($voitures as $voiture): ?>
                                <option value="<?= $voiture['id_voiture'] ?>"><?= $voiture['immatriculation'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="service" class="form-label small">Types de services</label>
                        <select id="service" name="service" class="form-select" required>
                            <option selected>Choisir un service...</option>
                            <?php foreach ($services as $service): ?>
                                <option value="<?= $service['id_service'] ?>"><?= $service['nom'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="date-debut" class="form-label small">Date de début</label>
                        <input type="datetime-local" class="form-control" id="date-debut" name="date-debut">
                    </div>
                    <button type="submit" class="btn btn-primary fw-bold">Confirmer</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/js/index.global.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/jQuery3.7.1.js') ?>"></script>
<script>
    let calendar;
    const calendarElement = document.getElementById('calendar');
    const appointmentModalElement = document.getElementById('appointmentModal');

    document.addEventListener('DOMContentLoaded', function () {
        calendar = new FullCalendar.Calendar(calendarElement, {
            initialDate: '2023-01-12',
            initialView: 'dayGridMonth',
            nowIndicator: true,
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek'
            },
            navLinks: true,
            selectMirror: true,
            editable: true,
            dayMaxEvents: true,
            dateClick: function (info) {
                // Extract date part from info.dateStr and create a new Date object
                const dateDebut = new Date(info.dateStr);

                // Set the time to 08:00 AM
                dateDebut.setHours(8, 0, 0, 0); // Hours, Minutes, Seconds, Milliseconds

                // Convert the date to local time zone
                const localFormattedDate = `${dateDebut.getFullYear()}-${String(dateDebut.getMonth() + 1).padStart(2, '0')}-${String(dateDebut.getDate()).padStart(2, '0')}T${String(dateDebut.getHours()).padStart(2, '0')}:${String(dateDebut.getMinutes()).padStart(2, '0')}`;

                // Set the value of the date-debut input field
                document.getElementById('date-debut').value = localFormattedDate;

                // Show the appointment modal
                const appointmentModal = new bootstrap.Modal(appointmentModalElement, {
                    keyboard: false
                });
                appointmentModal.show();
            },
            dayCellDidMount: function (arg) {
                arg.el.classList.add('fc-day');
            },
            events: '<?= base_url('BackOffice/appointments/calendar') ?>' // Load events from the server
        });

        calendar.render();
    });

    // Handle form submission
    document.getElementById('appointmentForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const voiture = document.getElementById('voiture').value;
        const service = document.getElementById('service').value;
        const dateDebut = document.getElementById('date-debut').value.replace("T"," ")+":00";

        $.ajax({
            url: '<?= site_url('Back_office_rendez_vous/add_appointment') ?>',
            type: 'POST',
            data: {
                voiture: voiture,
                service: service,
                dateDebut: dateDebut
            },
            success: function(response) {
                const res = JSON.parse(response);
                const messageDiv = document.getElementById('messages');
                if (res.status === 'success') {
                    messageDiv.innerHTML = `<div class="alert alert-success">${res.message}</div>`;

                    // Mettre à jour le calendrier avec le nouveau rendez-vous
                    calendar.addEvent({
                        title: voiture + ' - ' + service,
                        start: dateDebut,
                    });
                    console.log("verification"+res.status);

                    // Réinitialiser le formulaire
                    document.getElementById('appointmentForm').reset();
                } else {
                    alert('Tous les slot est pris a cette date');
                    messageDiv.innerHTML = `<div class="alert alert-danger">${res.message}</div>`;
                }
            },
        });
    });
</script>
