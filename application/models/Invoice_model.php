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
        return $this->db->where("deleted_at", 0)
                        ->select("id")
                        ->get('invoice_detail')
                        ->result_array();
    }

    public function load_invoice($id){
        if (!empty($id)) {
            $this->db->where("id", $id);
        }else {
            $this->db->where("deleted_at", 0);
        }
        return $this->db->get('invoice_detail')->row_array();
    }

    public function delete_invoice($id,$data){
        return $this->db->where('id', $id)
                        ->update('invoice_detail',$data);
    }

    public function load_customer(){
        
        return $this->db->order_by('id', 'ASC')
                        ->get('customer')
                        ->result_array();
    }
    
    public function create($register)
    {
        return $this->db->insert('invoice_detail',$register);
    }

    public function edit_invoice($id,$data){
        return $this->db->where('id', $id)
                        ->update('invoice_detail',$data);
    }

}