<?php

class Back_office_slot extends CI_Controller
{
    public function index()
    {
        $data['content'] = BACK_OFFICE_VIEW_FOLDER . 'slot_usage';
        $data['title'] = 'Slot';
        $this->load->view(BACK_OFFICE_VIEW_FOLDER . 'base_layout', $data);
    }
}