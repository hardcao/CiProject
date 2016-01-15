<?php
defined('BASEPATH') or exit('Error');

/**
 *�ֺ��¼��
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
    
    public function  getBonusAmountTotal() {
        $query=$this->db->select("*");
        $query = $this->db->get('T_BONUSRECORD');
        $result = $query->result_array();
        $subcribeAmountTotal = 0;
        foreach ( $result as $item) {
            $subcribeAmountTotal += intval($item['FBONUSAMOUNT']);
        }
        return $subcribeAmountTotal;
    }
}