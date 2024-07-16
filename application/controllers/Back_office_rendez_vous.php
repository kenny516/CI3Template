<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Back_office_rendez_vous extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('DetailsRendezVous_model');
    }

    public function fetch_appointments() {
        header('Content-Type: application/json');

        $appointments = $this->DetailsRendezVous_model->get_all();

        $events = [];
        foreach ($appointments as $appointment) {
            $events[] = [
                'title' => $appointment['immatriculation'] . ' - ' . $appointment['service_nom'],
                'start' => $appointment['date_details'] . ' ' . $appointment['heure_debut'],
                'end' => $appointment['date_details'] . ' ' . $appointment['heure_fin']
            ];
        }

        echo json_encode($events);
    }
}
