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
        $data['donne'] = $this->Type_voiture_model->get_all();
        $this->load->view(FRONT_OFFICE_VIEW_FOLDER . 'templates/base_layout', $data);
    }

    public function submit()
    {

    }
}