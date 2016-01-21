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
     * 输入：newsId=123
     *  接口：news/getDynamicNewsDetail
     * 输出：{"success":true,"errorCode":0,"error":0,"data":[{"FID":"123","FPROJECTID":"123","FTITLE":"\u5408","FCREATORID":"123","FRELEASEDATE":"2014-09-01 09:53:00","FCONTENT":"\u5408\u80a5\u9ad8"}]}
     * */
    public function  getFollowerListWithProjectID() {
        
        $projectID = $this->input->post('projectId');
        $result = $this->Follower_model->getFollowerListWithProjectID($projectID);
        echo json_encode($result);
    }
     
    public function updateFollower() {
    
        $data = $this->input->input_stream();
        $tableName = 'T_FOLLOWER';
        $this->load->model('Tools');
        $this->load->model('ProjectUser_model');
        $tableName= 'T_FOLLOWER';
        $projectID = $data['projectid'];
        $userID = "1";
        foreach ($data['forceFollList'] as $item) {
            $tmpData['FTOPLIMIT'] = $item['toplimit'];
            $tmpData['FTOPLIMIT'] = $item['downlimit'];
            $tmpData['FDUTY'] = $item['duty'];
            $tmpData['FSTATE'] = $item['department'];
            $tmpData['FTYPE'] = $item['remark'];
            if($item['id']) {
                $tmpData['FPROJECTID'] = $projectID;
                $tmpData['FUSERID']=$userID;
                $ProjectUser['FPROJECTID'] = $projectID;
                $ProjectUser['FUSERID'] = $userID;
                $result = $this->Tools->addData($tmpData,$tableName);
                if($result['data']) {
                    $result = $this->Tools->addData($ProjectUser,'T_PROJECT_USER');
                }
            } else {
                $where ='FID='.$item['id'];
                $result = $this->Tools->updateData($item,$tableName,$where);
            }
        }
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