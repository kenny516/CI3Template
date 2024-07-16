<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('validation_heure_debut')) {
    function validation_heure_debut($heure_debut, $params) {
        list($heure_ouverture, $heure_fermeture) = explode(',', $params);

        if ($heure_debut >= $heure_ouverture && $heure_debut <= $heure_fermeture) {
            return TRUE;
        } else {
            $CI =& get_instance();
            $CI->form_validation->set_message('validation_heure_debut', 'Nous sommes uniquement ouvert de ' . $heure_ouverture . ' heure à ' . $heure_fermeture . ' heure');
            return FALSE;
        }
    }
}
