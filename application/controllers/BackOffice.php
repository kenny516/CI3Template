<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BackOffice extends CI_Controller
{
    const VIEW_FOLDER = 'back-office/';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->helper('form');
    }

    public function login()
    {
        $this->load->view(self::VIEW_FOLDER . 'login');
    }

    public function services_list()
    {
        $data['content'] = self::VIEW_FOLDER . 'services/list';
        $data['title'] = 'Services';
        $data['services'] = [
            ['id' => 1, 'nom' => 'Réparation simple', 'duree' => '1h', 'prix' => '150000 Ar'],
            ['id' => 2, 'nom' => 'Réparation standard', 'duree' => '2h', 'prix' => '250000 Ar'],
            ['id' => 3, 'nom' => 'Réparation complexe', 'duree' => '8h', 'prix' => '800000 Ar'],
            ['id' => 4, 'nom' => 'Entretien', 'duree' => '2h30', 'prix' => '300000 Ar']
        ];

        $this->load->view(self::VIEW_FOLDER . 'base_layout', $data);
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
        $this->load->view(self::VIEW_FOLDER . 'base_layout', $data);
    }
  
    public function add_admin()
    {
        $email = 'admin@gmail.com';
        $password = 'admin123';
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $data = array(
            'email' => $email,
            'mots_de_passe' => $hashed_password
        );
        $this->Admin_model->insert($data);
    }

    public function verify_login()
    {
        if ($this->input->post('submit')) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $admin = $this->Admin_model->login($email, $password);
            if ($admin) {
                $session_data = array(
                    'email' => $email,
                    'logged_in' => TRUE
                );
                $this->session->set_userdata("user",$session_data);
                redirect('BackOffice/services/list');
            } else {
                $this->session->set_flashdata('error', 'Identifiant incorrect');
                redirect('BackOffice/login');
            }
        }
    }
}
