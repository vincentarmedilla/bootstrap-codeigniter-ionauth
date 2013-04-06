<?php

class User extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
    }

    function index() {
        $this->render();
    }

    function register() {
        
    }

    function edit() {
        
    }

    function delete() {
        
    }

}