<?php
// Modèle : Garage_auto_model.php

class Garage_auto_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert_services_from_import() {
        $query = "
            INSERT INTO garage_auto_service (nom, duree, prix)
            SELECT service,
                   duree,
                   (SELECT montant
                    FROM garage_auto_import_travaux travaux
                    WHERE travaux.type_service = service
                    ORDER BY date_rdv DESC, heure_rdv DESC
                    LIMIT 1) AS prix_recent
            FROM garage_auto_import_service;
        ";
        $this->db->query($query);
    }

    public function insert_type_voitures_from_import() {
        $query = "
            INSERT INTO garage_auto_type_voiture (description)
            SELECT DISTINCT type_voiture
            FROM garage_auto_import_travaux
            WHERE type_voiture NOT IN (SELECT description FROM garage_auto_type_voiture);
        ";
        $this->db->query($query);
    }

    public function insert_voitures_from_import() {
        $query = "
            INSERT INTO garage_auto_voiture (immatriculation, id_type_voiture)
            SELECT DISTINCT voiture,
                            (SELECT id_type_voiture FROM garage_auto_type_voiture WHERE description = travaux.type_voiture)
            FROM garage_auto_import_travaux travaux
            WHERE voiture NOT IN (SELECT immatriculation FROM garage_auto_voiture);
        ";
        $this->db->query($query);
    }


}
