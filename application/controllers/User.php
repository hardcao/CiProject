<?php
defined('BASEPATH') or exit('Error!');

/**
 *
*/
class User extends CI_Controller
{

    public function __construct()
    {
        # code...
        parent::__construct();
        $this->load->model('User_model');
    }
/*
 * ���룺uid=test1
 * �ӿڣ�user/getPersonalDetail
 * �����{"success":true,"errorCode":0,"error":0,"data":{"0":{"FID":"test1","FNUMBER":"\u9676\u6587\u6d01b","FNAME":"test1","FORG":"20140901053445.0Z"},"subscribeAmountTotal":0,"bonusAmountTotal":3,"payAmountTotal":3,"leverageAmountTotal":3,"subscribeProCount":1}}
 * */
    public function  getPersonalDetail()
    {
        
        $userID = $this->input->post('uid');
        $result = $this->User_model->getPersonalDetail($userID);
        echo json_encode($result);
        
    }
    public function getPersonSubscribeDetail() {
        $begin = $this->input->post('begin');
        $count = $this->input->post('count');
        $userID = $this->input->post('uid');
        $projectId = $this->input->post('projectId');
        $result = $this->User_model->getPersonSubscribeDetail($begin,$count,$userID,$projectId);
        echo json_encode($result);
    }
}