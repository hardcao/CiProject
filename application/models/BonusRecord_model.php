<?php
defined('BASEPATH') or exit('Error');

/**
 *·Öºì¼ÇÂ¼±í
*/
class BonusRecord_model extends CI_Model
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
        $result = $this->db->get('T_BONUSRECORD')->result_array();
        return $result;
    }
}