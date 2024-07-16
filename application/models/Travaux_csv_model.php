<?php
class Travaux_csv_model extends CI_Model {

    public function insert_travaux($data) {
        foreach ($data as $row) {
            // Skip rows that don't have exactly 7 columns
            if (count($row) !== 7) {
                continue;
            }

            $insert_data = array(
                'voiture' => $row[0],
                'type_voiture' => $row[1],
                'date_rdv' => $row[2],  // Convert date to Y-m-d format
                'heure_rdv' => $row[3],
                'type_service' => $row[4],
                'montant' => $row[5],  // Ensure montant is a float
                'date_paiement' => $row[6]  // Convert date or set to null
            );

            $this->db->insert('garage_auto_import_travaux', $insert_data);
        }
    }
}
?>
