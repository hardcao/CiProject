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
    
    public function  getProjectBack()
    {
        $result = $this->project_model->getProjectBack();
        echo  json_encode($result);
    }
    
    /*
     * 
     * begin=0&count=2&uid=test1&subscribeStartDate='2014-09-01 09:50:00'&subscribeEndDate='2014-09-01 09:50:00'&status=1
     * project/getProjectList
     * 
     * {"success":true,"errorCode":0,"error":0,"data":[{"projectName":"123","projectId":"123","HDAmount":3,"regioAmount":3,"HDAmountComplete":"test","regioAmountComplete":"test","picList":[]}]
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
      * projectId=1
      * project/getProjectDetail
      * {"FID":"1","FPROJECTID":"1","FAREA":"12","FSTRUCTAREA":"113","FRJL":"12","FSALEAREA":"12","FGETDATE":"2014-09-02","FTOTAL":"123","FGETWAY":"test","FPOSITION":"\u5408\u80a5\u9ad8\u65b0KD4-2","FPROPOSITION":"\u653f\u52a1\u533a","FSCHEME":"\u653f\u52a1\u533a","FPRICE":"23","FCYWYSP":"34","FIRR":"21","FPREPROFIT":"12342","FPROFIT":"112","FSTARTDATE":"2014-09-02","FOPENDATE":"2014-09-02","FCASHFLOWBACK":"asdfa","FHANDDATE":"2014-09-04","FCARRYOVERDATE":"2014-09-02","FLIQUIDATE":"2014-09-02","FPROPERTYSCHEME":"safsaf","FPARTNERINFO":"asdfsadf","FCONTRIBUTIVE":"23","FANSWERMAIL":"23","FFOLLOWERMANAGERS":"sadf","FPROJECTINFOMANAGERS":"sadf","PictureList":[{"FID":"1","FPROJECTID":"1","FNAME":"\u5408\u80a5\u9ad8\u65b0","FCONTENT":"123","FISMAINPIC":"1"}],"NEWSList":[{"FID":"124","FPROJECTID":"1","FTITLE":"\u5408\u80a5\u9ad8\u65b0","FCREATORID":"123","FRELEASEDATE":"2016-01-17 08:58:47","FCONTENT":"\u5408\u80a5\u9ad8\u65b0\u9879\u76ee\u5bf9\u8d26\u516c\u793a-1 - \u5185\u5bb9"}],"FollowerList":[{"FID":"124","FPROJECTID":"1","FUSERID":"1","FSEQ":"zdf","FSTATE":"sadfs","FTYPE":"saf","FDUTY":"gaoguan","FTOPLIMIT":"2","FDOWNLIMT":"3","FREMARK":"asff"}],"FollowSchemeList":[{"FID":"1","FPROJECTID":"1","FCREATORID":"1","FNAME":"\u534f\u8bae","FDETAIL":"sadfs","FCREATETIME":"2016-01-17 08:53:51"}]}
      * */
     public function  getProjectDetail()
     {
          
         $projectId = $this->input->post('projectId');
         $fields = $this->input->post('fields');
         $result = $this->project_model->getProjectDetailInfo($projectId,$fields);
         echo  json_encode($result);
     }
     /*
      * {'FNAME':'FNAME','FSTATE':'FSTATE'}
      * Project/addProject
      * {"success":true,"errorCode":0,"error":0,"data":"0"}
      * */
     public function  addProject()
     {
         
         $data = $this->input->input_stream();
         $tableName = 'T_PROJECT';
          
         $this->load->model('Tools');
         $result = $this->Tools->addData($data,$tableName);
         echo json_encode($result);
     }
     
     public function  addEnclosure() {
         $upFilePath = "../attachment/";
         $ok=@move_uploaded_file($_FILES['img']['tmp_name'],$upFilePath);
         $result['file_infor'] = ''; 
         if($ok === FALSE){
             $result['file_infor']='上传失败';
         }else{
             $result['file_infor']='上传成功';
         }
         echo json_encode($result);
     }
}
