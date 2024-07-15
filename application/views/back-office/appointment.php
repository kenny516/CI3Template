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
                        <select id="voiture" name="voiture" class="form-select">
                            <option>Jean marc 12 chevaux</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="service" class="form-label small">Types de services</label>
                        <select id="service" name="service" class="form-select">
                            <option>Service 1</option>
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
<script>
    let calendar;
    const calendarElement = document.getElementById('calendar');
    const appointmentModalElement = document.getElementById('appointmentModal');

    document.addEventListener('DOMContentLoaded', function() {
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
            dateClick: function(info) {
                document.getElementById('date-debut').value = info.startStr;
                const appointmentModal = new bootstrap.Modal(appointmentModalElement, {
                    keyboard: false
                });
                appointmentModal.show();
            },
            dayCellDidMount: function(arg) {
                arg.el.classList.add('fc-day');
            },
            events: []
        });

        calendar.render();
    });

    // Handle form submission
    document.getElementById('appointmentForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const voiture = document.getElementById('voiture').value;
        const service = document.getElementById('service').value;
        const dateDebut = document.getElementById('date-debut').value;

        console.log(dateDebut)
        calendar.addEvent({
            title: voiture + ' - ' + service,
            start: dateDebut,
        });

        const modal = bootstrap.Modal.getInstance(appointmentModalElement);
        modal.hide();
    });
</script>
