<?php

class SubMenu_model extends CI_Model
{	
    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
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
    
    public function gets($options = array()) {
        $this->db->select('id, name , publish');
        $this->db->order_by('created','DESC');
        if(isset($options['publish'])) {
            $this->db->where('publish',$options['publish']);
        }
        $query = $this->db->get('menu');
        return $query->result_array();
    }

    public function delete($options) 
    {               
        log_message('debug','delete : '.print_r($options,TRUE));
        $query = $this->db->delete('menu', array('id' => $options['id']));
        if($this->db->affected_rows() < 1) {
            return false;
        }
        return true;
    }
}
