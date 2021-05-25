<?php

class Ledger_model extends CI_model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // 売上台帳一覧
    public function load_invoice($user_id){
        return $this->db->where('user_id',$user_id)
                        ->where('delete_flag',0)
                        ->order_by('id', 'ASC')
                        ->get('invoice')
                        ->result_array();
    }

    // 売上台帳「取引先を選んでください」のプルダウン
    public function load_customer($user_id){
        return $this->db->where('user_id',$user_id)
                        ->where('deleted_flag',0)
                        ->get('customer')
                        ->result_array();
    }
}