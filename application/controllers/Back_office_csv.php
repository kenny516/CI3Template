<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Back_office_csv extends CI_Controller {

    const VIEW_FOLDER = 'back-office/';

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index() {
        $data['content'] = self::VIEW_FOLDER . 'ImportCSV';
        $data['title'] = 'Import csv';
        $this->load->view(self::VIEW_FOLDER . 'base_layout', $data);
    }

    public function process_import() {
        $service_file = $_FILES['service']['tmp_name'] ?? null;
        $travaux_file = $_FILES['travaux']['tmp_name'] ?? null;

        if ($service_file && $travaux_file) {
            $service_data = $this->parse_csv_file($service_file);
            $travaux_data = $this->parse_csv_file($travaux_file);

            // Validate headers
            if (!$this->validate_service_data($service_data) || !$this->validate_travaux_data($travaux_data)) {
                $this->session->set_flashdata('error', 'Invalid CSV headers. Please check the file contents.');
                $this->index();
                return;
            }

            // Remove headers
            array_shift($service_data);
            array_shift($travaux_data);

            // Insert data into database
            $this->load->model('Service_csv_model');
            $this->Service_csv_model->insert_services($service_data);

            $this->load->model('Travaux_csv_model');
            $this->Travaux_csv_model->insert_travaux($travaux_data);

            redirect('backoffice/importation_csv/success');
        } else {
            $this->session->set_flashdata('error', 'Please select both files.');
            $this->index();
        }
    }

    private function parse_csv_file($file_path) {
        $data = [];

        if (($handle = fopen($file_path, "r")) !== FALSE) {
            while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $data[] = $row;
            }
            fclose($handle);
        }

        return $data;
    }

    private function validate_service_data($data) {
        // Expected header for services
        $expected_header = ['service', 'duree'];
        return !empty($data) && $data[0] === $expected_header;
    }

    private function validate_travaux_data($data) {
        // Expected header for travaux
        $expected_header = ['voiture', 'type voiture', 'date rdv', 'heure rdv', 'type service', 'montant', 'date paiement'];
        return !empty($data) && $data[0] === $expected_header;
    }

    public function success() {
        redirect('BackOffice/services/list');
    }
}

