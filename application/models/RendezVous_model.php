<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RendezVous_model extends CI_Model {

    public function insert($data) {
        $this->db->insert('garage_auto_rendez_vous', $data);
        return $this->db->insert_id();
    }
    public function get_all() {
        $this->db->select('garage_auto_rendez_vous.*, garage_auto_voiture.immatriculation, garage_auto_service.nom as service_nom, garage_auto_slot.designation as slot_designation');
        $this->db->from('garage_auto_rendez_vous');
        $this->db->join('garage_auto_voiture', 'garage_auto_rendez_vous.id_voiture = garage_auto_voiture.id_voiture');
        $this->db->join('garage_auto_service', 'garage_auto_rendez_vous.id_service = garage_auto_service.id_service');
        $this->db->join('garage_auto_slot', 'garage_auto_rendez_vous.id_slot = garage_auto_slot.id_slot');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function update_payment_date($id_rendez_vous, $date_paiement) {
        $this->db->where('id', $id_rendez_vous);
        $this->db->where('date_debut <=', $date_paiement);
        $this->db->update('garage_auto_rendez_vous', array('date_paiement' => $date_paiement));

        return $this->db->affected_rows(); // Retourne le nombre de lignes modifiées
    }




}