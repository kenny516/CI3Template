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
        try {
            $this->db->trans_start(); // Démarre une transaction

            // Suppression du service
            $this->db->where('id_service', $id_service);
            $this->db->delete('garage_auto_service');

            // Vérifie le nombre de lignes affectées
            $affected_rows = $this->db->affected_rows();

            if ($affected_rows == 0) {
                throw new Exception("Le service avec l'ID $id_service n'existe pas.");
            }

            $this->db->trans_complete(); // Termine la transaction

            return $affected_rows;
        } catch (Exception $e) {
            // En cas d'erreur, annule la transaction et renvoie une erreur
            $this->db->trans_rollback();
            return false;
        }
    }

    public function delete_all() {
        $this->db->where('1', '1');
        return $this->db->delete('garage_auto_service');
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