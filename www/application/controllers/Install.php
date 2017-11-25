<?php
class Install extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}
	private function update_config() {
		$file_name = './application/config/config.php';
		$pattern = '/(\$config\[\'install_version\'\]) = [0-9]/';
		if(file_exists($file_name)) {
			log_message('debug','INSTALL_INFO: '.$file_name);
			$file = file_get_contents($file_name,FILE_USE_INCLUDE_PATH);
			$out = preg_replace($pattern, '${1} = 1', $file );
	    file_put_contents($file_name, $out);
		}
	}
	private function init_db()
	{
		$this->load->database();
		$this->db->query('DROP DATABASE IF EXISTS `video`;');
		$this->db->query('CREATE DATABASE IF NOT EXISTS `video` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;');
		$this->db->query('use video;');
		// 유저 테이블생성.
		$this->db->query(
			'CREATE TABLE IF NOT EXISTS `user` (
			`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
			  `email` varchar(255) NOT NULL UNIQUE KEY,
			  `password` varchar(255) NOT NULL,
			  `created` datetime NOT NULL
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;'
		);
		// 메뉴 테이블생성.
		// $this->db->query(
		// 	'CREATE TABLE IF NOT EXISTS `menu` (
		// 	`id` int(25) NOT NULL AUTO_INCREMENT PRIMARY KEY,
		// 	  `name` varchar(255) NOT NULL UNIQUE KEY,
		// 	  `publish` tinyint(1) NOT NULL DEFAULT 0,
		// 	  `created` datetime NOT NULL
		// 	) ENGINE=InnoDB DEFAULT CHARSET=utf8;'
		// );
		// 서브메뉴 테이블생성.
		// $this->db->query(
		// 	'CREATE TABLE IF NOT EXISTS `sub_menu` (
		// 	`id` int(25) NOT NULL AUTO_INCREMENT PRIMARY KEY,
		// 	  `name` varchar(255) NOT NULL,
		// 	  `path` varchar(255) NOT NULL UNIQUE KEY,
		// 	  `menu_id` int(25) NOT NULL,
		// 	  `created` datetime NOT NULL,
		// 	  FOREIGN KEY (`menu_id`) REFERENCES `menu`(`id`) ON DELETE CASCADE ON UPDATE NO ACTION
		// 	) ENGINE=InnoDB DEFAULT CHARSET=utf8;'
		// );
	}
	private function install() {
		$this->init_db();
	}
	public function index(){
		if($this->config->item('install_version') > 0) {
			echo 'Already Installed.';
			return;
		}
		$this->install();
		$this->update_config();
		redirect('main');
	}
}
