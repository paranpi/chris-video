<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class File
{
    public function __construct()
    {
        $this->CI =& get_instance();
    }
    public function get_files($dir="", $ignore_parent = true, $ext="")
    {
        $base_path = $this->CI->config->item('content_base_path');
        $search_path = $base_path.'/'.$dir;
        log_message('debug', 'File :'.$search_path);
        $files = array();
        $file_names = scandir($search_path);
        foreach ($file_names as $file) {
            if($ignore_parent && strcmp($file, '.') === 0 || strcmp($file, '..') === 0) {
                continue;
            }
            if($ext !== "") {
                $fileinfo = pathinfo($file);
                if (!isset($fileinfo['extension']) || $fileinfo['extension'] !== $ext) {
                    continue;
                }
            }
            array_push($files, array(
                "type" => filetype($search_path.'/'.$file),
                "name"=>$file,
                "path"=>$dir,
                "base"=>$base_path)
            );
        }
        return $files;
    }
}
