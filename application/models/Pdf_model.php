<?php

class Pdf_model extends CI_model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    //顧客情報を取得
    public function fetch_customerdata($id)
    {
        return $this->db->where('id',$id)
                        // ->select('name')
                        ->get('customer')
                        ->row_array();
    }

    // ユーザー情報を取得
    public function fetch_userdata($id)
    {
        return $this->db->where('id',$id)
                        ->get('user_data')
                        ->row_array();
    }
    
}