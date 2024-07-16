<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DetailsRendezVous_model extends CI_Model {

    public function get_all() {
        $this->db->select('garage_auto_details_rendez_vous.*, garage_auto_rendez_vous.*, garage_auto_voiture.immatriculation, garage_auto_service.nom as service_nom');
        $this->db->from('garage_auto_details_rendez_vous');
        $this->db->join('garage_auto_rendez_vous', 'garage_auto_details_rendez_vous.id_rendez_vous = garage_auto_rendez_vous.id_rendez_vous');
        $this->db->join('garage_auto_voiture', 'garage_auto_rendez_vous.id_voiture = garage_auto_voiture.id_voiture');
        $this->db->join('garage_auto_service', 'garage_auto_rendez_vous.id_service = garage_auto_service.id_service');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function delete_all() {
        return $this->db->delete('garage_auto_details_rendez_vous');
    }

    public function get_details($data)
    {
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
        return $details;
    }

}