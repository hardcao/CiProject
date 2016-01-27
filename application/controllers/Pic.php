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
     * ���룺newsId=123
     *  �ӿڣ�news/getDynamicNewsDetail
     * �����{"success":true,"errorCode":0,"error":0,"data":[{"FID":"123","FPROJECTID":"123","FTITLE":"\u5408","FCREATORID":"123","FRELEASEDATE":"2014-09-01 09:53:00","FCONTENT":"\u5408\u80a5\u9ad8"}]}
     * */
    public function  getPicListWithProjectID() {
        
        $projectID = $this->input->post('FPROJECTID');
        $result = $this->Pic_model->getPicListWithProjectID($projectID);
        echo json_encode($result);
    }
    // �����ĿͼƬ
     // Pic/addImage
    public function addImage()
    {
         $projectID = $this->input->post('projectId');

         $config['upload_path']      = './images/';
         $config['allowed_types']    = 'gif|jpg';
         $config['max_size']     = 100;
         $config['max_width']        = 1024;
         $config['max_height']       = 768;
         $name = $_FILES["file"]["name"];
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
             $filePath = $data['upload_data']['file_name'];
             $insertdata['FPROJECTID'] = $projectID;
             $insertdata['FCONTENT'] = iconv("gb2312","UTF-8", $filePath);
             $insertdata['FISMAINPIC'] = false;
             $insertdata['FNAME'] = iconv("gb2312","UTF-8", $filePath);
             $tableName = 'T_PIC';
             $this->load->model('Tools');
             $result = $this->Tools->addData($insertdata,$tableName);
             $result['data'] = $filePath;
             echo json_encode($result);
         }
    }
     
     // ������ĿͼƬ
     // Pic/updateImage
     public function updateImage()
     {
         $projectID = $this->input->post('projectId');

         $config['upload_path']      = './images/';
         $config['allowed_types']    = 'gif|jpg';
         $config['max_size']     = 100;
         $config['max_width']        = 1024;
         $config['max_height']       = 768;
         $name = $_FILES["file"]["name"];
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
             $filePath =  $data['upload_data']['file_name'];
             $insertdata['FCONTENT'] = iconv("gb2312","UTF-8", $filePath);
             $tableName = 'T_PIC';
             $where='FPROJECTID='.$projectID.' AND FISMAINPIC = true';
             $this->load->model('Tools');
             $result = $this->Tools->updateData($insertdata,$tableName,$where);
             $result['data'] = $filePath;
             echo json_encode($result);
         }
     }

     public function deleteImage()
     {
        $data = $this->input->input_stream();
        $tableName = 'T_PIC';
        $this->load->model('Tools');
        $result = $this->Tools->deleteData($data,$tableName);
        echo json_encode($result);
     }
    //�����ͼ
    //Pic/getMainImage
     public function getMainImage()
     {
        $projectId = $this->input->post('projectId');
        $result = $this->Pic_model->getMainImage($projectId);
        echo json_encode($result);

     }

     //�������ͼƬ
     //Pic/getAllProjectImage
     public function getAllProjectImage()
     {
         $projectId = $this->input->post('projectId');
        $result = $this->Pic_model->getAllProjectImage($projectId);
        echo json_encode($result);
     }
//ɾ��ͼƬ
     //Pic/deletePic
     public function deletePic() {
        $data = $this->input->input_stream();
        $tableName = 'T_PIC';
        $this->load->model('Tools');
        $result = $this->Tools->deleteData($data,$tableName);
        echo json_encode($result);
    }
}