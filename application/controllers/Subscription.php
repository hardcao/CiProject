<?php
defined('BASEPATH') or exit('Error!');

/**
 *
*/
class Subscription extends CI_Controller
{

    public function __construct()
    {
        # code...
        parent::__construct();
        $this->load->model('Subscription_model');
    }

    public function index()
    {
        # code...
        $this->load->view('Subscription_model');
         
    }
/*
 * 
 * 
 * �ӿڣ�subscription/getStatisticDetail
 *����� {"success":true,"errorCode":0,"error":0,"data":{"projectCount":1,"peopleCount":1,"subcribeAmountTotal":5,"bonusAmountTotal":3}}
 * */
    public function  getStatisticDetail()
    {
        $result = $this->Subscription_model->getStatisticDetail();
        echo  json_encode($result);
    }
    public function  getProjectDetail()
    {

        $projectId = $this->input->post('projectId');
        $fields = $this->input->post('fields');
        $result = $this->project_model->getProjectDetailInfo($projectId,$fields);
        echo  json_encode($result);
    }
    
    public function  applySubscribe()
    {
        $userID = $this->input->post('uid');
        $projectId = $this->input->post('projectId');
        $subscribeAmount = $this->input->post('subscribeAmount');
        $subscribeRatio = $this->input->post('subscribeRatio');
        $backId = $this->input->post('backId');
        $result = $this->Subscription_model->applySubscribe($userID, $projectID, $subscribeAmount, $subscribeRatio, $bankId);
        echo  json_encode($result);
    }
     

}