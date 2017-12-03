<?php
class User_model extends CI_Model
{
    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->database('video');
    }
    public function insert($data)
    {
        $this->db->set('email', $data['email']);
        $this->db->set('password', $data['password']);
        $this->db->set('created', 'NOW()', false);
        $this->db->insert('user');
        $result = $this->db->insert_id();
        return $result;
    }

    public function get($option)
    {
        $result = $this->db->get_where('user', array('email'=>$option['email']))->row();
        return $result;
    }
}
