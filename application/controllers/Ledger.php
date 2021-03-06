<?php
class Ledger extends CI_controller
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
    public function index()
    {
        $data['info'] = $this->Cloudkaikei_model->load_invoice();
        $this->load->view('ledger_view.php',$data);
    }
}