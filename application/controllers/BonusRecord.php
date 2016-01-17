<?php
defined('BASEPATH') or exit('Error!');

/**
 *
*/
class BonusRecord extends CI_Controller
{

    public function __construct()
    {
        # code...
        parent::__construct();
        $this->load->model('BonusRecord_model');
    }
    
    /*
     * var:{"data":[{ "subscribeConfigrmRecordId":1,
			    	"bonusTimes":"12",
			    	"bonusAmount":"12",
			    	"bonusyDate":"2014-09-01 09:50:00"}]}
     * URL:BonusRecord/addBonusList
     * ouput:{"success":true,"errorCode":0,"error":0,"data":true}
     * */
    
    public function  addBonusList() {
        $data = $this->input->input_stream();
         
        $result = $this->BonusRecord_model->addBonusList($data['data']);
    	echo json_encode($result);
    }
}