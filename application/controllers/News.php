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
/*
 * 输入：begin=0&count=2&uid=test&projectId=123
 * 接口：news/getDynamicNews
 * 
 * 输出：{"success":true,"errorCode":0,"error":0,"data":[{"FID":"123","FPROJECTID":"123","FTITLE":"\u5408","FCREATORID":"123","FRELEASEDATE":"2014-09-01 09:53:00","FCONTENT":"\u5408\u80a5\u9ad8"}]}
 * */
    public function  getDynamicNews()
    {
        $begin = $this->input->post('begin');
        $count = $this->input->post('count');
        $userID = $this->input->post('uid');
        $projectId = $this->input->post('projectId');
        $result = $this->news_model->getDynamicNews($begin,$count,$userID,$projectId);
        echo json_encode($result);
        
    }
    
    public function  getDynamicNewsDetail() {
        
        $newsId = $this->input->post('newsId');
        $result = $this->news_model->getDynamicNewsDetail($newsId);
        echo json_encode($result);
    }
     

}