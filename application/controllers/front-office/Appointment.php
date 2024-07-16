<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Appointment extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['content'] = FRONT_OFFICE_VIEW_FOLDER . 'appointment';
        $this->load->view(FRONT_OFFICE_VIEW_FOLDER . 'templates/base_layout', $data);
    }

    public function submit()
    {

    }
}