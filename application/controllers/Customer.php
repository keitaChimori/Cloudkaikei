<?php
class Customer extends CI_controller
{
  // デフォルトの設定
  public function __construct()
  {
    parent::__construct();
    $this->load->library('session');
    $this->load->helper('url');
    $this->load->helper(array('form', 'url'));
    $this->load->helper('file');
    $this->load->model('Customer_model');
    $this->load->model('Cloudkaikei_model');
    $this->load->library('javascript');
    $this->load->library('form_validation');
  }

  // 顧客リスト表示
  public function index()
  {
    if(!empty($_SESSION['id'])){
      $user_id = $_SESSION['id'];
     
      //user_nameを取得(サイドメニュー用)
      $user_name = $this->Cloudkaikei_model->fetch_username($user_id);
      $data['user_name'] = $user_name;

      //nameが未登録の場合はmypageを表示
      if(empty($user_name['name'])){
        header('location:/Mypage');
        exit;
      }else{
        // nameが登録済の場合は顧客リストTOPを表示
        $data['info'] = $this->Customer_model->customer_data($user_id);
        $this->load->view('customer/customer_list_view', $data);
      }
    }else{
       // sessionなし、ログイン画面へ
       header('location:/login');
       exit;
    }
  }

  // 編集フォーム表示
  public function editform()
  {
    if(!empty($_SESSION['id'])){
      // getでidを取得
      $id = $this->input->get('id');
      if (!is_numeric($id)) {
        return show_404();
      }
      // csrf対策
      // $data = array(
      //   'name' => $this->security->get_csrf_token_name(),
      //   'hash' => $this->security->get_csrf_hash()
      // );
      //選択したカスタマー情報を取得
      $data['info'] = $this->Customer_model->fetch_customerdata($id);
      if (is_null($data["info"])) {
        return show_404();
      }
      // サイドメニューユーザー名表示用
      $user_id = $_SESSION['id'];
      $user_name = $this->Cloudkaikei_model->fetch_username($user_id);//nameを取得
      $data['user_name'] = $user_name;

      // 編集フォーム表示
      $this->load->view('customer/customer_editform_view', $data,$user_name);
    } else {
      // sessionなし、ログイン画面へ
      header('location:/login');
      exit;
    }
  }

  // 編集実行
  public function edit()
  {
    if ($_SERVER["REQUEST_METHOD"] === 'POST') {
      $id = $this->input->post('user_id', true);
      // 値受け取り
      $input_name = $this->input->post('name', true);
      $input_kana = $this->input->post('kana', true);     
      $input_name_title = $this->input->post('name_title', true);
      $input_mail = $this->input->post('mail', true); 
      $input_post = $this->input->post('post', true);  
      $input_prefecture = $this->input->post('prefecture', true);
      $input_address1 = $this->input->post('address1', true);
      $input_address2 = $this->input->post('address2', true);  
      $input_tel = $this->input->post('tel', true); 
      $input_fax = $this->input->post('fax', true);
      $input_customer_group = $this->input->post('customer_group', true);  
      $input_position = $this->input->post('position', true);  
      $input_person = $this->input->post('person', true);
   
      $data = [];
      $data = [
        'name' => $input_name,
        'kana' => $input_kana,
        'name_title' => $input_name_title,
        'mail' => $input_mail,
        'post' => $input_post,
        'prefecture' => $input_prefecture,
        'address1' => $input_address1,
        'address2' => $input_address2,
        'tel' => $input_tel,
        'fax' => $input_fax,
        'customer_group' => $input_customer_group,
        'position' => $input_position,
        'person' => $input_person,
      ];
      // バリデーションチェック
      if ($this->form_validation->run('customer_edit') == false) {
        // csrf対策
        // $data = array(
        //   'name' => $this->security->get_csrf_token_name(),
        //   'hash' => $this->security->get_csrf_hash()
        // );
        // バリデーションエラーあり
        $data['info'] = $this->Customer_model->fetch_customerdata($id);
        // サイドメニュー用
        $user_id = $_SESSION['id'];
        $user_name = $this->Cloudkaikei_model->fetch_username($user_id['id']);
        $data['user_name'] = $user_name;
        
        //編集フォームに戻る 
        $this->load->view('customer/customer_editform_view', $data);
      } else {
        // バリデーションエラーなし
        // DBへ編集登録
        if ($this->Customer_model->update($id, $data)) {
          // 編集登録成功
          $this->session->set_flashdata('message', '顧客情報を編集しました');
          header('location:/customer');
          exit();
        }
      }
    } else {
      header('location:/customer');
    }
  }

  // 顧客情報削除実行
  public function delete()
  {
    // getでid受け取り
    $id = $this->input->get('id', true);
    if (!empty($id)) {
      // 論理削除
      $data = null;
      $data = ['deleted_flag' => 1];
      if ($this->Customer_model->soft_delete($id, $data)) {
        $this->session->set_flashdata('message', '顧客情報を削除しました');
        header('location:/customer');
      }
    }else{
      $this->session->set_flashdata('message', '削除できませんでした');
      header('location:/customer');
    }
  }


  // 顧客新規登録フォーム表示
  public function customer_register()
  {
    if(!empty($_SESSION['id'])){
      // csrf対策
      // $data = array(
      //   'name' => $this->security->get_csrf_token_name(),
      //   'hash' => $this->security->get_csrf_hash()
      // );
      // サイドメニュー用
      $user_id = $_SESSION['id'];
      $user_name = $this->Cloudkaikei_model->fetch_username($user_id);//nameを取得
      $data['user_name'] = $user_name;
      // 顧客新規登録フォーム表示
      $this->load->view('customer/customer_registerform_view', $data);
    }else{
       // sessionなし、ログイン画面へ
       header('location:/login');
       exit;
    }
  }

  // 顧客新規登録実行
  public function customer_register_done()
  {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      // user_id
      $input_id = $_SESSION['id'];

      // バリデーション
      $input_name = $this->input->post('name', true);
      $input_kana = $this->input->post('kana', true);
      $input_name_title = $this->input->post('name_title', true);
      $input_mail = $this->input->post('mail', true);
      $input_post = $this->input->post('post', true);
      $input_prefecture = $this->input->post('prefecture', true);
      $input_address1 = $this->input->post('address1', true);
      $input_address2 = $this->input->post('address2', true);
      $input_tel = $this->input->post('tel', true);
      $input_fax = $this->input->post('fax', true);
      $input_customer_group = $this->input->post('customer_group', true);
      $input_position = $this->input->post('position', true);
      $input_person = $this->input->post('person', true);

      $data = null;
      $data = [
        'user_id' => $input_id,
        'name' => $input_name,
        'kana' => $input_kana,
        'name_title' => $input_name_title,
        'mail' => $input_mail,
        'post' => $input_post,
        'prefecture' => $input_prefecture,
        'address1' => $input_address1,
        'address2' => $input_address2,
        'tel' => $input_tel,
        'fax' => $input_fax,
        'customer_group' => $input_customer_group,
        'position' => $input_position,
        'person' => $input_person,
      ];
      if ($this->form_validation->run('customer_register') == false) {
        // バリデーションエラーあり
        // $data = array(
        //   'name' => $this->security->get_csrf_token_name(),
        //   'hash' => $this->security->get_csrf_hash()
        // );
        // サイドメニュー用
        $user_id = $_SESSION['id'];
        $user_name = $this->Cloudkaikei_model->fetch_username($user_id);//nameを取得
        $data['user_name'] = $user_name;

        // 新規登録フォームに戻る
        $this->load->view('customer/customer_registerform_view', $data);
      } else {
        // バリデーションエラーなし
        // DBへ登録
        if ($this->Customer_model->register($data)) {
          $this->session->set_flashdata('message', '顧客新規登録が完了しました');
          header('location:/customer');
          exit();
        }
      }
    } else {
      $this->load->view('sidemenu_view');
      $this->load->view('customer/customer_list_view');
      exit;
    }
  }
}
