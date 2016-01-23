<?php
defined('BASEPATH') or exit('Error!');

/**
 *
*/
class Payrecord extends CI_Controller
{

    public function __construct()
    {
        # code...
        parent::__construct();
        $this->load->model('Payrecord_model');
          $this->load->library('phpexcel');
        $this->load->library('PHPExcel/iofactory');
    }
/*
 * begin=0&count=2&uid=test1&projectId=123
 * playRecode/getPersonalDetail
 * {"success":true,"errorCode":0,"error":0,"data":[{"FID":"123","FSUBSCRIBECONFIGRMRECORDID":"123","FPAYTIMES":"1","FPAYDATE":"2014-09-01","FPAYAMOUNT":"3","FLEVERAMOUNT":"2014-09-01 09:53:00","FPROJECTNAME":"test","FPROJECTID":"123","FUSERID":"test1"}],"totalPayAmount":3}
 * */
    public function  getPersonPayDetail()
    {
        $begin = $this->input->post('begin');
        $count = $this->input->post('count');
        $userID = $this->input->post('uid');
        $projectId = $this->input->post('projectId');;
        $result = $this->Payrecord_model->getPersonPayDetail($begin,$count,$userID,$projectId);
        echo json_encode($result);
        
    }
    
    public function getPersonSubscribeDetail() {
        $begin = $this->input->post('begin');
        $count = $this->input->post('count');
        $userID = $this->input->post('uid');
        $projectId = $this->input->post('projectId');
        $result = $this->User_model->getPersonSubscribeDetail($begin,$count,$userID,$projectId);
        echo 3;
    }
    /*
     * 
     * 参数：{"data":[{ "subscribeConfigrmRecordId":"123",
			    	"payTimes":"12",
			    	"payAmount":"12",
			    	"payDate":"2014-09-01 09:50:00"}]}
     * 接口：payrecord/addpayList
     * 输出：{"success":true,"errorCode":0,"error":0,"data":true}
     * */
    public function  addpayList() {
        $data = $this->input->input_stream();
       
        $result = $this->Payrecord_model->addpayList($data['data']);
       
        echo json_encode($result);
    }


    public function outputXls()
    {
       $projectId = $this->input->post('projectId');
       $result = $this->Payrecord_model->getAllPayRecod($projectId);
       $query = $this->db->query("select * from T_USER");
       if(!$query)
            return false;

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle("title")->setDescription("description");
        $objPHPExcel->setActiveSheetIndex(0);
        // Field names in the first row
        $fields = $this->Payrecord_model->getAllPayRecodFilds($projectId);;
        $col = 0;
       
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, '用户');
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, '跟投人');
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, '部门');
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, '总部/区域');
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, '平衡金额');
            $col++;
             $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, '缴款批次');
            $col++;
             $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, '缴款日期');
            $col++;
             $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, '缴款金额');
            $col++;
        

        $row = 2;
       // echo json_encode($result);
        foreach($result as $data)
        {
            $col = 0;  
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data['FUSERID']);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data['FNAME']);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data['FORG']);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data['FSTATE']);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data['FCONFIRMAMOUNT']);
            $col++;
           
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, 1);
            $col++;
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, date('y-m-d h:i:s',time()));
            $col++;
            $row++;
        }
        $fileName ='test.xls';
        $baseURL = site_url();
        $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save("fileFolder/".$fileName);
        echo $fileName;
    }


}