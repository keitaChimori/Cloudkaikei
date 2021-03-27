<?php

class Admin_model extends CI_model
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

}