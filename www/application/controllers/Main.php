<?php
class Main extends CI_Controller {
	private function get_menu_list() {
		
		//TODO: you have to read from db
		$menu_list = array(
		"예능" => "Fun",
		"드라마" => "Drama"
		);
		return $menu_list;
	}
	
	private function get_sidebar_menu_list($dirname = "Fun") {
		function filter ($var) {
			return ($var != '.' && $var != '..');			
		}
		//TODO: you have to read from db
		$base_path = $this->config->item('content_base_path');		
		$files=array_filter(scandir($base_path.$dirname),'filter');
		log_message('debug',print_r($files,TRUE));
		return $files; 											
	}
	public function index(){				
		$data = array();
		$data['menu_list'] = $this->get_menu_list();
		$data['sidebar_menu_list'] = $this->get_sidebar_menu_list();
		//TODO: get file list 
		//http://php.net/manual/kr/function.readdir.php		
		$this->load->helper('url');									
		$this->load->view('main',$data);							
	}
}