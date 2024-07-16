<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Back_office_dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['content'] = BACK_OFFICE_VIEW_FOLDER. 'dashboard';
        $data['title'] = 'Tableau de bord';
        $this->load->view(BACK_OFFICE_VIEW_FOLDER . 'base_layout', $data);
    }



}