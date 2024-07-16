<?php

class Back_office_slot extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Slot_model');
    }

    public function index()
    {
        $data['content'] = BACK_OFFICE_VIEW_FOLDER . 'slot_usage';
        $data['title'] = 'Slot';
        $this->load->view(BACK_OFFICE_VIEW_FOLDER . 'base_layout', $data);
    }

    public function fetch_data()
    {
        header('Content-Type: application/json');

        $date = $this->input->post('date');
        $result = $this->Slot_model->usages($date);
        echo json_encode($result);
    }
}