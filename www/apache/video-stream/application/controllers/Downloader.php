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
        //$this->load->model('download');
    }

    public function download()
    {
        //TODO: get download file list
        $download_list = $this->downloadList_model->get_download_list();
        foreach ($download_list as $value) {
            $url = "https://torrentkim5.net/bbs/rss.php?k=" . $value['filename'] . "&b=" . $value['board'];

            $content = file_get_contents($url);
            $content = preg_replace('/&(?![a-z]{2,5};)/', '&amp;', $content);
            $xml = simplexml_load_string($content);
            $num = 0;
            foreach($xml->channel->item as $item) {
                echo $item->link[0];
                //echo $item->description[0];
            }

            //print_r($content);
        }
        //TODO: request rss
        //TODO: parsing get reqeust file
        //TODO: check margnet if sended
        //TODO: exec torrent
        //TODO: delete old file

    }
}
