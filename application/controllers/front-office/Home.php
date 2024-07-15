<?php

class Home extends CI_Controller
{
    public function index()
    {
        $this->load->view(FRONT_OFFICE_VIEW_FOLDER . 'base_layout');
    }
}
