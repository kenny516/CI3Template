<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slot_model extends CI_Model {

    public function get_all() {
        $query = $this->db->get('garage_auto_slot');
        return $query->result_array();
    }

}