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

    public function update($id, $data) {
        $this->db->where('id_voiture', $id);
        return $this->db->update('garage_auto_voiture', $data);
    }

    public function delete($id) {
        $this->db->where('id_voiture', $id);
        return $this->db->delete('garage_auto_voiture');
    }
    // Vérifier le login du client
    public function verify_login($immatriculation, $type_voiture) {
        $this->db->select('*');
        $this->db->from('garage_auto_voiture');
        $this->db->join('garage_auto_type_voiture', 'garage_auto_voiture.id_type_voiture = garage_auto_type_voiture.id_type_voiture');
        $this->db->where('immatriculation', $immatriculation);
        $this->db->where('description', $type_voiture);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            // Inscription automatique
            $data = array(
                'immatriculation' => $immatriculation,
                'id_type_voiture' => $this->get_type_voiture_id($type_voiture)
            );
            $this->db->insert('garage_auto_voiture', $data);
            $id = $this->db->insert_id();
            return $this->get_client_by_id($id);
        }
    }

    // Obtenir l'ID du type de voiture
    private function get_type_voiture_id($type_voiture) {
        $this->db->select('id_type_voiture');
        $this->db->from('garage_auto_type_voiture');
        $this->db->where('description', $type_voiture);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->row()->id_type_voiture;
        } else {
            $data = array('description' => $type_voiture);
            $this->db->insert('garage_auto_type_voiture', $data);
            return $this->db->insert_id();
        }
    }

    // Obtenir le client par ID
    public function get_client_by_id($id_voiture) {
        $this->db->select('*');
        $this->db->from('garage_auto_voiture');
        $this->db->where('id_voiture', $id_voiture);
        $query = $this->db->get();
        return $query->row_array();
    }

    // Prise de rendez-vous
    public function take_appointment($id_voiture, $id_service, $date_debut) {
        $slot = $this->get_free_slot($date_debut);
        if ($slot) {
            $data = array(
                'id_voiture' => $id_voiture,
                'id_service' => $id_service,
                'id_slot' => $slot['id_slot'],
                'date_debut' => $date_debut
            );
            $this->db->insert('garage_auto_rendez_vous', $data);
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    // Obtenir un slot libre
    private function get_free_slot($date_debut) {
        $this->db->select('*');
        $this->db->from('garage_auto_slot');
        $this->db->where("id_slot NOT IN (SELECT id_slot FROM garage_auto_rendez_vous WHERE DATE(date_debut) = DATE('$date_debut'))", NULL, FALSE);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }
}
