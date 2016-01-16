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
    
    public function  addBonusList() {
    	$data = $this->input->post['data'];
    	$insertDataArr = array();
    	$result = $this->BonusRecord_model->addpayList($data);
    	echo json_encode($result);
    }
}