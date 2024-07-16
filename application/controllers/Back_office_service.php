<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Back_office_service extends \CI_Controller
{
    const VIEW_FOLDER = 'back-office/';
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('Service_model');
        if (!$this->session->userdata("user")['id_admin']){
            redirect('BackOffice/login');
        }
    }

    // redirection
    public function services_form($id = null) {
        $data = $this->Service_model->get_by_id($id);
        $data['content'] = self::VIEW_FOLDER . 'services/form';
        $data['title'] = 'Services';
        $this->load->view(self::VIEW_FOLDER . 'base_layout', $data);
    }
    // crud

    public function services_list() {
        $data['content'] = self::VIEW_FOLDER . 'services/list';
        $data['title'] = 'Services';
        $data['services'] = $this->Service_model->get_all();

        $this->load->view(self::VIEW_FOLDER . 'base_layout', $data);
    }

    // Enregistre un nouveau service ou met à jour un service existant
    public function save() {
        // Set validation rules
        $this->form_validation->set_rules('nom', 'Nom', 'required');
        $this->form_validation->set_rules('duree', 'Durée', 'required');
        $this->form_validation->set_rules('prix', 'Prix', 'required|numeric|greater_than[0]');

        if ($this->form_validation->run() == FALSE) {
            // Validation failed, redisplay form with errors
            $data['errors'] = validation_errors();
            $data['id_service'] = $this->input->post('id_service');
            $data['nom'] = $this->input->post('nom');
            $data['duree'] = $this->input->post('duree');
            $data['prix'] = $this->input->post('prix');
            $data['content'] = self::VIEW_FOLDER . 'services/form';
            $data['title'] = 'Services';
            $this->load->view(self::VIEW_FOLDER . 'base_layout', $data);
        } else {
            // Validation successful, process data
            $id_service = $this->input->post('id_service');
            $data = [
                'nom' => $this->input->post('nom'),
                'duree' => $this->input->post('duree'),
                'prix' => $this->input->post('prix')
            ];

            if ($id_service) {
                // Mise à jour du service existant
                $this->Service_model->update($id_service, $data);
            } else {
                // Création d'un nouveau service
                $this->Service_model->insert($data);
            }

            // Redirection vers la liste des services après l'opération
            redirect('BackOffice/services/list');
        }
    }


    public function services_delete($id)
    {
        $affected_rows = $this->Service_model->delete($id);
        if ($affected_rows){
            $this->services_list();
        }else{
            echo "cet element est relier a d autre";
        }

    }


}