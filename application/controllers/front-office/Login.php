<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model("Type_voiture_model");
    }

    public function index()
    {
        $data['content'] = FRONT_OFFICE_VIEW_FOLDER . 'login';
        $data['type_voiture'] = $this->Type_voiture_model->get_all();
        $this->load->view(FRONT_OFFICE_VIEW_FOLDER . 'templates/base_layout', $data);
    }

    public function authenticate() {
        $this->form_validation->set_rules('numero-voiture', 'Numéro de voiture', 'required');
        $this->form_validation->set_rules('type-voiture', 'Type de voiture', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['type_voiture'] = $this->Login_model->get_type_voiture();
            $this->load->view('login_view', $data);
        } else {
            $numero_voiture = $this->input->post('numero-voiture');
            $type_voiture = $this->input->post('type-voiture');

            $user = $this->Login_model->check_login($numero_voiture, $type_voiture);

            if ($user) {
                $this->session->set_userdata('user_id', $user['id']);
                redirect('front-office/Home');
            } else {
                $this->session->set_flashdata('error', 'Numéro de voiture ou type de voiture incorrect');
                redirect('Login');
            }
        }
    }
}