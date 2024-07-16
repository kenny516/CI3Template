<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Voiture_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert($data) {
        return $this->db->insert('garage_auto_voiture', $data);
    }

    public function get_all() {
        $this->db->select('garage_auto_voiture.*, garage_auto_type_voiture.description');
        $this->db->from('garage_auto_voiture');
        $this->db->join('garage_auto_type_voiture', 'garage_auto_voiture.id_type_voiture = garage_auto_type_voiture.id_type_voiture', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_by_id($id) {
        $query = $this->db->get_where('garage_auto_voiture', ['id_voiture' => $id]);
        return $query->row_array();
    }

    public function get_by_immatriculation($immatriculation) {
        $query = $this->db->get_where('garage_auto_voiture', ['immatriculation' => $immatriculation]);
        return $query->row_array();
    }
    public function verify_voiture_log($immatriculation,$id_type)
    {
        $query = $this->db->get_where('garage_auto_voiture', ['immatriculation' => $immatriculation] &&  ['id_type_voiture' => $id_type]);
        return $query->row_array();
    }


    public function update($id, $data) {
        $this->db->where('id_voiture', $id);
        return $this->db->update('garage_auto_voiture', $data);
    }

    public function delete($id) {
        $this->db->where('id_voiture', $id);
        return $this->db->delete('garage_auto_voiture');
    }

    public function delete_all() {
        $this->db->where('1', '1');
        return $this->db->delete('garage_auto_voiture');
    }
}

