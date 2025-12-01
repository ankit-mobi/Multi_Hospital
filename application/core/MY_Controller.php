<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends MX_Controller {

    public function __construct() {
        parent::__construct();
         
         // Global Email Config for ALL modules
        $this->load->config('email');
        $this->load->library('email', $this->config->item());
        $this->email->initialize($this->config->item());
    }
}

