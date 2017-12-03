<?php
class Downloader extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        include_once APPPATH . 'third_party/simple_html_dom.php';
        include_once APPPATH . 'third_party/TransmissionRPC.class.php';
        $this->tfreeca_url = 'http://www.tfreeca22.com';
        // Load database
        $this->load->model('downloadlist_model');
        $this->load->model('downloaded_model');
    }
    private function get_magnet_link($url) {
        $html = file_get_html($this->tfreeca_url.'/'.$url);
        $magnet = $html->find('div.torrent_magnet a', 0);
        if($magnet) {
            return $magnet->href;
        }
        return "";
    }
    private function get_torrent_info($download_info) {
        $sc=str_replace(" ","+",$download_info['rss_keyword']);
        $b_id= $download_info['board_id'];
        $page= 1;
        $url = $this->tfreeca_url."/board.php?b_id=".$b_id."&&mode=list&sc=".$sc."&x=0&y=0&page=".$page."";

        // Create DOM from URL or file
        $html = file_get_html($url);
        // Find all links
        foreach($html->find('div.list_subject') as $element) {
            $atag = $element->find('a', 1);
            if($atag && strpos($atag->plaintext, '720p-NEXT')) {
                $title = $atag->plaintext;
                $href = $atag->href;
                // $href = $element->href;
                parse_str($href, $output);
                $iframe_url= 'torrent_info.php?bo_table='.$output['b_id'].'&wr_id='.$output['id'];
                $magnet= $this->get_magnet_link($iframe_url);
                return array(
                    'title' => $title,
                    'href' => $href,
                    'magnet' => $magnet
                );
            }
        }
        return;
    }

    private function isDownloaded($magnet) {
        $result = $this->downloaded_model->get(array("magnet"=>$magnet));
        if(count($result) < 1) {
            return false;
        }
        return $result;
    }
    private function add_torrent($rpc_param) {
        $url = 'http://paranpi.ipdisk.co.kr:9091/transmission/rpc';
        $username = 'paranpi';
        $password = '123456a';
        $rpc = new TransmissionRPC($url, $username, $password);
        echo $rpc_param['magnet'];
        $result = $rpc->add( (string) $rpc_param['magnet'], $rpc_param['destination'] ); // Magic happens here :)
        print "[{$result->result}]";
        print "\n";
    }
    public function download()
    {
        $download_list = $this->downloadlist_model->get_all();
        if ( count( $download_list ) < 1 ) {
            echo 'empty download list';
            return;
        }
        foreach ($download_list as $download) {
            $torrent = $this->get_torrent_info($download);
            // if($this->isDownloaded($torrent['magnet'])) {
            //     continue;
            // }
            // $this->downloaded_model->insert(array(
            //     'downloadListId' => $download['id'],
            //     'title' => $torrent['title'],
            //     'magnet' => $torrent['magnet']
            // ));
            $this->add_torrent(array (
                'destination' => $download['destination'],
                'magnet' => $torrent['magnet']
            ));
        }
    }
}
