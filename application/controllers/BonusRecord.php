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
        $data = $this->input->input_stream();
         
        $result = $this->BonusRecord_model->addBonusList($data['data']);
    	echo json_encode($result);
    }
}