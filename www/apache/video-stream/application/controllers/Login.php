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
        $this->load->view('login_form');
    }

    public function register_user()
    {
        $this->load->view('registration_form');
    }

    public function create_new_user()
    {        
        $this->form_validation->set_rules('id', 'Email', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
        $this->form_validation->set_rules('checkPassword', 'Password', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $this->load->view('registration_form');
        } else {
        	echo "<div>new_user</div>";
        }
    }
}
