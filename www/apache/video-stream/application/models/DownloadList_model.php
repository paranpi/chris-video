<?php

class DownloadList_model extends CI_Model
{	
    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    public function insert($data)
    {
        log_message('debug','insert : '.print_r($data,TRUE)); 
    	$this->db->set('filename', $data['filename']);        
        $this->db->set('path', $data['path']);
        $this->db->set('board', $data['board']);
        $this->db->set('created', 'NOW()', false); 
        return $this->db->insert('download_list');        
    }   
        
    public function get_download_list($options = array()) {
        $this->db->select('path,filename,board');
        $query = $this->db->get('download_list');
        return $query->result_array();
    }

    public function delete($options) 
    {               
        log_message('debug','delete : '.print_r($options,TRUE));
        $query = $this->db->delete('download_list', array('path' => $options['path']));
        return $query;
    }
}
