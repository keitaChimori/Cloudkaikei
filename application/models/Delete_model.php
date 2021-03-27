<?php

class Delete_model extends CI_model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function delete($id,$data)
    {
        return $this->db->where('id', $id)
        ->update('user_data', $data);
    }
}