<?php
defined('BASEPATH') or exit('Error!');

/**
 *
*/
class Payrecord extends CI_Controller
{

    public function __construct()
    {
        # code...
        parent::__construct();
        $this->load->model('Payrecord_model');
    }
/*
 * begin=0&count=2&uid=test1&projectId=123
 * playRecode/getPersonalDetail
 * {"success":true,"errorCode":0,"error":0,"data":[{"FID":"123","FSUBSCRIBECONFIGRMRECORDID":"123","FPAYTIMES":"1","FPAYDATE":"2014-09-01","FPAYAMOUNT":"3","FLEVERAMOUNT":"2014-09-01 09:53:00","FPROJECTNAME":"test","FPROJECTID":"123","FUSERID":"test1"}],"totalPayAmount":3}
 * */
    public function  getPersonPayDetail()
    {
        $begin = $this->input->post('begin');
        $count = $this->input->post('count');
        $userID = $this->input->post('uid');
        $projectId = $this->input->post('projectId');;
        $result = $this->Payrecord_model->getPersonPayDetail($begin,$count,$userID,$projectId);
        echo json_encode($result);
        
    }
    
    public function getPersonSubscribeDetail() {
        $begin = $this->input->post('begin');
        $count = $this->input->post('count');
        $userID = $this->input->post('uid');
        $projectId = $this->input->post('projectId');
        $result = $this->User_model->getPersonSubscribeDetail($begin,$count,$userID,$projectId);
        echo 3;
    }
    /*
     * 
     * 参数：{"data":[{ "subscribeConfigrmRecordId":"123",
			    	"payTimes":"12",
			    	"payAmount":"12",
			    	"payDate":"2014-09-01 09:50:00"}]}
     * 接口：payrecord/addpayList
     * 输出：{"success":true,"errorCode":0,"error":0,"data":true}
     * */
    public function  addpayList() {
        $data = $this->input->input_stream();
       
        $result = $this->Payrecord_model->addpayList($data['data']);
       
        echo json_encode($result);
    }
}