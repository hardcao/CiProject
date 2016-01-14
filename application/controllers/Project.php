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

}
