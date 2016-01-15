<?php
/**
 *
 */
class BackInfo_model extends CI_Model
{
    public function __construct()
    {
        # code...
        parent::__construct();
        $this->load->database();
    }
    
    public function getPersonBankInfo($userID) {
        $this->db->select("*");
        $this->db->where('FUSERID',$userID);
        $result = $this->db->get('T_BANKINFO')->result_array();
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] = $result;
        return $data;
    }
}