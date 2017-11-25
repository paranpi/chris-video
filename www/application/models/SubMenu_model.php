<?php

class SubMenu_model extends CI_Model
{
    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->database('video');
    }

    public function insert($data)
    {
        log_message('debug','insert : '.print_r($data,TRUE));
    	$this->db->set('name', $data['name']);
        $this->db->set('path', $data['path']);
        $this->db->set('menu_id', $data['menu_id']);
        $this->db->set('created', 'NOW()', false);
        return $this->db->insert('sub_menu');
    }

    public function get($options = array()) {
        $this->db->select('id, name,path');
        $this->db->where('id',$options['id']);
        $this->db->limit(1);
        $query = $this->db->get('sub_menu');
        return $query->result();
    }

    public function gets($options = array()) {
        $this->db->select('id, name,path');
        $this->db->where('menu_id',$options['menu_id']);
        $query = $this->db->get('sub_menu');
        return $query->result_array();
    }

    public function delete($options)
    {
        log_message('debug','delete : '.print_r($options,TRUE));
        $query = $this->db->delete('sub_menu', array('id' => $options['id']));
        return $query;
    }
}
