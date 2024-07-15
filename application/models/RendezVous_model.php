<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RendezVous_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Service_model');
        $this->load->model('Ouverture_model');
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
        // Extract the service duration into a DateInterval instance
        $service = $this->Service_model->get_by_id($data['id_service']);
        $duree_parts = explode(':', $service['duree']);
        $hours = (int) $duree_parts[0];
        $minutes = (int) $duree_parts[1];
        $service_duration = new DateInterval("PT{$hours}H{$minutes}M");

        // Get the opening and closing hours
        $ouvertures = $this->Ouverture_model->get_all();
        // TODO: get opening and closing hours

        $date_debut = DateTime::createFromFormat('Y-m-d H:i:s', $data['date_debut']);
        $date_fin = clone $date_debut; // Create a copy of the original date
        $date_fin->add($service_duration);
        $details = [];

        $base_detail = [
            'date_details' => $this->db->date_morph($date_debut),
            'heure_debut' => $date_debut->format('H:i:s')
        ];

        $this->db->insert('garage_auto_rendez_vous', $data);
        return $this->db->insert_id();
    }

}