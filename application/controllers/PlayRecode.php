<?php
defined('BASEPATH') or exit('Error!');

/**
 *
*/
class PlayRecode extends CI_Controller
{

    public function __construct()
    {
        # code...
        parent::__construct();
        $this->load->model('PlayRecode_model');
    }

    public function  getPersonalDetail()
    {
        $begin = $this->input->post('begin');
        $count = $this->input->post('count');
        $userID = $this->input->post('uid');
        $projectId = $this->input->post('projectId');
        $userID = $this->input->post('uid');
        $result = $this->User_model->getPersonalDetail($userID);
        echo json_encode($result);
        
    }
}