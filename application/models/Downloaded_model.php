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
        $this->db->set('title', $data['title']);
        $this->db->set('magnet', $data['magnet']);
        $this->db->set('created', 'NOW()', false);
        return $this->db->insert('downloaded');
    }

    public function get($options = array()) {
        $this->db->select('magnet');
        $this->db->where('magnet',$options['magnet']);
        $query = $this->db->get('downloaded');
        return $query->result();
    }

    public function get_all($options = array("offset" => 0, "limit" => 10)) {
        $result = array();
        $result['count'] = $this->db->count_all_results('downloaded');
        $this->db->order_by("created", "desc");
        $query = $this->db->get('downloaded', $options['limit'], $options['offset']);
        $result['rows'] = $query->result_array();
        return $result;
    }

    public function delete($id)
    {
        $query = $this->db->delete('downloaded', array('id' => $id));
        return $query;
    }
}
