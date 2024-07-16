<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Appointment extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('validation');
        $this->load->model('Service_model');
        $this->load->model('Slot_model');
        $this->load->model('DetailsRendezVous_model');
        $this->load->model('Ouverture_model');
        $this->load->model('RendezVous_model');
    }

    public function index() {
        $data['content'] = FRONT_OFFICE_VIEW_FOLDER . 'appointment';
        $data['services'] = $this->Service_model->get_all();
        $this->load->view(FRONT_OFFICE_VIEW_FOLDER . 'templates/base_layout', $data);
    }

    public function submit() {
        $ouvertures = $this->Ouverture_model->get_all();
        $ouverture = end($ouvertures);
        $heure_ouverture = $ouverture['ouvert'];
        $heure_fermeture = $ouverture['fermer'];

        $this->form_validation->set_rules('service', 'Service', 'required');
        $this->form_validation->set_rules('date-debut', 'Date de début', 'required');
        $this->form_validation->set_rules('heure-debut', 'Heure de début', 'required|validation_heure_debut[' . $heure_ouverture . ',' . $heure_fermeture . ']');

        $client = $this->session->userdata("client");

        if (!$client) {
            redirect('front-office/Login');
            return;
        }

        if (!$this->form_validation->run()) {
            $data['content'] = FRONT_OFFICE_VIEW_FOLDER . 'appointment';
            $data['services'] = $this->Service_model->get_all();
            $this->load->view(FRONT_OFFICE_VIEW_FOLDER . 'templates/base_layout', $data);
            return;
        }

        $voiture = $client['id_voiture'];
        $service = $this->input->post('service');
        $dateDebut = $this->input->post('date-debut') . ' ' . $this->input->post('heure-debut');
        $format = 'm/d/Y h:i A';
        $dateDebut = DateTime::createFromFormat($format, $dateDebut)->format('Y-m-d H:i:s');
        $data = array(
            'id_service' => $service,
            'date_debut' => $dateDebut
        );

        $details = $this->DetailsRendezVous_model->get_details($data);

        $last_elmt = end($details);
        $date_max = $last_elmt['date_details'] . " " . $last_elmt['heure_fin'] . ':00';
        $resultat = $this->DetailsRendezVous_model->get_available_slots($dateDebut, $date_max);

        if (!$resultat['num_rows']) {
            $this->session->set_flashdata('error', "Le garage n'est pas disponible pour cette plage de temps");
            redirect('front-office/Appointment');
        }

        $data2 = array(
            'id_voiture' => $voiture,
            'id_service' => $service,
            'id_slot' => $resultat['result'][0]['id_slot'],
            'date_debut' => $dateDebut,
            'date_paiement' => null
        );
        $id_rendez_vous = $this->RendezVous_model->insert($data2);
        $this->session->set_userdata('id_rendez_vous', $id_rendez_vous);
        $this->session->set_flashdata('success', "Votre rendez-vous a été confirmé. Vous pouvez maintenant télécharger le devis");

        redirect('front-office/Appointment');
    }
}
