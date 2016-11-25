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
        $this->load->model('user_model');

        // Load url
        $this->load->helper('url');
    }

    public function index()
    {
        // Show login page
        $this->load->view('login_form');
    }

    public function registration_form()
    {        
        $this->load->view('registration_form');
    }

    public function registration()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|min_length[6]|max_length[128]|valid_email');
        $this->form_validation->set_rules('password', 'Password|', 'trim|required|xss_clean|min_length[8]|max_length[20]');
        $this->form_validation->set_rules('checkPassword', 'Password', 'trim|required|xss_clean|min_length[8]|max_length[20]|matches[password]');
        if ($this->form_validation->run() == false) {            
            $this->load->view('registration_form');        
        } else {
            $data = array(
                'email'    => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
            );
            $this->user_model->insert($data);            
            redirect('login');
        }
    }

    public function authentication()
    {        
        $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|min_length[6]|max_length[128]');
        $this->form_validation->set_rules('password', 'Password|', 'trim|required|xss_clean|min_length[8]|max_length[20]');
        if ($this->form_validation->run() == false) {
            $this->load->view('login_form');            
        } else {
            $user = $this->user_model->get(array("email"=>$this->input->post('email')));                        
            if(isset($user) && password_verify($this->input->post('password'),$user->password)) 
            {
                $this->session->set_userdata('logged_in', true);
                //TODO : redirect to admin page.
                redirect('/admin');
            }else {
                $this->load->view('login_form');
            }
            
        }
    }
    public function logout() {
        $this->session->unset_userdata('logged_in');
        redirect('/');
    }
}
