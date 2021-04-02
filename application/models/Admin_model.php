<?php

class Admin_model extends CI_model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // ユーザーリスト、全ユーザー情報を取得
    public function all_data()
    {
        return $this->db->where('delete_flag',0)
                    ->order_by('id', 'ASC')
                    ->get('user_data')
                    ->result_array();
    }

    // 新規登録
    public function register($data)
    {
        return $this->db->insert('user_data',$data);
    }

    // 編集フォーム、顧客情報の取得
    public function load($id){
        return $this->db->where([
                        'id' => $id,
                        'delete_flag' => 0,
                        ])
                        ->get('user_data')
                        ->row_array();
    }

    // 編集実行
    public function edit($id,$data){
        return $this->db->where('id',$id)
                        ->update('user_data',$data);
    }

    // 削除実行
    public function soft_delete($id,$data){
        return $this->db->where('id',$id)
                        ->update('user_data',$data);
    }

}