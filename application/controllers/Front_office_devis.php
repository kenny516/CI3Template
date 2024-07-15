<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front_office_devis extends CI_Controller {

    const VIEW_FOLDER = 'front-office/';

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('fpdf_helper'); // Charger le helper PDF
    }

    public function generate_service_receipt() {
        // Données statiques pour tester un rendez-vous
        $rendezVousDetails = array(
            'immatriculation' => 'ABC123',
            'type_voiture' => 'SUV',
            'service_name' => 'Entretien complet',
            'service_price' => 200,
            'service_duration' => '2 heures',
            'date_debut' => '2024-07-17 10:00:00'
        );

        // Générer le PDF pour le rendez-vous spécifié
        generate_service_receipt_pdf($rendezVousDetails, 'service_receipt.pdf');
    }

}
