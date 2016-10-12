<?php
class Main extends CI_Controller {
	private function getMenuList() {
		$menuList = array(
		"예능" => "../../Fun",
		"드라마" => "../../Drama"
		);
		return $menuList;
	}
	public function index(){
		//$dir    = '../../';
		//$files = scandir($dir);
		//log_message('debug',print_r($files,TRUE));		
		$data = array();
		$data['menuList'] = $this->getMenuList();		
		$this->load->helper('url');									
		$this->load->view('main',$data);							
	}
}