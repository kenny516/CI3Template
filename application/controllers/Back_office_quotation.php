<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Back_office_quotation extends CI_Controller
{
    const VIEW_FOLDER = 'back-office/';
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('RendezVous_model');
    }

    public function RendezVous_model_list() {
        $data['content'] = self::VIEW_FOLDER . 'quotation';
        $data['title'] = 'Services';
        $data['rendez_vous'] = $this->RendezVous_model->get_all();

        $this->load->view(self::VIEW_FOLDER . 'base_layout', $data);
    }

    public function update_paiement()
    {
        $id_rendez_vous = $this->input->post('id');
        $date_paiement = $this->input->post('date_paiement');

        // Appel de la fonction du modèle pour mettre à jour la date de paiement
        $updated = $this->RendezVous_model->update_payment_date($id_rendez_vous, $date_paiement);


        if ($updated) {
            echo json_encode(['success' => $updated]);
        } else {
            echo json_encode(['success' => $updated]);
        }
    }

}