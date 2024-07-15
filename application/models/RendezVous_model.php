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

}