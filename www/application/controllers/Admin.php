<?php

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Load url
        //$this->load->helper('url');
        // Load database
        /*if(!isset($this->session->userdata['logged_in'])) {
            return redirect('/login');
        }*/
        // $this->load->model('menu_model');
        // $this->load->model('subMenu_model');
        // $this->load->model('downloadList_model');
    }

    private function make_menu_array($menu_list = array())
    {
        $menus = array();

        foreach ($menu_list as $item) {
            if (!isset($menus[$item['id']])) {
                $menus[$item['id']] = array(
                    "id"=>$item['id'],
                    "name"=>$item['name'],
                    "publish"=>$item['publish'],
                    "sub_menus"=>array()
                    );
            }
            if ($item['sub_menu_id']) {
                $sub_menu_list = array(
                "id"=>$item['sub_menu_id'],
                "name"=>$item['sub_menu_name'],
                "path"=>$item['sub_menu_path'],
                "filename"=>$item['filename'],
                "board"=>$item['board'],
                );
                array_push($menus[$item['id']]['sub_menus'], $sub_menu_list);
            }
        }
        log_message('debug', 'menus : '.print_r($menus, true));
        return $menus;
    }

    private function get_files($dir="")
    {
        if (!$dir) {
            $dir = $this->config->item('content_base_path');
        }
        $files = array();
        $file_names = scandir($dir);
        foreach ($file_names as $file) {
            array_push($files, array("type" => filetype($dir.'/'.$file),"name"=>$file));
        }
        return $files;
    }

    private function response($status=true, $data="")
    {
        $this->output->set_content_type('application/json');
        if ($status) {
            $status_msg = "SUCCESS";
        } else {
            $status_msg = "ERROR";
            $this->output->set_status_header(400);
        }
        $response_data = array("status"=>$status_msg,"data"=>$data);
        $this->output->set_output(json_encode($response_data));
    }

    public function index()
    {
        $this->load->view('admin');
    }

    public function add_download()
    {
        $_POST += json_decode(file_get_contents('php://input'), true);
        log_message('debug', 'post : '.print_r($this->input->post(), true));
        $filename = $this->input->post('filename');
        $path = $this->input->post('path');
        $board = $this->input->post('board');
        if (!$path || !$filename || !$board) {
            return $this->response(true, "입력값을 확인하세요.");
        }
        $data = array('filename'=>$filename,'path'=>$path,'board'=>$board);
        $result = $this->downloadList_model->insert($data);
        if ($result) {
            $this->response(true);
        } else {
            $this->response(false, json_encode($this->db->error()));
        }
    }

    public function del_download()
    {
        $path = $this->input->get('path');
        $result = $this->downloadList_model->delete(array("path"=>$path));
        if ($result) {
            $this->response(true);
        } else {
            $this->response(false, json_encode($this->db->error()));
        }
    }
}
