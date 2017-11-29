<?php
class Main extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load TextHelper
        $this->load->helper('text');
        $this->load->library('file');
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
