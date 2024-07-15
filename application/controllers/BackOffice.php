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
        $this->load->helper('form');
    }

    public function login()
    {
        $this->load->view(self::VIEW_FOLDER . 'login');
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

    public function devis()
    {
        $data['content'] = self::VIEW_FOLDER . 'quotation';
        $data['title'] = 'Devis';
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
                    'id_admin' => $admin['id_admin'],
                    'email' => $email
                );
                $this->session->set_userdata("user",$session_data);
                redirect('BackOffice/services/list');
            } else {
                $this->session->set_flashdata('error', 'Identifiant incorrect');
                redirect('BackOffice/login');
            }
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('user');
        redirect('BackOffice/login');
    }
}
