<?php
class Install
{
    public function __construct()
    {
        $this->CI =& get_instance();
    }
    private function update_config()
    {
        $file_name = './application/config/config.php';
        $pattern = '/(\$config\[\'install_version\'\]) = [0-9]/';
        if (file_exists($file_name)) {
            log_message('debug', 'INSTALL_INFO: '.$file_name);
            $file = file_get_contents($file_name, FILE_USE_INCLUDE_PATH);
            $out = preg_replace($pattern, '${1} = 1', $file);
            file_put_contents($file_name, $out);
        }
    }
    private function init_db()
    {
        $this->CI->load->database();
        $this->CI->db->query('DROP DATABASE IF EXISTS `video`;');
        $this->CI->db->query('CREATE DATABASE IF NOT EXISTS `video` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;');
        $this->CI->db->query('use video;');
        // 유저 테이블생성.
        $this->CI->db->query(
            'CREATE TABLE IF NOT EXISTS `user` (
				`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
				`email` varchar(255) NOT NULL UNIQUE KEY,
				`password` varchar(255) NOT NULL,
				`created` datetime NOT NULL
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;'
        );
        // 다운로드 리스트 테이블생성.
        $this->CI->db->query(
            'CREATE TABLE IF NOT EXISTS `download_list` (
				`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
				`user_id` int(11) NOT NULL,
				`rss_keyword` varchar(255) NOT NULL UNIQUE KEY,
				`destination` varchar(255) NOT NULL UNIQUE KEY,
                `board_id` varchar(255) NOT NULL,
				`created` datetime NOT NULL,
				FOREIGN KEY (`user_id`) REFERENCES `user`(`id`) ON DELETE CASCADE ON UPDATE NO ACTION
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;'
        );
        //다운로드완료 테이블생성
        $this->CI->db->query(
            'CREATE TABLE IF NOT EXISTS `downloaded` (
				`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
				`download_list_id` int(11) NOT NULL,
                `title` varchar(255) NOT NULL UNIQUE KEY,
				`magnet` varchar(255) NOT NULL UNIQUE KEY,
				`created` datetime NOT NULL,
				FOREIGN KEY (`download_list_id`) REFERENCES `download_list`(`id`) ON DELETE CASCADE ON UPDATE NO ACTION
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;'
        );

        $user = array(
            'email'    => 'admin@iptime.co.kr',
            'password' => password_hash('00000000', PASSWORD_BCRYPT)
        );
        $this->CI->load->model('user_model');
        $this->CI->user_model->insert($user);

    }
    public function install()
    {
        if ($this->CI->config->item('install_version') > 0) {
            return;
        }
        $this->init_db();
        $this->update_config();
    }
}
