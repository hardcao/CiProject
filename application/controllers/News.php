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
        $projectId = $this->input->post('projectId');
        $result = $this->news_model->getDynamicNews($projectId);
        echo json_encode($result);
        
    }
    /*
     * 
     * 输入：newsId=123
     *  接口：news/getDynamicNewsDetail
     * 输出：{"success":true,"errorCode":0,"error":0,"data":[{"FID":"123","FPROJECTID":"123","FTITLE":"\u5408","FCREATORID":"123","FRELEASEDATE":"2014-09-01 09:53:00","FCONTENT":"\u5408\u80a5\u9ad8"}]}
     * */
    public function  getDynamicNewsDetail() {
        
        $newsId = $this->input->post('newsId');
        $result = $this->news_model->getDynamicNewsDetail($newsId);
        echo json_encode($result);
    }
     
    
    public function  getPicListWithProjectID() {
    
        $projectID = $this->input->post('FPROJECTID');
        $result = $this->news_model->getNewsListWithProjectID($projectID);
        echo json_encode($result);
    }
    
    
    /*
     *
     *
     * input:data:{
            FID:125
        }
     *
     * API:news/deleteNews
     *
     * */

    public function deleteNews() {
        $data = $this->input->input_stream();
        $tableName = 'T_NEWS';
        $this->load->model('Tools');
        $result = $this->Tools->deleteData($data,$tableName);
        echo json_encode($result);
    }
    
    /*
     *
     *
     * input:data:{
            FID:125
            FCREATORID: 1,
            FPROJECTID: 1,
            FCONTENT: 'tes1111t'
     },
     *
     * API:news/updateNews
     *
     * */
    
    public function updateNews() {
        $data = $this->input->input_stream();
        $where = 'FID='.$data['FID'];
        $tableName = 'T_NEWS';
        $this->load->model('Tools');
        $result = $this->Tools->updateData($data,$tableName,$where);
        echo json_encode($result);
    }
    
    /*
     * 
     * 
     * input:data:{
					FCREATORID: 1,
					FPROJECTID: 1,
					FCONTENT: 'tes1111t'		
				},
     * 
     * API:news/addNews
     * 
     * */
    
    public function addNews() {
        $data = $this->input->input_stream();
        $tableName = 'T_NEWS';
        $this->load->model('Tools');
        $result = $this->Tools->addData($data,$tableName);
        echo json_encode($result);
    }
}