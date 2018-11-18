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

    private function mp4filter ($value) {
        if($value['type'] == 'dir') {
            $inner_files = $this->file->get_files($value['path'].'/'.$value['name'],true,"mp4","latest");
            return empty($inner_files) ? null: $inner_files[0];
        }
        return $value;
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
        $files = $this->file->get_files($sub_menu['path'].'/'.$sub_menu['name'],true,"","latest");
        // 토렌트 변경으로인해 디렉토리가 하나 더 생김.
        // 2depth 까지 확인하도록 수정. 디렉토리 관리도 2단계까지가 적당함.
        // directory 내에는 파일하나만 존재하도록한다.
        $file_list = array_map(array($this,'mp4filter'), $files);
        $data['file_list'] = array_filter($file_list);
        $this->load->view('main', $data);
    }
}
