<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ouverture_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert($data) {
        return $this->db->insert('garage_auto_ouverture', $data);
    }

    public function get_all() {
        $query = $this->db->get('garage_auto_ouverture');
        return $query->result_array();
    }

    public function update($id_ouverture, $data) {
        $this->db->where('id_ouverture', $id_ouverture);
        return $this->db->update('garage_auto_ouverture', $data);
    }

    public function delete($id_ouverture) {
        $this->db->where('id_ouverture', $id_ouverture);
        return $this->db->delete('garage_auto_ouverture');
    }
}
