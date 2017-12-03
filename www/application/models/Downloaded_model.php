<?php

class Downloaded_model extends CI_Model
{
    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    public function insert($data)
    {
        log_message('debug','insert : '.print_r($data,TRUE));
    	$this->db->set('download_list_id', $data['downloadListId']);
        $this->db->set('margnet', $data['margnet']);
        $this->db->set('created', 'NOW()', false);
        return $this->db->insert('downloaded');
    }

    public function get($options = array()) {
        $this->db->select('margnet');
        $this->db->where('margnet',$options['margnet']);
        $query = $this->db->get('downloaded');
        return $query->result();
    }

    public function delete() {
        $result = $this->db->query('DELETE FROM downloaded WHERE created < DATE_SUB(NOW(), INTERVAL 30 DAY)');
        if(!$result) {
            return false;
        }
        return true;
    }
}
