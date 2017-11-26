<?php
class Main extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load TextHelper
        $this->load->helper('text');
        $this->load->library('file');
        // Load database
        // $this->load->model('menu_model');
        // $this->load->model('subMenu_model');
    }

    private function get_sub_menu($id="", $sub_menus)
    {
        if (!$sub_menus) {
            return;
        }

        if (!$id) {
            return $sub_menus[0];
        }
        foreach ($sub_menus as $key => $value) {
            if ($value['id'] == $id) {
                return $value;
            }
        }
        return $sub_menus[0];
    }

    private function get_mp4_files($dirname)
    {
        $base_path = $this->config->item('content_base_path');
        $mp4_files = array();
        log_message('debug', 'scandir : '.print_r($base_path.$dirname, true));
        $files = scandir($base_path.$dirname);
        foreach ($files as $file) {
            if ($file != "." && $file != "..") {
                $fileinfo = pathinfo($file);
                if (isset($fileinfo['extension']) && $fileinfo['extension'] == "mp4") {
                    $encoded_dirname = $dirname.'/'.rawurlencode($file);
                    array_push($mp4_files, array("url" => $encoded_dirname,"name" => $file));
                }
            }
        }
        log_message('debug', '$files : '.print_r($mp4_files, true));
        return $mp4_files;
    }

    public function index($id="")
    {
        $data = array();
        $menu_list = $this->file->get_files();
        log_message('debug', '$menu_list : '.print_r($menu_list, true));

        if (!isset($menu_list[$id])) {
            $id = 0;
        }
        $data['menu_list'] = $menu_list;
        $data['id'] = $id;
        log_message('debug', '$id : '.$id);
        $sidebar_menu = $this->file->get_files($menu_list[$id]['name']);
        log_message('debug', '$sidebar_menu_list : '.print_r($sidebar_menu, true));
        $data['sidebar_menu_list'] = $sidebar_menu;
        $sub_menu_id = $this->input->get('menu', true);
        if (!isset($sidebar_menu[$sub_menu_id])) {
            $sub_menu_id = 0;
        }
        $data['sub_menu_id'] = $sub_menu_id;
        $sub_menu = $sidebar_menu[$sub_menu_id];
        $file_list = $this->file->get_files($sub_menu['path'].'/'.$sub_menu['name']);
        $data['file_list'] = $file_list;
        $this->load->view('main', $data);
    }
}
