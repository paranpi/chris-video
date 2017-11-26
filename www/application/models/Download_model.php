<?php

class Download_model extends CI_Model
{
    public function __construct($options)
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    public function insert($data)
    {
        log_message('debug','insert : '.print_r($data,TRUE));
    	$this->db->set('user_id', $data['user_id']);
        $this->db->set('rss_keyword', $data['rss_keyworld']);
        $this->db->set('destination', $data['destination']);
        $this->db->set('created', 'NOW()', false);
        return $this->db->insert('download');
    }

    public function getAll() {
        $query = $this->db->get('download');
        return $query->result_array();
    }

    public function delete($id)
    {
        $query = $this->db->delete('download', array('id' => $id));
        return $query;
    }
}
