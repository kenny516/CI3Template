<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Back_office_service extends \CI_Controller
{
    const VIEW_FOLDER = 'back-office/';
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('Service_model');
    }


    // redirection
    public function services_form($id = null) {
        $data['content'] = self::VIEW_FOLDER . 'services/form';
        $data['title'] = 'Services';
        $data['data'] = $this->Service_model->get_by_id($id);
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
    public function save()
    {
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
        $this->services_list();
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