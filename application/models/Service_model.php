<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service_model extends CI_Model {

    // Create
    public function insert($data) {
        $this->db->insert('garage_auto_service', $data);
        return $this->db->insert_id();
    }

    // Read
    public function get_all() {
        $query = $this->db->get('garage_auto_service');
        return $query->result_array();
    }

    public function get_by_id($id_service) {
        $this->db->where('id_service', $id_service);
        $query = $this->db->get('garage_auto_service');
        return $query->row_array();
    }

    // Update
    public function update($id_service, $data) {
        $this->db->where('id_service', $id_service);
        $this->db->update('garage_auto_service', $data);
        return $this->db->affected_rows();
    }

    // Delete
    public function delete($id_service) {
        $this->db->where('id_service', $id_service);
        $this->db->delete('garage_auto_service');
        return $this->db->affected_rows();
    }

    public function get_duree_service($id_service)
    {
        $service = $this->get_by_id($id_service);
        $duree_parts = explode(':', $service['duree']);
        $hours = (int) $duree_parts[0];
        $minutes = (int) $duree_parts[1];
        return new DateInterval("PT{$hours}H{$minutes}M");
    }

}