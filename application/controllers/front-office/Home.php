<?php

class Home extends CI_Controller
{
    public function index()
    {
        $data['content'] = FRONT_OFFICE_VIEW_FOLDER . 'home';
        $this->load->view(FRONT_OFFICE_VIEW_FOLDER . 'templates/base_layout', $data);
    }
}
