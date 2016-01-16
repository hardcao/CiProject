<?php


defined('BASEPATH') or exit('Error!');

/**
 *
*/
class Project extends CI_Controller
{

    public function __construct()
    {
        # code...
        parent::__construct();
        $this->load->model('project_model');
    }

    public function index()
    {
        # code...
        $this->load->view('loginview');
         
    }
    /*
     * 输入数据：
     * begin=0&count=2&uid=test1&subscribeStartDate='2014-09-01 09:50:00'&subscribeEndDate='2014-09-01 09:50:00'&status=1
     * 访问接口：project/getProjectList
     * 
     * 输出数据：{"success":true,"errorCode":0,"error":0,"data":[{"projectName":"123","projectId":"123","HDAmount":3,"regioAmount":3,"HDAmountComplete":"test","regioAmountComplete":"test","picList":[]}]
     * 
     * */

    
     public function  getProjectList()
     {
         
         $begin = $this->input->post('begin');
         $count = $this->input->post('count');
         $userID = $this->input->post('uid');
         $subscribeStartDate = $this->input->post('subscribeStartDate');
         $subscribeEndDate = $this->input->post('subscribeEndDate');
         $status = $this->input->post('status');
         
         $result = $this->project_model->getProjectList($begin,$count,$userID,$subscribeStartDate, $subscribeEndDate, $status);
         echo  json_encode($result);
     }
     
     /*
      * 输入：projectId=123
      * 接口：project/getProjectDetail
      * 输出：[{"FID":"123","FNAME":"123","FNUMBER":"123","FSTATE":"\u534f\u8bae","FSTATUS":"1","FCREATETIME":"2014-10-01 05:00:00"}]
      * */
     public function  getProjectDetail()
     {
          
         $projectId = $this->input->post('projectId');
         $fields = $this->input->post('fields');
         $result = $this->project_model->getProjectDetailInfo($projectId,$fields);
         echo  json_encode($result);
     }
     /*
      * 参数：uid=test5&projectNumber=34534&projectName=sdfsaxvs&state=1
      * 接口：Project/addProject
      * 输出：{"success":true,"errorCode":0,"error":0,"data":"0"}
      * */
     public function  addProject()
     {
         
         $userID = $this->input->post('uid');
         $projectNumber = $this->input->post('projectNumber');
         $projectName = $this->input->post('projectName');
         $state = $this->input->post('state');
          
         $result = $this->project_model->addProject($userID,$projectNumber,$projectName,$state);
         echo  json_encode($result);
     }
     

}
