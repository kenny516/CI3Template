<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slot_model extends CI_Model
{
    public function get_all() {
        $query = $this->db->get('garage_auto_slot');
        return $query->result_array();
    }

    public function usages($date)
    {
        $this->db->select('ga_slot.designation AS slot, 
                           gav.immatriculation AS matricule_voiture, 
                           garv.date_debut, 
                           ga_service.nom AS type_service, 
                           ga_service.duree AS duree_service');
        $this->db->from('garage_auto_rendez_vous garv');
        $this->db->join('garage_auto_slot ga_slot', 'garv.id_slot = ga_slot.id_slot');
        $this->db->join('garage_auto_voiture gav', 'garv.id_voiture = gav.id_voiture');
        $this->db->join('garage_auto_service ga_service', 'garv.id_service = ga_service.id_service');
        $this->db->where('DATE(garv.date_debut)', $date);

        $query = $this->db->get();
        $result = $query->result_array();

        $grouped_results = [];
        foreach ($result as $row) {
            $slot = $row['slot'];
            if (!isset($grouped_results[$slot]))
                $grouped_results[$slot] = [];

            $grouped_results[$slot][] = $row;
        }

        return $grouped_results;
    }

}