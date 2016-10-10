<?php
class Main extends CI_Controller {
	public function index($page = 'main'){
		$data = array();
		$this->load->helper('url');									
		$this->load->view($page,$data);							
	}
}
