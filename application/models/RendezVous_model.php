<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RendezVous_model extends CI_Model {

    public function insert($data) {
        $this->db->insert('garage_auto_rendez_vous', $data);
        return $this->db->insert_id();
    }

}