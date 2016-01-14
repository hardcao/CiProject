<?php
defined('BASEPATH') or exit('Error');

/**
 *½É¿î¼ÇÂ¼±í
*/
class PayRecord_model extends CI_Model
{
    public function __construct()
    {
        # code...
        parent::__construct();
        $this->load->database();
    }
    public function getSubscriptionDataWithRecodeID($RecodeID) {
        $this->db->select("*");
        $this->db->where('FSUBSCRIBECONFIGRMRECORDID',$RecodeID);
        $result = $this->db->get('T_PAYRECORD')->result_array();
        return $result;
    }
}