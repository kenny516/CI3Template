<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BackOffice extends CI_Controller
{
    const VIEW_FOLDER = 'back-office/';

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
    }

    public function login()
    {
        $this->load->view(self::VIEW_FOLDER . 'login');
    }

    public function services_list() {
        $data['content'] = self::VIEW_FOLDER . 'services/list';

        $this->load->view(self::VIEW_FOLDER . 'base_layout', $data);
    }

    public function services_form() {
        $data['content'] = self::VIEW_FOLDER . 'services/form';
        $data['title'] = 'Services';

        $this->load->view(self::VIEW_FOLDER . 'base_layout', $data);
    }
}