<?php
class Admin extends CI_controller
{
    // デフォルトの設定
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('file');
        $this->load->model('Admin_model');
        $this->load->library('javascript');
        $this->load->library('form_validation');
        // $this->load->library('jquery');
    }

    // 管理者ログイン画面TOP表示 ユーザーリスト表示
    public function user_list()
    {
        if (!empty($_SESSION['admin_login'])) {
            $data['info'] = $this->Admin_model->all_data();
            $this->load->view('adminlist_view', $data);
        } else {
            //ログイン失敗 // セッションが無ければログイン画面へ
            header('location:/Adminlogin');
            exit();
        }
    }

    // ユーザーの詳細を見る
    public function show_userdata()
    {
        if (!empty($_SESSION['admin_login'])) {
            $id = $this->input->get('id', true);
            if (!empty($id)) {
                $data['info'] = $this->Admin_model->load($id);
                $this->load->view('show_userdata_view', $data);
            }
        } else {
            //ログイン失敗 // セッションが無ければログイン画面へ
            header('location:/Adminlogin');
            exit();
        }
    }

    // 新規登録フォーム表示
    public function registerform()
    {
        if(!empty($_SESSION['admin_login'])){
            $data = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
              );
            $this->load->view('admin_registerform_view',$data);
        }else{
            //ログイン失敗 // セッションが無ければログイン画面へ
            header('location:/Adminlogin');
            exit();
        }
    }

    // 新規登録実行 
    public function register()
    {
        if (!empty($_SESSION['admin_login'])) {
            if ($_SERVER["REQUEST_METHOD"] === 'POST') {
                // $input_data = $this->input->post();
                // var_dump($input_data);
                // exit();
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
                $input_adress1 = $this->input->post('adress1', true);
                $this->form_validation->set_rules(
                    'adress1',
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
                $input_bankname = $this->input->post('bank_name', true);
                $this->form_validation->set_rules(
                    'bank_name',
                    '振込先金融機関',
                    'trim',
                );
                $input_bankaccount = $this->input->post('bank_account', true);
                $this->form_validation->set_rules(
                    'bank_account',
                    '振込先口座番号',
                    'trim|numeric',
                    array(
                        'numeric' => "%sは半角数字で入力してください",
                    )
                );
             
                $data = [];
                $data = [
                    'name' => $input_name,
                    'kana' => $input_kana,
                    'mail' => $input_mail,
                    'post' => $input_post,
                    'prefecture' => $input_prefecture,
                    'adress1' => $input_adress1,
                    'address2' => $input_address2,
                    'tel' => $input_tel,
                    'fax' => $input_fax,
                    'bank_name' => $input_bankname,
                    'bank_account' => $input_bankaccount,
                ];
                // バリデーションチェック
                if ($this->form_validation->run() == false) {
                    $data = array(
                        'name' => $this->security->get_csrf_token_name(),
                        'hash' => $this->security->get_csrf_hash()
                      );
                    // バリデーションエラーあり
                    $this->load->view('admin_registerform_view',$data);
                } else {
                    // バリデーションエラーなし // DBへ編集登録
                    if ($this->Admin_model->register($data)) {
                        // 編集登録成功
                        $this->session->set_flashdata('message', '新規登録が完了しました。');
                        header('location:/Admin/user_list');
                        exit();
                    }
                }
            } else {
                //ログイン失敗 // セッションが無ければログイン画面へ
                header('location:/Adminlogin');
                exit();
            }
        }
    }

    //編集リスト表示
    public function editlist()
    {
        if (!empty($_SESSION['admin_login'])) {
            $data['info'] = $this->Admin_model->all_data();
            $this->load->view('editlist_view', $data);
        } else {
            //ログイン失敗 // セッションが無ければログイン画面へ
            header('location:/Adminlogin');
            exit();
        }
    }

    // 編集フォーム表示
    public function editform()
    {
        if (!empty($_SESSION['admin_login'])) {
            $id = $this->input->get('id', true);
            if (!is_numeric($id)) {
                return show_404();
            }
            if (!empty($id)) {
                $data = [
                    'name' => $this->security->get_csrf_token_name(),
                    'hash' => $this->security->get_csrf_hash(),
                ];
                $data['info'] = $this->Admin_model->load($id);
             ;
                if (is_null($data['info'])) {
                    return show_404();
                }
                $this->load->view('editpage_view', $data);
            }
        } else {
            //ログイン失敗 // セッションが無ければログイン画面へ
            header('location:/Adminlogin');
            exit();
        }
    }

    // 編集実行
    public function edit()
    {
        if (!empty($_SESSION['admin_login'])) {
            if ($_SERVER["REQUEST_METHOD"] === 'POST') {
                // $input_data = $this->input->post();
                // var_dump($input_data);
                // exit;
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
                $input_adress1 = $this->input->post('adress1', true);
                $this->form_validation->set_rules(
                    'adress1',
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
                $input_bankname = $this->input->post('bank_name', true);
                $this->form_validation->set_rules(
                    'bank_name',
                    '振込先金融機関',
                    'trim',
                );
                $input_bankaccount = $this->input->post('bank_account', true);
                $this->form_validation->set_rules(
                    'bank_account',
                    '振込先口座番号',
                    'trim|numeric',
                    array(
                        'numeric' => "%sは半角数字で入力してください",
                    )
                );
             
                $data = [];
                $data = [
                    'name' => $input_name,
                    'kana' => $input_kana,
                    'mail' => $input_mail,
                    'post' => $input_post,
                    'prefecture' => $input_prefecture,
                    'adress1' => $input_adress1,
                    'address2' => $input_address2,
                    'tel' => $input_tel,
                    'fax' => $input_fax,
                    'bank_name' => $input_bankname,
                    'bank_account' => $input_bankaccount,
                ];
                // バリデーションチェック
                if ($this->form_validation->run() == false) {
                    $data = array(
                        'name' => $this->security->get_csrf_token_name(),
                        'hash' => $this->security->get_csrf_hash()
                    );
                    $data['info'] = $this->Admin_model->load($id);
                    // バリデーションエラーあり
                    $this->load->view('editpage_view', $data);
                } else {
                    // バリデーションエラーなし // DBへ編集登録
                    if ($this->Admin_model->edit($id, $data)) {
                        // 編集登録成功
                        $this->session->set_flashdata('message', '登録情報を編集しました');
                        header('location:/Admin/editlist');
                        exit();
                    }
                }
            } else {
                //ログイン失敗 // セッションが無ければログイン画面へ
                header('location:/Adminlogin');
                exit();
            }
        }
    }

    // 削除リスト表示
    public function deletelist()
    {
        if (!empty($_SESSION['admin_login'])) {
            $data['info'] = $this->Admin_model->all_data();
            $this->load->view('deletelist_view', $data);
        } else {
            //ログイン失敗 // セッションが無ければログイン画面へ
            header('location:/Adminlogin');
            exit();
        }
    }

    // 削除フォーム表示
    public function deleteform()
    {
        if (!empty($_SESSION['admin_login'])) {
            $id = $this->input->get('id', true);
            if (!empty($id)) {
                $data['info'] = $this->Admin_model->load($id);
                $this->load->view('deletepage_view', $data);
            }
        } else {
            //ログイン失敗 // セッションが無ければログイン画面へ
            header('location:/Adminlogin');
            exit();
        }
    }

    // 論理削除実行
    public function delete()
    {
        if (!empty($_SESSION['admin_login'])) {
            $id = $this->input->get('id', true);
            if (!empty($id)) {
                // 論理削除
                $data = null;
                $data = [
                    'delete_flag' => 1
                ];
                if ($this->Admin_model->soft_delete($id, $data)) {
                    $this->session->set_flashdata('message', '登録情報を削除しました');
                    header('location:/Admin/deletelist');
                    exit();
                }
            }
        } else {
            //ログイン失敗 // セッションが無ければログイン画面へ
            header('location:/Adminlogin');
            exit();
        }
    }
}
