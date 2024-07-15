<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }


    public function insert_admin($data) {
        return $this->db->insert('garage_auto_admin', $data);
    }


    public function get_admin_by_email($email) {
        $this->db->where('email', $email);
        $query = $this->db->get('garage_auto_admin');
        return $query->row_array();
    }


    public function update_password($id_admin, $new_password) {
        $this->db->where('id_admin', $id_admin);
        return $this->db->update('garage_auto_admin', ['mots_de_passe' => $new_password]);
    }

    public function delete_admin($id_admin) {
        $this->db->where('id_admin', $id_admin);
        return $this->db->delete('garage_auto_admin');
    }


    public function login($email, $password) {
        $this->db->where('email', $email);
        $query = $this->db->get('garage_auto_admin');
        $admin = $query->row_array();

        if ($admin && password_verify($password, $admin['mots_de_passe'])) {
            return $admin;
        }
        return false;
    }
}
