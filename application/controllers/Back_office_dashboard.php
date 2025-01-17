<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Back_office_dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dashboard_model');
    }

    public function index()
    {
        $data['content'] = BACK_OFFICE_VIEW_FOLDER. 'dashboard';
        $data['title'] = 'Tableau de bord';
        $data['reference_date'] = $this->session->userdata('reference_date') ?? date('Y-m-d');
        $this->load->view(BACK_OFFICE_VIEW_FOLDER . 'base_layout', $data);
    }

    public function montantPayeParDateReference() {
        header('Content-Type: application/json');

        $date_reference = $this->input->post('date_reference');
        $result = $this->Dashboard_model->getMontantPayeParDateReference($date_reference);
        echo json_encode($result);
    }

    public function montantImpayeParDateReference() {
        header('Content-Type: application/json');

        $date_reference = $this->input->post('date_reference');
        $result = $this->Dashboard_model->getMontantImpayeParDateReference($date_reference);
        echo json_encode($result);
    }

    public function chiffreAffaireParTypeVoiture() {
        header('Content-Type: application/json');

        $result = $this->Dashboard_model->getChiffreAffaireParTypeVoiture();
        echo json_encode($result);
    }

    public function voituresTraiteesParDate() {
        header('Content-Type: application/json');

        $date_details = $this->input->post('date_details');
        $result = $this->Dashboard_model->getVoituresTraiteesParDate($date_details);
        echo json_encode($result);
    }

    public function set_reference_date() {
        $reference_date = $this->input->post('reference_date');
        if ($this->session->userdata('reference_date')) {
            $this->session->unset_userdata('reference_date');
        }
        $this->session->set_userdata('reference_date', $reference_date);
        redirect('BackOffice/services/list');
    }

}