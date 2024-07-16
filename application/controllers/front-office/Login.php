<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    const VIEW_FOLDER = 'front-office/';

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model("Type_voiture_model");
        $this->load->model("Voiture_model");
    }

    public function index()
    {
        $data['content'] = self::VIEW_FOLDER . 'login';
        $data['type_voiture'] = $this->Type_voiture_model->get_all();
        $this->load->view(self::VIEW_FOLDER . 'templates/base_layout', $data);
    }

    public function authenticate()
    {
        $this->form_validation->set_rules('numero-voiture', 'Numéro de voiture', 'required');
        $this->form_validation->set_rules('type-voiture', 'Type de voiture', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['type_voiture'] = $this->Type_voiture_model->get_all();
            $this->load->view(self::VIEW_FOLDER . 'login', $data);
        } else {
            $numero_voiture = $this->input->post('numero-voiture');
            $type_voiture = $this->input->post('type-voiture');
            $client = $this->Voiture_model->verify_voiture_log($numero_voiture, $type_voiture);
            if ($client) {
                $this->session->set_userdata("client", $client);
                redirect('front-office/Home');
            } else {
                $data = array(
                    "immatriculation" => $numero_voiture,
                    "id_type_voiture" => $type_voiture
                );
                $this->Voiture_model->insert($data);
                $client = $this->Voiture_model->verify_voiture_log($numero_voiture, $type_voiture);
                $this->session->set_userdata("client", $client);
                redirect('front-office/Home');
            }
        }
    }
}
?>
