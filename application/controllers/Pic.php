<?php
defined('BASEPATH') or exit('Error!');

/**
 *
*/
class Pic extends CI_Controller
{

    public function __construct()
    {
        # code...
        parent::__construct();
        $this->load->model('Pic_model');
    }

    /*
     * 
     * ���룺newsId=123
     *  �ӿڣ�news/getDynamicNewsDetail
     * �����{"success":true,"errorCode":0,"error":0,"data":[{"FID":"123","FPROJECTID":"123","FTITLE":"\u5408","FCREATORID":"123","FRELEASEDATE":"2014-09-01 09:53:00","FCONTENT":"\u5408\u80a5\u9ad8"}]}
     * */
    public function  getPicListWithProjectID() {
        
        $projectID = $this->input->post('FPROJECTID');
        $result = $this->Pic_model->getPicListWithProjectID($projectID);
        echo json_encode($result);
    }
     

}