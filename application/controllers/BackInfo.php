<?php
class BankInfo extends CI_Controller
{

    public function __construct()
    {
        # code...
        parent::__construct();
        $this->load->model('BackInfo_model');
    }
    
    public function  getPersonBankInfo() {
    
        $userID = $this->input->post('uid');
        $result = $this->BackInfo_model->getPersonBankInfo($userID);
        echo json_encode($result);
    }
 }
    