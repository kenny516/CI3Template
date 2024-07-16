<?php

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
    }

    public function index()
    {
        $data['content'] = FRONT_OFFICE_VIEW_FOLDER . 'login';
        $this->load->view(FRONT_OFFICE_VIEW_FOLDER . 'templates/base_layout', $data);
    }

    public function submit()
    {
        // To implement
    }
}