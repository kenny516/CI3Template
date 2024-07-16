<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

    public function getMontantPayeParDateReference($date_reference) {
        $this->db->select_sum('gas.prix', 'montant_paye_par_date_reference');
        $this->db->from('garage_auto_rendez_vous AS garv');
        $this->db->join('garage_auto_service AS gas', 'garv.id_service = gas.id_service');
        $this->db->where('garv.date_paiement IS NOT NULL');
        $this->db->where('DATE(garv.date_debut)', $date_reference);
        $this->db->where('garv.date_paiement >=', $date_reference);
        $query = $this->db->get();

        return $query->row();
    }

    public function getMontantImpayeParDateReference($date_reference) {
        $this->db->select_sum('gas.prix', 'montant_impaye_par_date_reference');
        $this->db->from('garage_auto_rendez_vous AS garv');
        $this->db->join('garage_auto_service AS gas', 'garv.id_service = gas.id_service');
        $this->db->where('garv.date_paiement IS NULL');
        $this->db->where('DATE(garv.date_debut)', $date_reference);
        $query = $this->db->get();

        return $query->row();
    }

    public function getChiffreAffaireParTypeVoiture() {
        $this->db->select('gatv.id_type_voiture, gatv.description AS description_type_voiture, SUM(gas.prix) AS chiffre_affaire_par_type_voiture');
        $this->db->from('garage_auto_rendez_vous garv');
        $this->db->join('garage_auto_voiture gav', 'garv.id_voiture = gav.id_voiture');
        $this->db->join('garage_auto_type_voiture gatv', 'gav.id_type_voiture = gatv.id_type_voiture');
        $this->db->join('garage_auto_service gas', 'garv.id_service = gas.id_service');
        $this->db->where('garv.date_paiement IS NOT NULL');
        $this->db->group_by('gatv.id_type_voiture');
        $query = $this->db->get();

        return $query->result();
    }

    public function getVoituresTraiteesParDate($date_details) {
        $this->db->select('COUNT(gadrv.id_details) AS nb_voitures, gadrv.date_details');
        $this->db->from('garage_auto_details_rendez_vous gadrv');
        $this->db->join('garage_auto_rendez_vous garv', 'gadrv.id_rendez_vous = garv.id_rendez_vous');
        $this->db->join('garage_auto_service gas', 'garv.id_service = gas.id_service');
        $this->db->where('gadrv.date_details', $date_details);
        $this->db->group_by('gadrv.date_details');
        $query = $this->db->get();

        return $query->row();
    }
}
