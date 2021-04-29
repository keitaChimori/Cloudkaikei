<?php
class Invoice extends CI_controller
{
    // デフォルトの設定
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('file');
        $this->load->model('Invoice_model');
        $this->load->model('Cloudkaikei_model');
        $this->load->library('javascript');
        date_default_timezone_set('Asia/Tokyo');
    }

    // 請求書TOPページ表示
    public function index()
    {
        if (!empty($_SESSION['id'])) { //セッション確認

            // サイドメニューの名前表示用
            $user_id = $_SESSION['id'];
            $user_name = $this->Cloudkaikei_model->fetch_username($user_id);//nameを取得
            $data['user_name'] = $user_name;
            //nameが未登録の場合はmypageを表示
            if(empty($user_name['name'])){
                header('location:/Mypage');
                exit;
            }else{
                // nameが登録済の場合は請求書TOP表示
                $id = null;
                $id = $this->input->get("id");
                if (!empty($id) && !is_numeric($id)) {
                    show_404();
                }
                $data['id'] = $this->Invoice_model->invoice_id();
                $data['info'] = $this->Invoice_model->detail_preview($id);
                $data['invoice'] = $this->Invoice_model->invoice_preview($id);
                $data['user'] = $this->Invoice_model->load_user();
                $data['customer'] = $this->Invoice_model->load_customer();
                $this->load->view('invoice_list', $data);

                if ($data['invoice']['delete_flag'] == 1) {
                    redirect(base_url('/invoice'));
                }
            }
        } else {
            // sessionなし、ログイン画面へ
            header('location:/login');
            exit;
        }
    }

    public function delete()
    {
        if (!empty($_SESSION['id'])) { //セッション確認

            $id = null;
            $id = $this->input->get("id");
            if (!empty($id) && !is_numeric($id)) {
                show_404();
            }
            $flag['delete_flag'] = 1;
            $time['deleted_at'] = date("Y-m-d H:i:s");

            if ($this->Invoice_model->delete_invoice($id, $flag, $time)) {
                redirect(base_url('/invoice'));
            }
        } else {
            // sessionなし、ログイン画面へ
            header('location:/login');
            exit;
        }
    }

    public function register()
    {
        if (!empty($_SESSION['id'])) { //セッション確認
            
            // サイドメニューの名前表示用
            $user_id = $_SESSION['id'];
            $user_name = $this->Cloudkaikei_model->fetch_username($user_id);//nameを取得
            $data['user_name'] = $user_name;

            $data['user'] = $this->Invoice_model->load_user();
            $data['customer'] = $this->Invoice_model->load_customer();
            $this->load->view('invoice_individual.php', $data);

            // 請求書の登録
            if (!empty($this->input->post("product_name"))) {

                $line = count($this->input->post("product_name"));
                $total = 0;
                for ($i = 0; $i < $line; $i++) {
                    // 合計金額の計算
                    $price = $this->input->post("price[$i]", true);
                    $num = $this->input->post("num[$i]", true);
                    $total = $total + ($price * $num);
                }
                // 作成日8桁に
                $date = $this->input->post("date", true);
                $date = str_replace('-', '', $date);
                $register_invoice = [
                    'date' => $date,
                    'customer' => $this->input->post("customer", true),
                    'total' => $total,
                    'note' => $this->input->post("note", true),
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ];
                $this->Invoice_model->create($register_invoice);

                $invoice_id = $this->Invoice_model->create_id();
                $invoice_id = $invoice_id['id'];

                for ($i = 0; $i < $line; $i++) {

                    $register_detail = [
                        'customer_id' => $this->input->post("customer", true),
                        'invoice_id' => $invoice_id,
                        'product_name' => $this->input->post("product_name[$i]", true),
                        'price' => $this->input->post("price[$i]", true),
                        'num' => $this->input->post("num[$i]", true),
                        'unit' => $this->input->post("unit[$i]", true),
                        'created_at' => date("Y-m-d H:i:s"),
                        'updated_at' => date("Y-m-d H:i:s"),
                        'deleted_at' => 0
                    ];
                    $this->Invoice_model->create_detail($register_detail);
                }
                redirect(base_url('/invoice?id=' . $invoice_id));
            }
        } else {
            // sessionなし、ログイン画面へ
            header('location:/login');
            exit;
        }
    }

    public function edit()
    {
        if (!empty($_SESSION['id'])) { //セッション確認

            // サイドメニューの名前表示用
            $user_id = $_SESSION['id'];
            $user_name = $this->Cloudkaikei_model->fetch_username($user_id); //nameを取得
            $data['user_name'] = $user_name;

            $id = null;
            $id = $this->input->get("id");
            if (!empty($id) && !is_numeric($id)) {
                show_404();
            }
            $data['invoice'] = $this->Invoice_model->invoice_preview($id);
            $data['info'] = $this->Invoice_model->detail_preview($id);
            $data['user'] = $this->Invoice_model->load_user();
            $data['customer'] = $this->Invoice_model->load_customer();
            $this->load->view('invoice_edit_view.php', $data);

            if ($data['invoice']['delete_flag'] == 1) {
                redirect(base_url('/invoice'));
            }


            // 請求書の登録
            if (!empty($this->input->post("product_name"))) {

                $line = count($this->input->post("product_name"));
                $total = 0;
                for ($i = 0; $i < $line; $i++) {
                    // 合計金額の計算
                    $price = $this->input->post("price[$i]", true);
                    $num = $this->input->post("num[$i]", true);
                    $total = $total + ($price * $num);
                }
                // 作成日8桁に
                $date = $this->input->post("date", true);
                $date = str_replace('-', '', $date);

                // 請求書の更新
                $register_invoice = [
                    'date' => $date,
                    'customer' => $this->input->post("customer", true),
                    'total' => $total,
                    'note' => $this->input->post("note", true),
                    'updated_at' => date("Y-m-d H:i:s")
                ];
                $this->Invoice_model->edit_invoice($id, $register_invoice);


                // 請求書の項目の更新
                $num = count($data['info']);
                $delete_detail = ['deleted_at' => date("Y-m-d H:i:s")];
                $this->Invoice_model->delete_detail($id, $delete_detail);
                for ($i = 0; $i < $line; $i++) {

                    $register_detail = [
                        'customer_id' => $this->input->post("customer", true),
                        'invoice_id' => $id,
                        'product_name' => $this->input->post("product_name[$i]", true),
                        'price' => $this->input->post("price[$i]", true),
                        'num' => $this->input->post("num[$i]", true),
                        'unit' => $this->input->post("unit[$i]", true),
                        'created_at' => date("Y-m-d H:i:s"),
                        'updated_at' => date("Y-m-d H:i:s"),
                        'deleted_at' => 0
                    ];
                    $this->Invoice_model->create_detail($register_detail);
                }
                redirect(base_url('/invoice?id=' . $id));
            }
        } else {
            // sessionなし、ログイン画面へ
            header('location:/login');
            exit;
        }
    }

}