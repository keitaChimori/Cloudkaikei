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
        $this->load->library('javascript');
        date_default_timezone_set('Asia/Tokyo');
    }

    public function index()
    {
        $id = null;
        $id = $this->input->get("id");
        if (!empty($id) && !is_numeric($id) ) {
            show_404();
        }
        $data['id'] = $this->Invoice_model->invoice_id();
        $data['info'] = $this->Invoice_model->detail_preview($id);
        $data['invoice'] = $this->Invoice_model->invoice_preview($id);
        $data['user'] = $this->Invoice_model->load_user();
        $c_id = $data['info']['customer_id'];
        // $data['customer'] = $this->Invoice_model->customer($c_id);
        // $date['cname'] = $this->Invoice_model->load_customer();
        $data['customer'] = $this->Invoice_model->load_customer();
        $this->load->view('invoice_list.php',$data);
    }

    public function delete()
    {
        $id = null;
        $id = $this->input->get("id");
        if (!empty($id) && !is_numeric($id) ) {
            show_404();
        }
        $flag['delete_flag'] = 1;
        $time['deleted_at'] = date("Y-m-d H:i:s");
        
        if($this->Invoice_model->delete_invoice($id,$flag,$time)){
            redirect(base_url('/invoice'));
        }
    }

    public function register()
    {
        $data['user'] = $this->Invoice_model->load_user();
        $data['customer'] = $this->Invoice_model->load_customer();
        $this->load->view('invoice_individual.php',$data);

        // 請求書の登録
        if(!empty($this->input->post("product_name"))){
            // 合計金額の計算
            $price = $this->input->post("price",true);
            $num = $this->input->post("num",true);
            $total = $price * $num;

            // 作成日8桁に
            $date = $this->input->post("date",true);
            $date = str_replace('-', '', $date);

            $register_invoice = [
                'date' => $date,
                'customer' => $this->input->post("customer",true),
                'total' => $total,
                'note' => $this->input->post("note",true),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ];
            $this->Invoice_model->create($register_invoice);

            $invoice_id = $this->Invoice_model->create_id();
            $invoice_id = $invoice_id['id'];
            $register_detail = [
                'customer_id' => $this->input->post("customer",true),
                'invoice_id' => $invoice_id,
                'product_name' => $this->input->post("product_name",true),
                'price' => $this->input->post("price",true),
                'num' => $this->input->post("num",true),
                'unit' => $this->input->post("unit",true),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'deleted_at' => 0,
            ];
            if($this->Invoice_model->create_detail($register_detail))
            {
                redirect(base_url('/invoice?id='.$invoice_id));
            }
        }
    }

    public function edit()
    {
        $id = null;
        $id = $this->input->get("id");
        if (!empty($id) && !is_numeric($id) ) {
            show_404();
        }
        $data['info'] = $this->Invoice_model->detail_preview($id);
        $data['user'] = $this->Invoice_model->load_user();
        $data['customer'] = $this->Invoice_model->load_customer();
        $this->load->view('invoice_edit_view.php',$data);

        if(!empty($this->input->post("product_name"))){
            // 合計金額の計算
            $price = $this->input->post("price",true);
            $num = $this->input->post("num",true);
            $total = $price * $num;

            // 作成日8桁に
            $date = $this->input->post("date",true);
            $date = str_replace('-', '', $date);

            $register = [
                'date' => $date,
                'customer' => $this->input->post("customer",true),
                'total' => $total,
                'note' => $this->input->post("note",true),
                'updated_at' => date("Y-m-d H:i:s")
            ];

            $register_detail = [
                'customer_id' => $this->input->post("customer",true),
                'product_name' => $this->input->post("product_name",true),
                'price' => $this->input->post("price",true),
                'num' => $this->input->post("num",true),
                'unit' => $this->input->post("unit",true),
                'updated_at' => date("Y-m-d H:i:s"),
                'deleted_at' => 0,
            ];
            if($this->Invoice_model->edit_invoice($id,$register,$register_detail)){
                redirect(base_url('/invoice?id='.$id));
            }
        }
    }
}