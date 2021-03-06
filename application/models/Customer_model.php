<?php

class Customer_model extends CI_model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // 顧客リストの全データ取得
    public function customer_data($id)
    {
      return $this->db->order_by('id', 'DESC')
                      ->where('deleted_flag',0)
                      ->where('user_id',$id)
                      ->get('customer')
                      ->result_array();
    }

    // 顧客新規登録
    public function register($data)
    {
      return $this->db->insert('customer',$data);
    }

    // 顧客編集フォームの表示用データ取得
    public function fetch_customerdata($id)
    {
      return $this->db->where([
                      'id' => $id,
                      'deleted_flag' => 0
                      ])
                      ->get('customer')
                      ->row_array();
    }

    // 顧客情報の編集
    public function update($id,$data)
    {
      return $this->db->where('id',$id)
                      ->update('customer',$data);
    } 

    // 顧客情報の削除(論理削除)
    public function soft_delete($id,$data)
    {
      return $this->db->where('id',$id)
                      ->update('customer',$data);
    }

    // user_dataテーブルからuserのidを取得
    public function fetch_userid($email)
    {
      return $this->db->where('mail',$email)
                      ->select('id')
                      ->get('user_data')
                      ->row_array();
    }

    // 新規登録時にサンプルデータを追加
    public function add_sampledata($data)
    {
      return $this->db->insert('customer',$data);
    }

}