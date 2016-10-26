<?php

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

		// Load form helper library
        $this->load->helper('form');

		// Load form validation library
        $this->load->library('form_validation');
		
		// Load database
        //$this->load->model('login_database');
    }

    public function index($page = "Fun")
    {
    	// Show login page
        $this->load->view('login');
    }
}
