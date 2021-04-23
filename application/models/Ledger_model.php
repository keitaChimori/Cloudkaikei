<?php

class Ledger_model extends CI_model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function load_invoice(){
        return $this->db->where('delete_flag',0)
                        ->order_by('id', 'ASC')
                        ->get('invoice')
                        ->result_array();
    }

    public function load_customer(){
        return $this->db
                    ->get('customer')
                    ->result_array();
    }
}