<?php

class invoice_model extends CI_model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    //請求書用ユーザー情報取得
    public function load_user($user_id){
        return $this->db->where('id',$user_id)
                        ->get('user_data')
                        ->result_array();
    }

    public function invoice_id($user_id)
    {
        return $this->db->where("user_id",$user_id)
                        ->where("delete_flag", 0)
                        ->get('invoice')
                        ->result_array();
    }

    //選択した請求書のinveoceデータ取得
    public function invoice_preview($id,$user_id)
    {
        if (!empty($id)) {//選択した請求書がある場合
            $this->db->where("id", $id)
                     ->where("delete_flag", 0);
        }elseif(empty($id)) { //請求書があるけど未選択の場合(デフォルト)
            $this->db->where("user_id",$user_id)
                     ->where("delete_flag", 0)
                     ->order_by('id','ASC');
        }
        return $this->db->get('invoice')
                        ->row_array();
    }

    //請求書のinveoce_detailデータ取得
    public function detail_preview($id,$user_id){
        if (!empty($id)) {//選択した請求書詳細がある場合
            return $this->db->where("invoice_id", $id)
                            ->where("deleted_at", 0)
                            ->get('invoice_detail')
                            ->result_array();
        }else { //請求書詳細を未選択の場合(初期状態)
            return $this->db->from('invoice')
                            ->join('invoice_detail', 'invoice_detail.invoice_id = invoice.id')
                            ->where('user_id',$user_id)
                            ->where("deleted_at", 0)
                            ->get()
                            ->result_array();            
        }
        // return $this->db->get('invoice_detail')->row_array();
        // return $this->db->get('invoice_detail')->result_array();
    }



    public function delete_invoice($id,$flag,$time){
        $this->db->where('id', $id)
                        ->update('invoice',$flag);

        return $this->db->where('invoice_id', $id)
                        ->update('invoice_detail',$time);
    }

    // 選択した請求書の顧客名取得
    public function load_customer($user_id)
    {
        return $this->db->where('user_id',$user_id)
                        ->where('deleted_flag',0)
                        ->order_by('id', 'ASC')
                        ->get('customer')
                        ->result_array();
    }
    
    public function customer($id){
        if(!empty($id)){
            return $this->db->select("name")
                            ->where('id', $id)
                            ->get('customer')
                            ->result_array();
        }else{
            return $this->db->order_by('id', 'ASC')
            ->get('customer')
            ->result_array();
        }
    }

    public function create($register)
    {
        return $this->db->insert('invoice',$register);
    }

    public function create_detail($register)
    {
        return $this->db->insert('invoice_detail',$register);
    }

    public function create_id()
    {
        return $this->db->select("id")
        ->order_by('id', 'DESC')
        ->get('invoice')
        ->row_array();
    }

    public function edit_invoice($id,$data)
    {
        return $this->db->where('id', $id)
                         ->update('invoice',$data);

        // return $this->db->where('invoice_id', $id)
                    //    ->update('invoice_detail',$detail);
    }

    public function delete_detail($id,$data)
    {
        return $this->db->where('invoice_id', $id)
                        ->update('invoice_detail',$data);
    }

}