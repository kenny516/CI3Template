<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BackOffice extends CI_Controller
{
    const VIEW_FOLDER = 'back-office/';

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('Service_model');
    }

    public function login()
    {
        $this->load->view(self::VIEW_FOLDER . 'login');
    }
}