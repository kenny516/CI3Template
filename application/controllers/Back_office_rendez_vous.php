<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Back_office_rendez_vous extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('DetailsRendezVous_model');
        $this->load->model('RendezVous_model');

        if (!$this->session->userdata("user")['id_admin']) {
            redirect('BackOffice/login');
        }
    }

    public function fetch_appointments()
    {
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

    public function add_appointment()
    {
        $voiture = $this->input->post('voiture');
        $service = $this->input->post('service');
        $dateDebut = $this->input->post('dateDebut');
        $data = array(
            'id_service' => $service,
            'date_debut' => $dateDebut
        );

        if ($voiture && $service && $dateDebut) {
            $details = $this->DetailsRendezVous_model->get_details($data);

            $last_elmt = $details[count($details) - 1];
            $date_max = $last_elmt['date_details'] . " " . $last_elmt['heure_fin'];
            $resultat = $this->DetailsRendezVous_model->get_available_slots($dateDebut, $date_max);

            if ($resultat['num_rows']) {
                $data2 = array(
                    'id_voiture' => $voiture,
                    'id_service' => $service,
                    'id_slot' => $resultat['result'][0]['id_slot'],
                    'date_debut' => $dateDebut,
                    'date_paiement' => null
                );
                $this->RendezVous_model->insert($data2);
                echo json_encode(['status' => 'success', 'message' => 'Rendez-vous ajouté avec succès.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Tous les slots sont pris.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Erreur lors de l\'ajout du rendez-vous.']);
        }
    }
}
