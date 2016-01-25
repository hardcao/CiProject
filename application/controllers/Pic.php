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
         $this->load->helper(array('form', 'url'));
    }

    /*
     * 
     * 输入：newsId=123
     *  接口：news/getDynamicNewsDetail
     * 输出：{"success":true,"errorCode":0,"error":0,"data":[{"FID":"123","FPROJECTID":"123","FTITLE":"\u5408","FCREATORID":"123","FRELEASEDATE":"2014-09-01 09:53:00","FCONTENT":"\u5408\u80a5\u9ad8"}]}
     * */
    public function  getPicListWithProjectID() {
        
        $projectID = $this->input->post('FPROJECTID');
        $result = $this->Pic_model->getPicListWithProjectID($projectID);
        echo json_encode($result);
    }

    public function addImage()
    {
        $config['upload_path']      = './Image/';
         $config['allowed_types']    = 'gif|jpg';
         $config['max_size']     = 100;
         $config['max_width']        = 1024;
         $config['max_height']       = 768;
         $name = $_FILES["file"]["name"];
         $this->load->model('FollowScheme_model');
         
         $followScheme = $this->FollowScheme_model->getPersonBankInfo($FID);
         $is_exist = is_int(strpos($followScheme['FLINK'],$name));
         if ($is_exist){
             echo "update fail";
             return ;
         }
         $followScheme['FLINK'] = $followScheme['FLINK'].';'.$name;
         $config['file_name']  =  date('y-m-d-h-i-s',time()).iconv("UTF-8","gb2312", $name);
         $this->load->library('upload', $config);
         
         if ( ! $this->upload->do_upload('file'))
         {
             $error = array('error' => $this->upload->display_errors());
         
             $this->load->view('upload_form', $error);
         }
         else
         {
             $data = array('upload_data' => $this->upload->data());
             $filePath =  './fileFolder/'.$data['upload_data']['file_name'];
             $insertdata['FCONTENT'] = iconv("gb2312","UTF-8", $filePath);
             $insertdata['FISMAINPIC'] = false;
             $insertdata['FNAME'] = $name;
             $tableName = 'T_PIC';
             $where='FID='.$FID;
             $this->load->model('Tools');
             $result = $this->Tools->updateData($followScheme,$tableName,$where);
             
         }
    }
     
    /*

    */

     public function updateImage()
     {
        $FID = $this->input->post('uploadSchemeId');
         $config['upload_path']      = './Image/';
         $config['allowed_types']    = 'gif|jpg';
         $config['max_size']     = 100;
         $config['max_width']        = 1024;
         $config['max_height']       = 768;
         $name = $_FILES["file"]["name"];
         $this->load->model('FollowScheme_model');
         
         $followScheme = $this->FollowScheme_model->getPersonBankInfo($FID);
         $is_exist = is_int(strpos($followScheme['FLINK'],$name));
         if ($is_exist){
             echo "update fail";
             return ;
         }
         $followScheme['FLINK'] = $followScheme['FLINK'].';'.$name;
         $config['file_name']  =  date('y-m-d-h-i-s',time()).iconv("UTF-8","gb2312", $name);
         $this->load->library('upload', $config);
         
         if ( ! $this->upload->do_upload('file'))
         {
             $error = array('error' => $this->upload->display_errors());
         
             $this->load->view('upload_form', $error);
         }
         else
         {
             $data = array('upload_data' => $this->upload->data());
             $filePath =  './fileFolder/'.$data['upload_data']['file_name'];
             $insertdata['FCONTENT'] = iconv("gb2312","UTF-8", $filePath);
             $tableName = 'T_PIC';
             $where='FID='.$FID;
             $this->load->model('Tools');
             $result = $this->Tools->updateData($followScheme,$tableName,$where);
             
         }
     }

}