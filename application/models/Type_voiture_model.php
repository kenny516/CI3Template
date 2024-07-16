<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Type_voiture_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert($data) {
        return $this->db->insert('garage_auto_type_voiture', $data);
    }

    public function get_all() {
        $query = $this->db->get('garage_auto_type_voiture');
        return $query->result_array();
    }

    public function get_by_id($id) {
        $query = $this->db->get_where('garage_auto_type_voiture', ['id_type_voiture' => $id]);
        return $query->row_array();
    }

    public function update($id, $data) {
        $this->db->where('id_type_voiture', $id);
        return $this->db->update('garage_auto_type_voiture', $data);
    }

    public function delete($id) {
        $this->db->where('id_type_voiture', $id);
        return $this->db->delete('garage_auto_type_voiture');
    }

    public function delete_all() {
        $this->db->where('1', '1');
        return $this->db->delete('garage_auto_type_voiture');
    }
}
