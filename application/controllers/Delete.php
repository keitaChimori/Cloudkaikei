<?php
class Delete extends CI_controller
{
    // デフォルトの設定
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('file');
        $this->load->model('Cloudkaikei_model');
        $this->load->library('javascript');
        // $this->load->library('jquery');
    }

    // ユーザーの削除
    public function index(){
        $data['delete_flag'] = 1;
        $id = $this->input->post('user_id',TRUE);;
        if($this->Cloudkaikei_model->delete($id,$data)){
            redirect(base_url('Cloudkaikei/admin'));
        }
    }
}