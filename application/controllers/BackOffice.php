<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BackOffice extends CI_Controller
{
    const VIEW_FOLDER = 'back-office/';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->model('RendezVous_model');
        $this->load->model('DetailsRendezVous_model');
        $this->load->model('Service_model');
        $this->load->model('Type_voiture_model');
        $this->load->model('Voiture_model');
        $this->load->helper('form');
        if (!$this->session->userdata("user")['id_admin']){
            redirect('BackOffice/login');
        }
    }

    public function services_form()
    {
        $data['content'] = self::VIEW_FOLDER . 'services/form';
        $data['title'] = 'Services';
        $this->load->view(self::VIEW_FOLDER . 'base_layout', $data);
    }

    public function appointment()
    {
        $data['content'] = self::VIEW_FOLDER . 'appointment';
        $data['title'] = 'Rendez-vous';
        $data['voitures'] = $this->Voiture_model->get_all();
        $data['services'] = $this->Service_model->get_all();
        $this->load->view(self::VIEW_FOLDER . 'base_layout', $data);
    }

    public function devis()
    {
        $data['content'] = self::VIEW_FOLDER . 'quotation';
        $data['title'] = 'Devis';
        $this->load->view(self::VIEW_FOLDER . 'base_layout', $data);
    }

    public function reinitialize_database()
    {
        $this->DetailsRendezVous_model->delete_all();
        $this->RendezVous_model->delete_all();
        $this->Service_model->delete_all();
        $this->Type_voiture_model->delete_all();
        $this->Voiture_model->delete_all();
        redirect('BackOffice/services/list');
    }

}
