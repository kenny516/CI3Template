<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller
{
    public function index()
    {
        $data['content'] = FRONT_OFFICE_VIEW_FOLDER . 'home';
        $this->load->view(FRONT_OFFICE_VIEW_FOLDER . 'templates/base_layout', $data);
    }
}
