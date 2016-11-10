<?php

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

/*        // Load form helper library
        $this->load->helper('form');

        // Load form validation library
        $this->load->library('form_validation');        

        */
        
        // Load url
        //$this->load->helper('url');
        // Load database
        $this->load->model('menu_model');
        $this->load->model('subMenu_model');
    }

    private function make_menu_array($menu_list = array()) {
        $menus = array();

        foreach ($menu_list as $item) {            
            if(!isset($menus[$item['id']])) {
                $menus[$item['id']] = array(
                    "id"=>$item['id'],
                    "name"=>$item['name'],
                    "publish"=>$item['publish'],
                    "sub_menus"=>array()
                    );                
            }
            if($item['sub_menu_id']) {
                $sub_menu_list = array(
                "id"=>$item['sub_menu_id'],
                "name"=>$item['sub_menu_name']
                );            
                array_push($menus[$item['id']]['sub_menus'],$sub_menu_list);
            }
        }
        log_message('debug','menus : '.print_r($menus,TRUE));
        return $menus;
    }

    private function get_files($dir="") {
        if(!$dir) {
            $dir = $this->config->item('content_base_path');
        }
        $files = array();
        $file_names = scandir($dir);
        foreach ($file_names as $file) {
            array_push($files,array("type" => filetype($dir.'/'.$file),"name"=>$file));
        }                
        return $files;
    }

    private function response($status=true,$data="") {
        $this->output->set_content_type('application/json');
        if($status) {
            $status_msg = "SUCCESS";
        }else {
            $status_msg = "ERROR";
            $this->output->set_status_header(400);
        }
        $response_data = array("status"=>$status_msg,"data"=>$data);        
        $this->output->set_output(json_encode($response_data));
    }

    public function index()
    {
        // Show login page
        $menus = $this->menu_model->getMenusWithSubmenu();
        //$menus = $this->subMenu_model->getAll();
        $file_name=$this->input->get('dir');        
        log_message('debug','file_name : '.print_r($file_name,TRUE));
        $data = array();
        $data['menus'] = $this->make_menu_array($menus);
        //$data['menus'] = $menus;
        $base_path = realpath($this->config->item('content_base_path'));
        $file_path = realpath($base_path.'/'.$file_name);
        if(strlen($file_path) < strlen($base_path)) {
            $file_path = $base_path;
        }        
        $path = str_replace($base_path,"",$file_path);
        log_message('debug','dirname : '.print_r(dirname($file_name),TRUE));
        log_message('debug','base : '.print_r($base_path,TRUE));
        log_message('debug','file : '.print_r($file_path,TRUE));
        log_message('debug','path : '.print_r($path,TRUE));        
        $data['path'] = $path.'/';        
        $data['files'] = $this->get_files($file_path);        
        log_message('debug','files : '.print_r($data['files'],TRUE));
        $this->load->view('admin',$data);
    }

    public function add_menu() {                
        $_POST += json_decode(file_get_contents('php://input'), true);                
        log_message('debug','post : '.print_r($this->input->post(),TRUE));
        $name = $this->input->post('name');
        $publish = $this->input->post('publish');
        $data = array('name'=>$name,'publish'=>$publish);
        $result = $this->menu_model->insert($data);
        
        if($result) {            
            $this->response(true);
        }else {
            $this->response(false,json_encode($this->db->error()));
        }
    }

    public function update_menu($id) {                
        $put_data = json_decode(file_get_contents('php://input'), true);
        log_message('debug','put : '.print_r($put_data,TRUE));        
        $result = $this->menu_model->update(array("id"=>$id,"data"=>$put_data));                  
        if($result) {            
            $this->response(true);
        }else {
            $this->response(false,json_encode($this->db->error()));
        }        
    }


    public function del_menu($id) {
        $result = $this->menu_model->delete(array("id"=>$id));
        if($result) {            
            $this->response(true);
        }else {
            $this->response(false,json_encode($this->db->error()));
        }
        
    }
    
    public function add_sub_menu() {
        $_POST += json_decode(file_get_contents('php://input'), true);                
        log_message('debug','post : '.print_r($this->input->post(),TRUE));
        $name = $this->input->post('name');
        $path = $this->input->post('path');
        $menu_id = $this->input->post('menu_id');
        $data = array('name'=>$name,'path'=>$path,'menu_id'=>$menu_id,);
        $result = $this->subMenu_model->insert($data);
        if($result) {            
            $this->response(true);
        }else {
            $this->response(false,json_encode($this->db->error()));
        }
    }

    public function del_sub_menu($id) {
        $result = $this->subMenu_model->delete(array("id"=>$id));
        if($result) {            
            $this->response(true);
        }else {
            $this->response(false,json_encode($this->db->error()));
        }
        
    }
}
