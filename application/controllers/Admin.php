<?php

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('file');
        $this->load->library('pagination');
        $this->load->model('downloadlist_model');
        $this->load->model('downloaded_model');
        if($this->session->userdata('logged_in') === null) {
            return redirect('/login');
        }
    }
    private function get_dirs()
    {
        $data = array();
        $root_dirs = $this->file->get_files();
        foreach ($root_dirs as $key => $value) {
            array_push($data,$value);
            log_message('debug', 'value : '.$value['name']);
            $sub_dirs = $this->file->get_files($value['name']);
            log_message('debug', '$sub_dirs : '.print_r($sub_dirs,true));
            $data = array_merge($data,$sub_dirs);
        }
        return $data;
    }

    private function response($status=true, $data="")
    {
        $this->output->set_content_type('application/json');
        if ($status) {
            $status_msg = "SUCCESS";
        } else {
            $status_msg = "ERROR";
            $this->output->set_status_header(400);
        }
        $response_data = array("status"=>$status_msg,"data"=>$data);
        $this->output->set_output(json_encode($response_data));
    }

    public function index($page_num=1)
    {
        $data = array();
        $data['destinations'] = $this->get_dirs();
        $data['download_list'] = $this->downloadlist_model->get_all();
        $data['board_list'] = array(
            'tmovie' => '영화',
            'tdrama' => '드라마',
            'tent' => '예능',
            'tv' => 'TV프로',
            'tani' => '애니메이션'
        );
        $this->load->view('admin', $data);
    }

    public function add_download_list()
    {
        // $_POST += json_decode(file_get_contents('php://input'), true);
        if($this->session->userdata('logged_in') === null) {
            return redirect('/login');
        }
        $data = $this->security->xss_clean($this->input->post());
        log_message('debug', 'me : '.print_r($this->session->userdata('me'), true));

        $data['userId'] = $this->session->userdata('me')['id'];
        log_message('debug', 'post : '.print_r($data, true));
        $result = $this->downloadlist_model->insert($data);
        return redirect('/admin');
    }

    public function del_download_list($id)
    {
        $result = $this->downloadlist_model->delete($id);
        if ($result) {
            $this->response(true);
        } else {
            $this->response(false, json_encode($this->db->error()));
        }
    }
    public function get_downloaded($page_num = 1) {
        if($page_num < 1) $page_num = 1;
        $per_page = 10;
        $options = array('limit' => $per_page, 'offset' => (($page_num-1) * $per_page) );
        $downloaded = $this->downloaded_model->get_all($options);
        $config['num_links'] = 5;
        $config['use_page_numbers'] = TRUE;
        $config['base_url'] = '/admin/downloaded';
        $config['cur_tag_open'] = '<li class="page-item active"><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['next_link'] = '»';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '«';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['per_page'] = $per_page;
        $config['first_link'] = FALSE;
        $config['last_link'] = FALSE;
        $config['total_rows'] = $downloaded['count'];

        $data['downloaded_list'] = $downloaded['rows'];
        $data['start_num'] = ($page_num-1) * $per_page;
        $this->pagination->initialize($config);
        $this->load->view('downloaded', $data);
    }
    public function del_downloaded($id)
    {
        $result = $this->downloaded_model->delete($id);
        if ($result) {
            $this->response(true);
        } else {
            $this->response(false, json_encode($this->db->error()));
        }
    }
}
