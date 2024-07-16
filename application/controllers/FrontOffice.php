<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FrontOffice extends CI_Controller {

    public function index() {
        redirect('front-office/Login');
    }

}
