<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RendezVous_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Service_model');
        $this->load->model('Ouverture_model');
        date_default_timezone_set('Europe/Paris'); // Set the timezone here
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
        $duree_service = $this->Service_model->get_duree_service($data['id_service']);

        // Get the opening and closing hours
        $ouvertures = $this->Ouverture_model->get_all();
        $ouverture = $ouvertures[count($ouvertures) - 1];
        $heure_ouverture = $ouverture['ouvert'];
        $heure_fermeture = $ouverture['fermer'];

        // Convert opening and closing hours to DateTime objects
        $date_debut = DateTime::createFromFormat('Y-m-d H:i:s', $data['date_debut']);
        $remaining_duration = $duree_service->h * 60 + $duree_service->i; // Total remaining duration in minutes

        $details = [];

        while ($remaining_duration > 0) {
            $date_fin = clone $date_debut;
            $fermeture_time = DateTime::createFromFormat('Y-m-d H:i:s', $date_debut->format('Y-m-d') . " $heure_fermeture:00:00");

            $minutes_until_closing = ($fermeture_time->getTimestamp() - $date_debut->getTimestamp()) / 60;

            if ($remaining_duration > $minutes_until_closing) {
                // Appointment exceeds the closing hour, create detail until closing time
                $new_detail = [
                    'date_details' => $date_debut->format('Y-m-d'),
                    'heure_debut' => $date_debut->format('H:i:s'),
                    'heure_fin' => $fermeture_time->format('H:i:s'),
                    'id_rendez_vous' => null // This will be set after inserting the rendez_vous
                ];
                $details[] = $new_detail;

                // Calculate remaining duration
                $remaining_duration -= $minutes_until_closing;

                // Prepare for next day
                $date_debut = DateTime::createFromFormat('Y-m-d H:i:s', $fermeture_time->format('Y-m-d') . " $heure_ouverture:00:00")->modify('+1 day');
            } else {
                // Appointment within the same day
                $date_fin->modify("+$remaining_duration minutes");

                $new_detail = [
                    'date_details' => $date_debut->format('Y-m-d'),
                    'heure_debut' => $date_debut->format('H:i:s'),
                    'heure_fin' => $date_fin->format('H:i:s'),
                    'id_rendez_vous' => null // This will be set after inserting the rendez_vous
                ];
                $details[] = $new_detail;

                // Reset remaining duration
                $remaining_duration = 0;
            }
        }

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