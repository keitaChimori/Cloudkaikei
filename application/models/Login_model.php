<?php

class Login_model extends CI_model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // ログイン処理(パスワードの一致)
    public function fetch_pass($email)
    {
      return $this->db->where('mail',$email)
                      ->select('password')
                      ->get('user_data')
                      ->row_array();
    }

    // ユーザー新規登録
    public function insert($data)
    {
        return $this->db->insert('user_data',$data);
    }
}