<?php
class Downloader extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load TextHelper
        //$this->load->helper('text');
        // Load database
        $this->load->model('downloadList_model');
        $this->load->model('downloaded_model');
    }
    private function getFeedItem($filename , $board) {
        //nas 에서 https 요청시 멈춰버리는현상발생. URL변경함.
        //$url = "https://torrentkim5.net/bbs/rss.php?k=" . $filename . "&b=" . $board;
        $url = "http://rss.iroot.kr/rss2.php?k=".$filename."&b=".$board;        
        $content = file_get_contents($url);
        $xml = simplexml_load_string($content);        
        $item = $xml->channel->item[0];
        return $item;
    }

    private function isDownloaded($filename) {
        $result = $this->downloaded_model->get(array("filename"=>$filename));
        if(count($result) < 1) {
            return false;
        }

        return $result;
    }

    private function delete_files($path) {        
        //Nas find 에 exec 명령이 안먹음.
        //$delete_cmd = sprintf('find %s -type f -mtime +30 -exec rm {} \;',$path);
        $delete_list = scandir($path);
        log_message("debug","delete_list : ".print_r($delete_list,TRUE));
        $now = time();        
        foreach ($delete_list as $key => $value) {
            if(is_file($value) && filemtime($value) > 60 * 60* 24 * 30) {
                unlink($value);
            }            
        }
    }

    private function delete_old_list () {
        $this->downloaded_model->delete();
    }

    public function download()
    {
        $download_list = $this->downloadList_model->get_download_list();
        foreach ($download_list as $value) {            
            $item = $this->getFeedItem($value['filename'],$value['board']);
            log_message('debug','item : '.print_r($item->link,TRUE));
            $path = realpath($this->config->item('content_base_path').'/'.$value['path']);
            if(!$this->isDownloaded($item->title)) {                 
                $cmd = sprintf('transmission-remote localhost -n wishbeen:ts0705 -a \'%s\' -w %s',$item->link[0],$path);                
                exec($cmd);
                log_message("debug","start cmd : ".$cmd);
                $this->downloaded_model->insert(array("filename"=>$item->title[0]));
            }

            $this->delete_files($path);
            $this->delete_old_list();
        }
    }
}
