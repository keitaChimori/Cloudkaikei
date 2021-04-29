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
        $this->load->model('Ledger_model');
        $this->load->model('Cloudkaikei_model');
        $this->load->library('javascript');
        // $this->load->library('jquery');
    }

    // 売上台帳表示
    public function index()
    {
        if (!empty($_SESSION['id'])) {
            $user_id = $_SESSION['id'];
            $user_name = $this->Cloudkaikei_model->fetch_username($user_id); //nameを取得
            $data['user_name'] = $user_name;
            //nameが未登録の場合はmypageを表示
            if (empty($user_name['name'])) {
                header('location:/Mypage');
                exit;
            } else {
                // nameが登録済の場合は売上台帳表示
                $data['active'] = $this->input->get('active', true);
                $data['info'] = $this->Cloudkaikei_model->load_invoice();
                $data['customer'] = $this->Ledger_model->load_customer();
                $this->load->view('ledger_view', $data);
            }
        } else {
            // sessionなし、ログイン画面へ
            header('location:/login');
            exit;
        }
    }
}
