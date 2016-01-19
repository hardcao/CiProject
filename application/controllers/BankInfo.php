﻿<?php
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
     * 接口：bankInfo/getPersonBankInfo
     * 输出：{"test":"test1"}
     * */
    public function  getPersonBankInfo() {
    
        $userID = $this->input->post('uid');
        $result['test'] = $userID;// = $this->BackInfo_model->getPersonBankInfo($userID);
        echo json_encode($result);
    }
    /*
     * 参数：uid=123&bankNo=123456&bankName=sadfasf&bankAttribute=sadfsa
     * 接口：BankInfo/addBankCardRecord
     * 输出：{"success":true,"errorCode":0,"error":0,"data":"0"}
     * */
    public function  addBankCardRecord()
    {
         
        $userID = $this->input->post('uid');
        $bankNo = $this->input->post('bankNo');
        $bankName = $this->input->post('bankName');
        $bankAttribute = $this->input->post('bankAttribute');
    
        $result = $this->BankInfo_model->addProject($userID,$bankNo,$bankName,$bankAttribute);
        echo  json_encode($result);
    }
    /*
     * 参数：uid=123&bankNo=123456
     * 接口：BankInfo/deleteBankCardRecord
     * 输出：{"success":true,"errorCode":0,"error":0,"data":true}
     * */
    public function  deleteBankCardRecord()
    {
         
        $userID = $this->input->post('uid');
        $bankNo = $this->input->post('bankNo');
    
        $result = $this->BankInfo_model->deleteBankCardRecord($userID,$bankNo);
        echo  json_encode($result);
    }
    
    public function updateBonusList() {
    
        $data = $this->input->input_stream();
        $tableName = 'T_BONUSRECORD';
        $this->load->model('Tools');
        $result = $this->Tools->updateData($data['data'][0],$tableName);
        echo json_encode($result);
    }
 }
    