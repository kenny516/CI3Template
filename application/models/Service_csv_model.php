<?php
class Service_csv_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function insert_services($data) {
        foreach ($data as $row) {
            $insert_data = array(
                'service' => $row[0],
                'duree' => $row[1]
            );
            $this->db->insert('garage_auto_import_service', $insert_data);
        }
    }
}
?>
