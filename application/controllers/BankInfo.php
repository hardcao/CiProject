<?php
class BankInfo extends CI_Controller
{

    public function __construct()
    {
        # code...
        parent::__construct();
        $this->load->model('BankInfo_model');
    }
    /*
     * 
     * 参数：uid=test1
     *接口：bankInfo/getPersonBankInfo
     * 输出：{"test":"test1"}
     * */
    public function  getPersonBankInfo() {
    
        $userID = $this->input->post('uid');
        $result['test'] = $userID;// = $this->BackInfo_model->getPersonBankInfo($userID);
        echo json_encode($result);
    }
    
    public function  addBankCardRecord()
    {
         
        $userID = $this->input->post('uid');
        $bankNo = $this->input->post('bankNo');
        $bankName = $this->input->post('bankName');
        $bankAttribute = $this->input->post('bankAttribute');
    
        $result = $this->BackInfo_model->addProject($userID,$bankNo,$bankName,$bankAttribute);
        echo  json_encode($result);
    }
    
    public function  deleteBankCardRecord()
    {
         
        $userID = $this->input->post('uid');
        $bankNo = $this->input->post('bankNo');
    
        $result = $this->BackInfo_model->delBankCardRecord($userID,$bankNo);
        echo  json_encode($result);
    }
 }
    