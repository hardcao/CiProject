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