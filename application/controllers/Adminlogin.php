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

    // 管理者ログイン画面
    public function index()
    {   
      // $data = array(
      //   'name' => $this->security->get_csrf_token_name(),
      //   'hash' => $this->security->get_csrf_hash()
      // );
        $this->load->view('admin/adminlogin_view');
    }

    // 管理者ログイン実行
    public function admin_login_check()
    {
      header("Content-Type: application/json; charset=utf-8");
      if($_SERVER["REQUEST_METHOD"] === "POST"){
        // csrfトークン判定
        // if($this->input->method(TRUE) !== 'POST'){
        //   show_404();
        // }
        $password = $this->input->post('password',true);
        if(empty($password)){
          // ログイン失敗
          echo json_encode(["message" => "パスワードを入力してください"]);
          exit();
        }
        define('admin_password','$2y$10$LpyGpGqKI8BmiN3otnOWoex2gLpLTCh27uXgEaCqjjrk7x2toqAkK');//adminpassword
        if(!empty($password) && password_verify($password,admin_password)){
          // ログイン成功
          $_SESSION['admin_login'] = true;
          echo json_encode(['success' => 1]);
          exit();
        }else{
          // ログイン失敗
          echo json_encode(['message' => 'パスワードが違います']);
          exit();
        }
      }else{
        // POST以外のとき
        echo json_encode(['message' => '許可されていないメソッドです']);
      }
      exit();
    }

      // 管理者ページログアウト
      public function admin_logout()
      { 
        if(!empty($_SESSION['admin_login'])){
          unset($_SESSION['admin_login']); // セッション破棄
        }
        header('location:/adminlogin');
        exit();
      }
}