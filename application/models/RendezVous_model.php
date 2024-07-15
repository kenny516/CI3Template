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
        $service = $this->Service_model->get_by_id($data['id_service']);
        $duree_parts = explode(':', $service['duree']);
        $hours = (int) $duree_parts[0];
        $minutes = (int) $duree_parts[1];
        $service_duration = new DateInterval("PT{$hours}H{$minutes}M");

        // Get the opening and closing hours
        $ouvertures = $this->Ouverture_model->get_all();
        $ouverture = $ouvertures[count($ouvertures) - 1];
        $heure_ouverture = $ouverture['ouvert'];
        $heure_fermeture = $ouverture['fermer'];

        // Convert opening and closing hours to DateTime objects
        $date_debut = DateTime::createFromFormat('Y-m-d H:i:s', $data['date_debut']);
        $date_fin = clone $date_debut; // Create a copy of the original date
        $date_fin->add($service_duration);

        // Convert opening and closing times to DateTime on the same day
        $fermeture_time = DateTime::createFromFormat('Y-m-d H:i:s', $date_debut->format('Y-m-d') . " $heure_fermeture:00:00");
        $ouverture_time_next_day = DateTime::createFromFormat('Y-m-d H:i:s', $date_debut->modify('+1 day')->format('Y-m-d') . " $heure_ouverture:00:00");

        $details = [];

        if ($date_fin > $fermeture_time) {
            // Appointment exceeds the closing hour, split it
            $base_detail = [
                'date_details' => $date_debut->format('Y-m-d'),
                'heure_debut' => $date_debut->format('H:i:s'),
                'heure_fin' => $fermeture_time->format('H:i:s'),
                'id_rendez_vous' => null // This will be set after inserting the rendez_vous
            ];
            $details[] = $base_detail;

            // Calculate remaining duration
            $interval_to_closing = $date_debut->diff($fermeture_time);
            $remaining_duration = new DateInterval('PT0H0M');
            $remaining_duration->h = $service_duration->h - $interval_to_closing->h;
            $remaining_duration->i = $service_duration->i - $interval_to_closing->i;

            $new_end_time = clone $ouverture_time_next_day;
            $new_end_time->add($remaining_duration);

            $next_day_detail = [
                'date_details' => $ouverture_time_next_day->format('Y-m-d'),
                'heure_debut' => $ouverture_time_next_day->format('H:i:s'),
                'heure_fin' => $new_end_time->format('H:i:s'),
                'id_rendez_vous' => null // This will be set after inserting the rendez_vous
            ];
            $details[] = $next_day_detail;
        } else {
            // Appointment within the same day
            $base_detail = [
                'date_details' => $date_debut->format('Y-m-d'),
                'heure_debut' => $date_debut->format('H:i:s'),
                'heure_fin' => $date_fin->format('H:i:s'),
                'id_rendez_vous' => null // This will be set after inserting the rendez_vous
            ];
            $details[] = $base_detail;
        }

        echo '<pre>';
        var_dump($details);
        echo '</pre>';
        die();

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