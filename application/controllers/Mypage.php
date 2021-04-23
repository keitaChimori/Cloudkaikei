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
        $this->load->library('javascript');
        $this->load->library('form_validation');
    }

    // mypage表示
    public function index()
    {
        if (!empty($_SESSION['id'])) {
            $user_id = $_SESSION['id'];
            // var_dump($user_id);
            // exit;
            if (!empty($user_id)) {
                $data = array(
                    'name' => $this->security->get_csrf_token_name(),
                    'hash' => $this->security->get_csrf_hash()
                );
                $data['info'] = $this->Cloudkaikei_model->fetch_userdata($user_id['id']);
                $user_id = $_SESSION['id'];
                $user_name = $this->Cloudkaikei_model->fetch_username($user_id['id']);//nameを取得
                $data['user_name'] = $user_name;
                // var_dump($data);
                // exit;
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
                'required|trim|regex_match[/^[0-9a-z_.\/?-]+@([0-9a-z-]+\.)+[0-9a-z-]+$/]',
                array(
                    'required' => "%sが未入力です。",
                    'regex_match' => "%sは正しい形式で入力してください。",
                )
            );
            $input_post = $this->input->post('post', true);
            $this->form_validation->set_rules(
                'post',
                '郵便番号',
                'required|trim|numeric|regex_match[/^\d{7}$/]',
                array(
                    'required' => "%sが未入力です。",
                    'numeric' => "%sは半角数字・ハイフンなしで入力してください",
                    'regex_match' => "%sは半角数字・ハイフンなしで入力してください",
                )
            );
            $input_prefecture = $this->input->post('prefecture', true);
            $this->form_validation->set_rules(
                'prefecture',
                '都道府県',
                'required',
                array(
                    'required' => "%sを選択してください",

                )
            );
            $input_address1 = $this->input->post('address1', true);
            $this->form_validation->set_rules(
                'address1',
                '住所1',
                'required|trim',
                array(
                    'required' => "%sが未入力です。",
                )
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
                'required|trim|numeric|regex_match[/^0\d{9,10}$/]',
                array(
                    'required' => "%sが未入力です。",
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
                'address1' => $input_address1,
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
