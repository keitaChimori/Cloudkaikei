<?php
class Adminlogin extends CI_controller
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
    }

    public function index()
    {
        $this->load->view('adminlogin_view.php');
    }
}