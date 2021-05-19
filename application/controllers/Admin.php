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
    }

    // 管理者ログイン画面TOP表示 ユーザーリスト表示
    public function user_list()
    {
        if (!empty($_SESSION['admin_login'])) {
            $data['info'] = $this->Admin_model->all_data();
            $this->load->view('admin/adminlist_view', $data);
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
            if(empty($id)) {
                return show_404();
            }
            $data['info'] = $this->Admin_model->load($id);
            $this->load->view('admin/admin_showuserdata_view', $data);
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
            // $data = array(
            //     'name' => $this->security->get_csrf_token_name(),
            //     'hash' => $this->security->get_csrf_hash()
            //   );
            $this->load->view('admin/admin_registerform_view');
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
                // 値受け取り
                $input_name = $this->input->post('name', true);
                $input_kana = $this->input->post('kana', true);
                $input_mail = $this->input->post('mail', true);
                $input_post = $this->input->post('post', true);
                $input_prefecture = $this->input->post('prefecture', true);
                $input_address1 = $this->input->post('address1', true);
                $input_address2 = $this->input->post('address2', true);
                $input_tel = $this->input->post('tel', true);
                $input_fax = $this->input->post('fax', true);
                $input_bankname = $this->input->post('bank_name', true);
                $input_bankaccount = $this->input->post('bank_account', true);
             
                $data = [];
                $data = [
                    'name' => $input_name,
                    'kana' => $input_kana,
                    'mail' => $input_mail,
                    'post' => $input_post,
                    'prefecture' => $input_prefecture,
                    'address1' => $input_address1,
                    'address2' => $input_address2,
                    'tel' => $input_tel,
                    'fax' => $input_fax,
                    'bank_name' => $input_bankname,
                    'bank_account' => $input_bankaccount,
                ];
                // バリデーションチェック
                if ($this->form_validation->run('admin_register') == false) {
                    // $data = array(
                    //     'name' => $this->security->get_csrf_token_name(),
                    //     'hash' => $this->security->get_csrf_hash()
                    //   );
                    // バリデーションエラーあり
                    $this->load->view('admin/admin_registerform_view');
                    
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
            $this->load->view('admin/admin_editlist_view', $data);
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
                // $data = [
                //     'name' => $this->security->get_csrf_token_name(),
                //     'hash' => $this->security->get_csrf_hash(),
                // ];
                $data['info'] = $this->Admin_model->load($id);
                if (is_null($data['info'])) {
                    return show_404();
                }
                $this->load->view('admin/admin_editpage_view', $data);
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
                $id = $this->input->post('user_id', true);
                // 値受け取り
                $input_name = $this->input->post('name', true);
                $input_kana = $this->input->post('kana', true);
                $input_mail = $this->input->post('mail', true);
                $input_post = $this->input->post('post', true);
                $input_prefecture = $this->input->post('prefecture', true);
                $input_address1 = $this->input->post('address1', true);
                $input_address2 = $this->input->post('address2', true);
                $input_tel = $this->input->post('tel', true);
                $input_fax = $this->input->post('fax', true);
                $input_bankname = $this->input->post('bank_name', true);
                $input_bankaccount = $this->input->post('bank_account', true);
           
                $data = [];
                $data = [
                    'name' => $input_name,
                    'kana' => $input_kana,
                    'mail' => $input_mail,
                    'post' => $input_post,
                    'prefecture' => $input_prefecture,
                    'address1' => $input_address1,
                    'address2' => $input_address2,
                    'tel' => $input_tel,
                    'fax' => $input_fax,
                    'bank_name' => $input_bankname,
                    'bank_account' => $input_bankaccount,
                ];
                // バリデーションチェック
                if ($this->form_validation->run('admin_edit') == false) {
                    // $data = array(
                    //     'name' => $this->security->get_csrf_token_name(),
                    //     'hash' => $this->security->get_csrf_hash()
                    // );
                    $data['info'] = $this->Admin_model->load($id);
                    // バリデーションエラーあり
                    $this->load->view('admin/admin_editpage_view', $data);
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
            $this->load->view('admin/admin_deletelist_view', $data);
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
            if (empty($id)) {
                return show_404();
            }
            $data['info'] = $this->Admin_model->load($id);
            $this->load->view('admin/admin_deletepage_view', $data);
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
            if (empty($id)) {
                return show_404();
            }
            // 論理削除
            $data = null;
            $data = ['delete_flag' => 1];
            if ($this->Admin_model->soft_delete($id, $data)) {
                $this->session->set_flashdata('message', '登録情報を削除しました');
                header('location:/Admin/deletelist');
                exit();
            }
        } else {
            //ログイン失敗 // セッションが無ければログイン画面へ
            header('location:/Adminlogin');
            exit();
        }
    }
}
