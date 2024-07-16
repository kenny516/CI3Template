<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RendezVous_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Service_model');
        $this->load->model('Ouverture_model');
        $this->load->model('DetailsRendezVous_model');
    }

    /**
     * @param $data = array(
     *      'id_voiture' => 1,
     *      'id_service' => 2,
     *      'id_slot' => 3,
     *      'date_debut' => '2023-03-01 10:00:00',
     *      'date_paiement' => null
     * );
     * @return mixed
     */
    public function insert($data) {
        $details = $this->DetailsRendezVous_model->get_details($data);

        // Insert the rendez_vous
        $this->db->insert('garage_auto_rendez_vous', $data);
        $rendez_vous_id = $this->db->insert_id();

        // Insert the details with the correct rendez_vous ID
        foreach ($details as &$detail) {
            $detail['id_rendez_vous'] = $rendez_vous_id;
            $this->db->insert('garage_auto_details_rendez_vous', $detail);
        }

        return $rendez_vous_id;
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

    public function delete_all() {
        $this->db->where('1', '1');
        return $this->db->delete('garage_auto_rendez_vous');
    }

    public function update_payment_date($id_rendez_vous, $date_paiement) {
        $this->db->where('id_rendez_vous', $id_rendez_vous);
        $this->db->where('date_debut <=', $date_paiement);
        $this->db->update('garage_auto_rendez_vous', array('date_paiement' => $date_paiement));

        return $this->db->affected_rows(); // Retourne le nombre de lignes modifiées
    }

    public function get_quotation_by_id($id_rendez_vous) {
        $this->db->select('
            rv.date_debut,
            v.immatriculation,
            tv.description AS type_voiture,
            s.nom AS service_name,
            s.prix AS service_price,
            s.duree AS service_duration
        ');
        $this->db->from('garage_auto_rendez_vous rv');
        $this->db->join('garage_auto_voiture v', 'rv.id_voiture = v.id_voiture');
        $this->db->join('garage_auto_type_voiture tv', 'v.id_type_voiture = tv.id_type_voiture');
        $this->db->join('garage_auto_service s', 'rv.id_service = s.id_service');
        $this->db->where('rv.id_rendez_vous', $id_rendez_vous);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

}