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


    //编辑用户权限
   // UserProjectRight/editUserProjectRight
    public function editUserProjectRight()
    {
        $data = $this->input->input_stream();
        echo json_encode($data);
    }

   //删除一个管理员
   // UserProjectRight/deleteUserProjectRight
    public function deleteUserProjectRight() {
        $data = $this->input->input_stream();
        $tableName = 'T_USERPROJECTRIGHT';
        $this->load->model('Tools');
        $result = $this->Tools->deleteData($data,$tableName);
        return $result;
    }

    //更新一个管理员
   // UserProjectRight/updateUserProjectRight
    public function updateUserProjectRight() {
    
        
        $data = $this->input->input_stream();
        $where = 'FID='.$data['FID'];
        $tableName = 'T_USERPROJECTRIGHT';
        $this->load->model('Tools');
        $result = $this->Tools->updateData($data,$tableName,$where);
        return $result;
    }
    
    //添加一个管理员
   // UserProjectRight/addUserProjectRight
    public function addUserProjectRight() {
        $data = $this->input->input_stream();
        $tableName = 'T_USERPROJECTRIGHT';
        $this->load->model('Tools');
        $result = $this->Tools->addData($data,$tableName);
        return $result;
    }
}