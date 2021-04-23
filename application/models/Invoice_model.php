<?php

class invoice_model extends CI_model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function load_user(){
        return $this->db->order_by('id', 'ASC')
                        ->get('user_data')
                        ->result_array();
    }

    public function invoice_id()
    {
        return $this->db->where("delete_flag", 0)
                        // ->select("id")
                        ->get('invoice')
                        ->result_array();
    }

    public function detail_preview($id){
        if (!empty($id)) {
            $this->db->where("invoice_id", $id);
        }else {
            $this->db->where("deleted_at", 0);
        }
        // return $this->db->get('invoice_detail')->row_array();
        return $this->db->get('invoice_detail')->result_array();
    }

    public function invoice_preview($id)
    {
        if (!empty($id)) {
            $this->db->where("id", $id);
        }else {
            $this->db->where("delete_flag", 0);
        }
        return $this->db->get('invoice')->row_array();
    }


    public function delete_invoice($id,$flag,$time){
        $this->db->where('id', $id)
                        ->update('invoice',$flag);

        return $this->db->where('invoice_id', $id)
                        ->update('invoice_detail',$time);
    }

    public function load_customer()
    {
        return $this->db->order_by('id', 'ASC')
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

    public function edit_invoice($id,$data,$detail){
        $this->db->where('id', $id)
                    ->update('invoice',$data);

        return $this->db->where('invoice_id', $id)
                       ->update('invoice_detail',$detail);
    }

}