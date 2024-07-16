<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front_office_devis extends CI_Controller {

    const VIEW_FOLDER = 'front-office/';

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('fpdf_helper'); // Charger le helper PDF
        $this->load->model('RendezVous_model');
    }

    public function generate_service_quotation() {
        $id_rendez_vous = $this->session->userdata('id_rendez_vous');

        if (!$id_rendez_vous) {
            $this->sesssion->set_flashdata('error', 'Aucun devis à exporter');
            return;
        }

        // Données statiques pour tester un rendez-vous
        $rendezVousDetails = $this->RendezVous_model->get_quotation_by_id((int) $id_rendez_vous);

        // Générer le PDF pour le rendez-vous spécifié
        generate_service_receipt_pdf($rendezVousDetails, 'service_receipt.pdf');
    }

}
