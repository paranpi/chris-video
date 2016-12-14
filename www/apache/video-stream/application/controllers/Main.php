<?php
class Main extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        // Load TextHelper
        $this->load->helper('text');
        // Load database        
        $this->load->model('menu_model');
        $this->load->model('subMenu_model');
    }	  
	
	private function get_sub_menu($id="",$sub_menus) {
		if(!$sub_menus) {
			return;
		}

		if(!$id) {
			return $sub_menus[0];
		}
		foreach ($sub_menus as $key => $value) {
			if($value['id'] == $id) {
				return $value;
			}
		}
		return $sub_menus[0];
	}

	private function get_mp4_files($dirname) {
		$base_path = $this->config->item('content_base_path');		
		$mp4_files = array();
		log_message('debug','scandir : '.print_r($base_path.$dirname,TRUE));
		$files = scandir($base_path.$dirname);
		foreach ($files as $file) {
			if ($file != "." && $file != "..") {
				$fileinfo = pathinfo($file);				
				if(isset($fileinfo['extension']) && $fileinfo['extension'] == "mp4") {
					$encoded_dirname = $dirname.'/'.rawurlencode($file);
					array_push($mp4_files,array("url" => $encoded_dirname,"name" => $file));
				}
			}
		}				
		log_message('debug','$files : '.print_r($mp4_files,TRUE));
		return $mp4_files;		
	}
	
	public function index($id=""){										
		$data = array();
		$data['menu_list'] = $this->menu_model->gets(array("publish"=>true));
		log_message('debug','$menu_list : '.print_r($data['menu_list'],TRUE));

		if(!$id && isset($data['menu_list'][0])) {
            $id = $data['menu_list'][0]['id'];
		}
		$data['id'] = $id;		
		$data['sidebar_menu_list'] = $this->subMenu_model->gets(array("menu_id"=>$id));
		$sub_menu_id = $this->input->get('menu', TRUE);
		$sub_menu = $this->get_sub_menu($sub_menu_id,$data['sidebar_menu_list']);
		if(!$sub_menu_id) {			
			$sub_menu_id = $sub_menu['id'];
		}			
		$data['sub_menu_id'] = $sub_menu_id;
		log_message('debug','sub_menu : '.print_r($sub_menu,TRUE));
		if($sub_menu) {
			$data['file_list'] = $this->get_mp4_files($sub_menu['path']);	
		}else {
			$data['file_list'] = array();
		}
											
		$this->load->view('main',$data);							
	}
}