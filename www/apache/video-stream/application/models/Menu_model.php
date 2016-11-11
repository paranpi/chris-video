<?php

class Menu_model extends CI_Model
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
        $this->db->set('publish', $data['publish']);
        $this->db->set('created', 'NOW()', false); 
        if(!$this->db->insert('menu')) {
            return false;
        }else {
            return $this->db->insert_id();
        }
    }

    public function update($options)
    {
        log_message('debug','update : '.print_r($options,TRUE));
        $data = $options['data'];
        if(isset($data['name'])) {
            $this->db->set('name', $data['name']);
        }
        if(isset($data['publish'])) {
            $this->db->set('publish', $data['publish']);
        }
        
        $this->db->where('id',$options['id']);
        if(!$this->db->update('menu')) {
            return false;
        }        
        return true;        
    }


    public function get($options) 
    {
        log_message('debug','get : '.print_r($option,TRUE));       	 	
        $query = $this->db->get_where('menu', array('id'=>$options['id']));        
        return $query->row();     
    }

    public function gets($options = array()) {        
        $this->db->select('id, name , publish');
        //$this->db->order_by('created','DESC');
        if(isset($options['publish'])) {
            $this->db->where('publish',$options['publish']);
        }
        $query = $this->db->get('menu');
        return $query->result_array();
    }

    public function getMenusWithSubmenu($options = array()) {
        $query = $this->db->query('SELECT menu.id, menu.name, menu.publish, sub_menu.id AS sub_menu_id, sub_menu.name AS sub_menu_name, download_list.filename AS filename  FROM menu LEFT JOIN sub_menu ON menu.id = sub_menu.menu_id LEFT JOIN download_list ON sub_menu.path = download_list.path');
                
        return $query->result_array();        
    }

    public function delete($options) 
    {               
        log_message('debug','delete : '.print_r($options,TRUE));
        $result = $this->db->delete('menu', array('id' => $options['id']));
        if(!$result) {
            return false;
        }
        return true;
    }
}
