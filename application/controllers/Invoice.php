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
    }

    public function index()
    {
        $id = null;
        $id = $this->input->get("id");
        if (!empty($id) && !is_numeric($id) ) {
            show_404();
        }
        $data['id'] = $this->Invoice_model->invoice_id();
        $data['info'] = $this->Invoice_model->load_invoice($id);
        $data['user'] = $this->Invoice_model->load_user();
        // $data['customer'] = $this->Invoice_model->load_customer($id);
        $this->load->view('invoice_list.php',$data);
    }

    public function delete()
    {
        $id = $this->input->get("id");
        $data['deleted_at'] = 1;
        if($this->Invoice_model->delete_invoice($id,$data)){
            redirect(base_url('/invoice'));
        }
    }

    public function register()
    {
        $data['user'] = $this->Invoice_model->load_user();
        $data['customer'] = $this->Invoice_model->load_customer();
        $this->load->view('invoice_individual.php',$data);

        if(!empty($this->input->post("product_name"))){

            $register = [
                'customer_id' => $this->input->post("customer",true),
                'product_name' => $this->input->post("product_name",true),
                'price' => $this->input->post("price",true),
                'num' => $this->input->post("num",true),
                'unit' => $this->input->post("unit",true),
                'created_at' => $this->input->post("date",true),
                'updated_at' => $this->input->post("date",true),
                'deleted_at' => 0
            ];
            $this->Invoice_model->create($register);
        }
    }

    public function edit()
    {
        $id = null;
        $id = $this->input->get("id");
        if (!empty($id) && !is_numeric($id) ) {
            show_404();
        }
        $data['info'] = $this->Invoice_model->load_invoice($id);
        $data['user'] = $this->Invoice_model->load_user();
        $data['customer'] = $this->Invoice_model->load_customer();
        $this->load->view('invoice_edit_view.php',$data);

        if(!empty($this->input->post("product_name"))){

            $register = [
                'customer_id' => $this->input->post("customer",true),
                'product_name' => $this->input->post("product_name",true),
                'price' => $this->input->post("price",true),
                'num' => $this->input->post("num",true),
                'unit' => $this->input->post("unit",true),
                'created_at' => $this->input->post("date",true),
                'updated_at' => $this->input->post("date",true),
            ];
            $this->Invoice_model->edit_invoice($id,$register);
        }
    }
}