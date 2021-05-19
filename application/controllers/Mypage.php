<!-- ************************************* -->
<!-- *********  マイページ機能  ********** -->
<!-- ************************************* -->
<?php

class Mypage extends CI_controller
{
    // デフォルトの設定
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('file');
        $this->load->model('Mypage_model');
        $this->load->model('Cloudkaikei_model');
        $this->load->library('javascript');
        $this->load->library('form_validation');
    }

    // マイページ表示
    public function index()
    {
        if (!empty($_SESSION['id'])) { //セッション確認
            $user_id = $_SESSION['id'];

            if (!empty($user_id)) {
                
                //user_dataを取得
                $data['info'] = $this->Cloudkaikei_model->fetch_userdata($user_id);
                //nameを取得(サイドメニュー用)
                $user_name = $this->Cloudkaikei_model->fetch_username($user_id);
                $data['user_name'] = $user_name;
                // マイページ表示
                $this->load->view('mypage_view', $data);
            } else {
                show_404();
                exit;
            }
        } else {
            // sessionなし、ログイン画面へ
            header('location:/login');
            exit;
        }
    }

    // ユーザー情報編集
    public function edit()
    {
        // マイページ情報登録
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
            if ($this->form_validation->run('mypage') == false) {
                // csrf
                $data = array(
                    'name' => $this->security->get_csrf_token_name(),
                    'hash' => $this->security->get_csrf_hash()
                );
                // バリデーションエラーあり
                $data['info'] = $this->Cloudkaikei_model->fetch_userdata($id);
                $this->load->view('mypage_view', $data);
            } else {
                // バリデーションエラーなし // DBへ編集登録
                if ($this->Cloudkaikei_model->edit_userdata($id, $data)) {
                    // 編集登録成功
                    $this->session->set_flashdata('message', '登録情報を更新しました');
                    header('location:/Mypage');
                }
            }
        } else {
            // sessionなし,post以外、ログイン画面へ
            header('location:/login');
            exit;
        }
    }
}
