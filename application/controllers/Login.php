<?php
class Login extends CI_controller
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
        $this->load->model('Login_model');
        $this->load->library('javascript');
        $this->load->library('form_validation');
        // $this->load->library('jquery');
    }

    // ユーザーログイン画面表示
    public function index()
    {
        $this->load->view('userlogin_view.php');
    }

    // ログインチェック
    public function login_check()
    {
      header("Content-Type: application/json; charset=utf-8");
      if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $email = $this->input->post('Email');
        if(empty($email)){
          // ログイン失敗
          echo json_encode(['message' => 'メールアドレスを入力してください']);
          exit();
        }
        $password = $this->input->post('password');
        if(empty($password)){
          // ログイン失敗
          echo json_encode(["message" => "パスワードを入力してください"]);
          exit();
        }
        
        // DBからパスワードを取得
        $user_password = $this->Login_model->fetch_pass($email);

        if(!empty($user_password) && password_verify($password,$user_password['password'])){
          $_SESSION['user_login'] = true;
          // ログイン成功
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
  
  
    // ユーザー画面(ログイン成功後)
    // public function admin()
    // {
    //   if(!empty($_SESSION['admin_login']) || $_SESSION['admin_login'] === true){
    //     //  セッションあり
    //     $this->load->view('header_view');
    //     $this->load->view('admin_view');
    //   }else{
    //     // セッション切れ
    //     header('location:/cloudkaikei/login');
    //     exit();
    //   }
    // }
  
    // ログアウト
    public function logout()
    {
      if(!empty($_SESSION['user_login']) || $_SESSION['user_login'] === true){
        // セッション破棄
        unset($_SESSION['user_login']);
        header('location:/login');
        exit();
      }
      if(!empty($_SESSION['admin_login']) || $_SESSION['admin_login'] === true){
        // セッション破棄
        unset($_SESSION['user_login']);
        header('location:/admin_login');
        exit();
      }
    }

    // 新規登録画面表示
    public function register()
    {
        $this->load->view('userregister_view');
    }

    // 新規登録実行
    public function registerDone()
    {
      if(!empty($this->input->post('submit'))){
        // 値の受け取り
        $email = $this->input->post('Email');
        $password  = $this->input->post('password1');
        // バリデーション設定
        $this->form_validation->set_rules(
          'Email','メールアドレス','required|regex_match[/^[0-9a-z_.\/?-]+@([0-9a-z-]+\.)+[0-9a-z-]+$/]|trim|is_unique[user_data.mail]',
          array(
            'required' => "%sが未入力です。",
            'regex_match' => "%sは正しい形式で入力してください。",
            'is_unique' => "入力した%sは既に登録されています。"
          )
        );
        $this->form_validation->set_rules(
          'password1','パスワード','required|regex_match[/^(?=.*?[a-z])(?=.*?\d)[a-z\d]{5,20}$/i]|trim|matches[password2]',
          array(
            'required' => "%sが未入力です。",
            'regex_match' => "%sは5文字以上20文字以下の半角数字、半角英字を含む値を入力してください。",
            'matches' => "%sとパスワード【確認用】が一致しません。"
          )
        );
        $this->form_validation->set_rules(
          'password2','パスワード【確認用】','required',
          array(
            'required' => "%sが未入力です。",
          )
        );
        //セッション
        $data = [];
        if($email){
          $data['email'] = $email;
          $_SESSION['email'] = $email;
        }
        
        if($this->form_validation->run() == false){
          // 失敗
          $this->load->view('userregister_view',$data);
        }else{
          // 成功
          $hash_password = password_hash($password,PASSWORD_DEFAULT);// passwordハッシュ化
          $data = null;
          $data = [
            'mail' => $email,
            'password' => $hash_password,
          ];
          // DBへ登録
          if($this->Login_model->insert($data)){
            $this->session->set_flashdata("message","新規登録が完了しました。");
            header('location:/login/register');
            exit();
          }
        }
      }
    }

    // 管理者ログイン画面
    public function admin_login()
    {
      $this->load->view('adminlogin_view');
    }

    // 管理者ログイン画面
    public function admin_login_check()
    {
      header("Content-Type: application/json; charset=utf-8");
      if($_SERVER["REQUEST_METHOD"] === "POST"){
        $password = $this->input->post('password');

        if(empty($password)){
          // ログイン失敗
          echo json_encode(["message" => "パスワードを入力してください"]);
          exit();
        }
        define('admin_password','$2y$10$LpyGpGqKI8BmiN3otnOWoex2gLpLTCh27uXgEaCqjjrk7x2toqAkK');//adminpassword
        if(!empty($password) && password_verify($password,admin_password)){
          $_SESSION['admin_login'] = true;
          // ログイン成功
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





    	




}