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


    public function services_form($data) {
        $data['content'] = self::VIEW_FOLDER . 'services/form';
        $data['title'] = 'Services';
        $data['data'] = $data;
        $this->load->view(self::VIEW_FOLDER . 'base_layout', $data);
    }
    public function services_list() {
        $data['content'] = self::VIEW_FOLDER . 'services/list';
        $data['title'] = 'Services';
        $data['services'] = $this->Service_model->get_all();

        $this->load->view(self::VIEW_FOLDER . 'base_layout', $data);
    }
    public function services_delete($id)
    {
        $this->Service_model->delete($id);
        $this->services_list();
    }
}