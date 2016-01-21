<?php
defined('BASEPATH') or exit('Error!');

/**
 *
*/
class Follower extends CI_Controller
{

    public function __construct()
    {
        # code...
        parent::__construct();
        $this->load->model('Follower_model');
    }

    /*
     * 
     * ���룺newsId=123
     *  �ӿڣ�news/getDynamicNewsDetail
     * �����{"success":true,"errorCode":0,"error":0,"data":[{"FID":"123","FPROJECTID":"123","FTITLE":"\u5408","FCREATORID":"123","FRELEASEDATE":"2014-09-01 09:53:00","FCONTENT":"\u5408\u80a5\u9ad8"}]}
     * */
    public function  getFollowerListWithProjectID() {
        
        $projectID = $this->input->post('FPROJECTID');
        $result = $this->Follower_model->getFollowerListWithProjectID($projectID);
        echo json_encode($result);
    }
     
    public function updateFollower() {
    
        $data = $this->input->input_stream();
        /*$tableName = 'T_FOLLOWER';
        $this->load->model('Tools');
        foreach ($data as $item) {
            $result = $this->Tools->updateData($item,$tableName);
        }*/
        echo json_encode($data);
    }
    
    public function deleteFollower() {
        $data = $this->input->input_stream();
        $tableName = 'T_FOLLOWER';
        $this->load->model('Tools');
        $result = $this->Tools->deleteData($data,$tableName);
        echo json_encode($result);
    }
    
    public function  addFollower()
    {
        $data = $this->input->input_stream();
        $tableName = 'T_FOLLOWER';
        $this->load->model('Tools');
        $result = $this->Tools->addData($data,$tableName);
        echo json_encode($result);
    }

}