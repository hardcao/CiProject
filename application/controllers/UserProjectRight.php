<?php  
defined('BASEPATH') or exit('Error!');

/**
 *
*/
class UserProjectRight extends CI_Controller
{

    public function __construct()
    {
        # code...
        parent::__construct();
        $this->load->model('UserProjectRight_model');
    }

    // 获得指定项目的所有用户权限链表
    //UserProjectRight/getProjectUserRightWithProjectID
    public function getProjectUserRightWithProjectID() {
        $ProjctID =$this->input->post('projectId');
        $result = $this->UserProjectRight_model->getProjectUserRightWithProjectID($ProjctID);
        echo  json_encode($result);
    }

    //获得指定用户指定项目权限
    //UserProjectRight/getUserProjectRight
    public function getUserProjectRight() {
        $ProjctID =$this->input->post('projectId');
        $userID =$this->input->post('uid');
        $result = $this->UserProjectRight_model->getUserProjectRight($userID,$ProjctID);
        echo  json_encode($result);
    }

    //获得指定用户的所有相关的项目权限链表
    //UserProjectRight/getProjectUserRightWithUserID
    public function getProjectUserRightWithUserID() {
        $userID =$this->input->post('uid');
        $result = $this->UserProjectRight_model->getProjectUserRightWithUserID($userID);
        echo  json_encode($result);
    }

    //获得所有用户的项目权限链表
    //UserProjectRight/getAllUserRight
    public function getAllUserRight()
    {
        $ProjctID =$this->input->post('projectId');
        $userName =$this->input->post('uname');
        $result = $this->UserProjectRight_model->getAllUserRight($ProjctID,$userName);
        echo  json_encode($result);
    }
   
}