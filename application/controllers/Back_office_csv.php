<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Back_office_csv extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }

    public function index() {
        $this->load->view('backoffice/import_csv_form');
    }

    public function process_import() {
        $this->form_validation->set_rules('service', 'Service CSV', 'required');
        $this->form_validation->set_rules('travaux', 'Travaux CSV', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('backoffice/import_csv_form');
        } else {
            $service_file = $_FILES['service']['tmp_name'];
            $travaux_file = $_FILES['travaux']['tmp_name'];

            $service_data = $this->parse_csv_file($service_file);
            $travaux_data = $this->parse_csv_file($travaux_file);

            // Example: Insert data into database
            $this->load->model('Service_model');
            $this->Service_model->insert_services($service_data);

            $this->load->model('Travaux_model');
            $this->Travaux_model->insert_travaux($travaux_data);

            redirect('backoffice/importation_csv/success');
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

    public function success() {
        $this->load->view('backoffice/import_csv_success');
    }

}