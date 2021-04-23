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
     
      $user_name = $this->Cloudkaikei_model->fetch_username($user_id['id']);//nameを取得
      $data['user_name'] = $user_name;
      $data['info'] = $this->Customer_model->customer_data($user_id['id']);
      $this->load->view('customer_list_view', $data);
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
      $id = $this->input->get('id');
      if (!is_numeric($id)) {
        return show_404();
      }
      $data = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
      );
      $data['info'] = $this->Customer_model->fetch_customerdata($id);//カスタマー情報を取得
      if (is_null($data["info"])) {
        return show_404();
      }
      $user_id = $_SESSION['id'];
      $user_name = $this->Cloudkaikei_model->fetch_username($user_id['id']);//nameを取得
      $data['user_name'] = $user_name;
      $this->load->view('customer_editform_view', $data,$user_name);
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
      // バリデーション
      $input_name = $this->input->post('name', true);
      $this->form_validation->set_rules(
        'name',
        'お客様名',
        'required|trim',
        array(
          'required' => "%sが未入力です。",
        )
      );
      $input_kana = $this->input->post('kana', true);
      $this->form_validation->set_rules(
        'kana',
        'お客様名(カナ)',
        'trim',
      );
      $input_name_title = $this->input->post('name_title', true);
      $input_mail = $this->input->post('mail', true);
      $this->form_validation->set_rules(
        'mail',
        'メールアドレス',
        'trim|regex_match[/^[0-9a-z_.\/?-]+@([0-9a-z-]+\.)+[0-9a-z-]+$/]',
        array(
          'regex_match' => "%sは正しい形式で入力してください。",
        )
      );
      $input_post = $this->input->post('post', true);
      $this->form_validation->set_rules(
        'post',
        '郵便番号',
        'trim|numeric|regex_match[/^\d{7}$/]',
        array(
          'numeric' => "%sは半角数字・ハイフンなしで入力してください",
          'regex_match' => "%sは半角数字・ハイフンなしで入力してください",
        )
      );
      $input_prefecture = $this->input->post('prefecture', true);
      $input_address1 = $this->input->post('address1', true);
      $this->form_validation->set_rules(
        'address1',
        '住所1',
        'trim',
      );
      $input_address2 = $this->input->post('address2', true);
      $this->form_validation->set_rules(
        'address2',
        '住所2',
        'trim',
      );
      $input_tel = $this->input->post('tel', true);
      $this->form_validation->set_rules(
        'tel',
        '電話番号',
        'trim|numeric|regex_match[/^0\d{9,10}$/]',
        array(
          'numeric' => "%sは半角数字・ハイフンなしで入力してください",
          'regex_match' => "%sは半角数字・ハイフンなしで入力してください",
        )
      );
      $input_fax = $this->input->post('fax', true);
      $this->form_validation->set_rules(
        'fax',
        'FAX番号',
        'trim|numeric|regex_match[/^0\d{9,10}$/]',
        array(
          'numeric' => "%sは半角数字・ハイフンなしで入力してください",
          'regex_match' => "%sは半角数字・ハイフンなしで入力してください",
        )
      );
      $input_customer_group = $this->input->post('customer_group', true);
      $this->form_validation->set_rules(
        'customer_group',
        '部門',
        'trim',
      );
      $input_position = $this->input->post('position', true);
      $this->form_validation->set_rules(
        'position',
        '役職',
        'trim',
      );
      $input_person = $this->input->post('person', true);
      $this->form_validation->set_rules(
        'person',
        '担当者名',
        'trim',
      );

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
      if ($this->form_validation->run() == false) {
        $data = array(
          'name' => $this->security->get_csrf_token_name(),
          'hash' => $this->security->get_csrf_hash()
        );
        $data['info'] = $this->Customer_model->fetch_customerdata($id);
        $user_id = $_SESSION['id'];
        $user_name = $this->Cloudkaikei_model->fetch_username($user_id['id']);//nameを取得
        $data['user_name'] = $user_name;
        // バリデーションエラーあり
        $this->load->view('customer_editform_view', $data);
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

  // 顧客情報削除
  public function delete()
  {
    $id = $this->input->get('id', true);
    if (!empty($id)) {
      // 論理削除
      $data = null;
      $data = [
        'deleted_flag' => 1
      ];
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
      $data = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
      );
      $user_id = $_SESSION['id'];
      $user_name = $this->Cloudkaikei_model->fetch_username($user_id['id']);//nameを取得
      $data['user_name'] = $user_name;
      $data['info'] = $this->Customer_model->customer_data();
      $this->load->view('customer_registerform_view', $data);
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
      $input_id = $this->session->userdata('id');
      // バリデーション
      $input_name = $this->input->post('name', true);
      $this->form_validation->set_rules(
        'name',
        'お客様名',
        'required|trim',
        array(
          'required' => "%sが未入力です。",
        )
      );
      $input_kana = $this->input->post('kana', true);
      $this->form_validation->set_rules(
        'kana',
        'お客様名(カナ)',
        'trim',
      );
      $input_name_title = $this->input->post('name_title', true);
      $input_mail = $this->input->post('mail', true);
      $this->form_validation->set_rules(
        'mail',
        'メールアドレス',
        'trim|regex_match[/^[0-9a-z_.\/?-]+@([0-9a-z-]+\.)+[0-9a-z-]+$/]',
        array(
          'regex_match' => "%sは正しい形式で入力してください",
        )
      );
      $input_post = $this->input->post('post', true);
      $this->form_validation->set_rules(
        'post',
        '郵便番号',
        'trim|numeric|regex_match[/^\d{7}$/]',
        array(
          'numeric' => "%sは半角数字・ハイフンなしで入力してください",
          'regex_match' => "%sは半角数字・ハイフンなしで入力してください",
        )
      );
      $input_prefecture = $this->input->post('prefecture', true);

      $input_address1 = $this->input->post('address1', true);
      $this->form_validation->set_rules(
        'address1',
        '住所1',
        'trim',
      );
      $input_address2 = $this->input->post('address2', true);
      $this->form_validation->set_rules(
        'address2',
        '住所2',
        'trim',
      );
      $input_tel = $this->input->post('tel', true);
      $this->form_validation->set_rules(
        'tel',
        '電話番号',
        'trim|numeric|regex_match[/^0\d{9,10}$/]',
        array(
          'regex_match' => "%sは半角数字・ハイフンなしで入力してください",
          'numeric' => "%sは半角数字・ハイフンなしで入力してください",
        )
      );
      $input_fax = $this->input->post('fax', true);
      $this->form_validation->set_rules(
        'fax',
        'FAX番号',
        'trim|numeric|regex_match[/^0\d{9,10}$/]',
        array(
          'numeric' => "%sは半角数字・ハイフンなしで入力してください",
          'regex_match' => "%sは半角数字・ハイフンなしで入力してください",
        )
      );
      $input_customer_group = $this->input->post('customer_group', true);
      $this->form_validation->set_rules(
        'customer_group',
        '部門',
        'trim',
      );
      $input_position = $this->input->post('position', true);
      $this->form_validation->set_rules(
        'position',
        '役職',
        'trim',
      );
      $input_person = $this->input->post('person', true);
      $this->form_validation->set_rules(
        'person',
        '担当者名',
        'trim',
      );      

      $data = null;
      $data = [
        'user_id' => $input_id['id'],
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
      if ($this->form_validation->run() == false) {
        // バリデーションエラーあり
        $data = array(
          'name' => $this->security->get_csrf_token_name(),
          'hash' => $this->security->get_csrf_hash()
        );
        $user_id = $_SESSION['id'];
        $user_name = $this->Cloudkaikei_model->fetch_username($user_id['id']);//nameを取得
        $data['user_name'] = $user_name;
        $this->load->view('customer_registerform_view', $data);
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
      $this->load->view('customer_list_view');
    }
  }
}
