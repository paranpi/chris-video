<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class File
{
    public function __construct()
    {
        $this->CI =& get_instance();
    }
    private function sort_by_date ($a, $b) {
        $amtime = filemtime($a['base'].'/'.$a['path'].'/'.$a['name']);
        $bmtime = filemtime($b['base'].'/'.$b['path'].'/'.$b['name']);
        return  $amtime < $bmtime;
    }
    public function get_files($dir="", $ignore_parent = true, $ext="", $sort="")
    {
        $base_path = $this->CI->config->item('content_base_path');
        $search_path = $base_path.'/'.$dir;
        log_message('debug', 'File :'.$search_path);
        $files = array();
        $file_names = scandir($search_path);
        foreach ($file_names as $file) {
            if($ignore_parent && $file[0] === '.') {
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
        if($sort === "latest") {
            uasort($files, array($this,'sort_by_date'));
        }
        return $files;
    }
}
