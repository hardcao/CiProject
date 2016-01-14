<?php
defined('BASEPATH') or exit('Error!');

/**
 *
*/
class News extends CI_Controller
{

    public function __construct()
    {
        # code...
        parent::__construct();
        $this->load->model('news_model');
    }

    public function  getDynamicNews()
    {
        $begin = $this->input->post('begin');
        $count = $this->input->post('count');
        $userID = $this->input->post('uid');
        $projectId = $this->input->post('projectId');
        $result = $this->news_model->getDynamicNews($begin,$count,$userID,$projectId);
        echo result;
        
    }
     

}