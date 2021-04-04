<?php
class Cloudkaikei extends CI_controller
{
    // デフォルトの設定
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('file');
        $this->load->model('Cloudkaikei_model');
        $this->load->library('javascript');
        // $this->load->library('jquery');
    }

    // public function login()
    // {
    //     $this->load->view('login_view.php');
    // }

    public function ledger()
    {
        $data['info'] = $this->Cloudkaikei_model->load_invoice();
        $this->load->view('ledger_view.php',$data);
    }

    public function mypage()
    {   
        // 変更の処理
        if(!empty($_POST['user_id']) && !empty($_POST['Name']) && !empty($_POST['KanaName']) && !empty($_POST['Mail']) && !empty($_POST['Post']) && !empty($_POST['Pref']) && !empty($_POST['Address1']) && !empty($_POST['Address2']) && !empty($_POST['Phone']) && !empty($_POST['Fax']) && !empty($_POST['Bank']) && !empty($_POST['BankAccount'])){
            $data['id'] = $this->input->post('user_id',TRUE);
            $data['name'] = $this->input->post('Name',TRUE);
            $data['kana'] = $this->input->post('KanaName',TRUE);
            $data['mail'] = $this->input->post('Mail',TRUE);
            $data['post'] = $this->input->post('Post',TRUE);
            $data['prefecture'] = $this->input->post('Pref',TRUE);
            $data['adress1'] = $this->input->post('Address1',TRUE);
            $data['address2'] = $this->input->post('Address2',TRUE);
            $data['tel'] = $this->input->post('Phone',TRUE);
            $data['fax'] = $this->input->post('Fax',TRUE);
            $data['bank_name'] = $this->input->post('Bank',TRUE);
            $data['bank_account'] = $this->input->post('BankAccount',TRUE);
            $id = $data['user_id'];
            if($this->Cloudkaikei_model->edit_update($id,$data)){
                redirect(base_url('Cloudkaikei/ledger'));
            }
        }
        $data['info'] = $this->Cloudkaikei_model->load();
        $this->load->view('mypage_view.php',$data);
    }

    public function edit()
    {
        // 変更の処理
        if(!empty($_POST['user_id']) && !empty($_POST['Name']) && !empty($_POST['KanaName']) && !empty($_POST['Mail']) && !empty($_POST['Post']) && !empty($_POST['Pref']) && !empty($_POST['Address1']) && !empty($_POST['Address2']) && !empty($_POST['Phone']) && !empty($_POST['Fax']) && !empty($_POST['Bank']) && !empty($_POST['BankAccount'])){
            $data['id'] = $this->input->post('user_id',TRUE);
            $data['name'] = $this->input->post('Name',TRUE);
            $data['kana'] = $this->input->post('KanaName',TRUE);
            $data['mail'] = $this->input->post('Mail',TRUE);
            $data['post'] = $this->input->post('Post',TRUE);
            $data['prefecture'] = $this->input->post('Pref',TRUE);
            $data['adress1'] = $this->input->post('Address1',TRUE);
            $data['address2'] = $this->input->post('Address2',TRUE);
            $data['tel'] = $this->input->post('Phone',TRUE);
            $data['fax'] = $this->input->post('Fax',TRUE);
            $data['bank_name'] = $this->input->post('Bank',TRUE);
            $data['bank_account'] = $this->input->post('BankAccount',TRUE);
            $id = $data['id'];
            if($this->Cloudkaikei_model->edit_update($id,$data)){
                redirect(base_url('Cloudkaikei/admin'));
            }
        }
        $data['info'] = $this->Cloudkaikei_model->load();
        $this->load->view('editpage_view.php',$data);
    }

    public function delete(){
        $data['delete_flag'] = 1;
        $id = $this->input->post('user_id',TRUE);;
        if($this->Cloudkaikei_model->delete($id,$data)){
            redirect(base_url('Cloudkaikei/admin'));
        }
    }
}