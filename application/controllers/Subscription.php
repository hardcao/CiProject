<?php
defined('BASEPATH') or exit('Error!');

/**
 *
*/
class subscription extends CI_Controller
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
        $this->load->view('Subscription_model');
         
    }

    public function  getStatisticDetail()
    {
        $result = $this->Subscription_model->getStatisticDetail();
        echo  json_encode($result);
    }
    public function  getProjectDetail()
    {

        $projectId = $this->input->post('projectId');
        $fields = $this->input->post('fields');
        $result = $this->project_model->getProjectDetailInfo($projectId,$fields);
        echo  json_encode($result);
    }
     

}