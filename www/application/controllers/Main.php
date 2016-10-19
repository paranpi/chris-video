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
		log_message('debug','menu_list : '.print_r($files,TRUE));
		return $files; 											
	}
	private function get_mp4_files($top_dir,$sub_dir) {
		$base_path = $this->config->item('content_base_path');
		$mp4_files = array();
		$dirname = $top_dir.'/'.$sub_dir;
		if ($handle = opendir($base_path.$dirname)) {
			while (false !== ($file = readdir($handle))) {
				if ($file != "." && $file != "..") {
					//echo "$file\n";
					$fileinfo = pathinfo($file);
					$ext = $fileinfo['extension'];
					if($ext == "mp4") {
						$encoded_dirname = urlencode($top_dir).'/'.urlencode($sub_dir).'/'.urlencode($file);
						array_push($mp4_files,$encoded_dirname);
					}
				}
			}
			closedir($handle);
		}
		log_message('debug','$files : '.print_r($mp4_files,TRUE));
		return $mp4_files;		
	}
	
	public function index($page="Fun"){
		$this->load->helper('url');										
		$data = array();
		$data['menu_list'] = $this->get_menu_list();
		$data['sidebar_menu_list'] = $this->get_sidebar_menu_list($page);
		$data['page'] = $page;			
		$menu = $this->input->get('menu', TRUE);
		if(!$menu) {
			$file_dir = array_values($data['sidebar_menu_list']);
			$menu = $file_dir[0]; 
		}		
		$data['file_list'] = $this->get_mp4_files($page,$menu);																			
		$this->load->view('main',$data);							
	}
}