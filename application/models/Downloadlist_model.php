<?php

class Downloadlist_model extends CI_Model
{
    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->database('video');
    }

    public function insert($data)
    {
        log_message('debug', 'insert : '.print_r($data, true));
        $this->db->set('user_id', $data['userId']);
        $this->db->set('rss_keyword', $data['rssKeyword']);
        $this->db->set('board_id', $data['boardId']);
        $this->db->set('destination', $data['destination']);
        $this->db->set('created', 'NOW()', false);
        return $this->db->insert('download_list');
    }

    public function get_all()
    {
        $query = $this->db->get('download_list');
        return $query->result_array();
    }

    public function delete($id)
    {
        $query = $this->db->delete('download_list', array('id' => $id));
        return $query;
    }
}
