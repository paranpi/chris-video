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
        
        $query = $this->db->query('SELECT menu.id, menu.name, publish, sub_menu.id as sub_menu_id, sub_menu.name as sub_menu_name FROM sub_menu right join menu on menu.id = sub_menu.menu_id');
                
        return $query->result_array();
    }

    public function delete($options) 
    {               
        log_message('debug','delete : '.print_r($options,TRUE));
        $query = $this->db->delete('sub_menu', array('id' => $options['id']));
        return $query;
    }
}
