<?php

class Cloudkaikei_model extends CI_model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function load(){
        return $this->db->order_by('id', 'ASC')
        ->get('user_data')
        ->result_array();
    }

    // ユーザーネーム取得(サイドメニュー用)
    public function fetch_username($id){
        return $this->db->where('id', $id)
        ->select('name')
        ->get('user_data')
        ->row_array();
    } 

    //ユーザーデータ取得 
    public function fetch_userdata($id){
        return $this->db->where('id', $id)
        ->get('user_data')
        ->row_array();
    }

    // ユーザーデータの更新
    public function edit_userdata($id,$data){
        return $this->db->where('id',$id)
        ->update('user_data',$data);
    }

    // public function load_invoice(){
    //     return $this->db->order_by('id', 'ASC')
    //     ->get('invoice')
    //     ->result_array();
    // }

    public function edit_update($id,$data)
    {
        return $this->db->where('id', $id)
        ->update('user_data', $data);
    }

    public function delete($id,$data)
    {
        return $this->db->where('id', $id)
        ->update('user_data', $data);
    }

}