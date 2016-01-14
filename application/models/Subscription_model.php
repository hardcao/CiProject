<?php
defined('BASEPATH') or exit('Error');

/**
 *
*/
class Subscription_model extends CI_Model
{
    public function __construct()
    {
        # code...
        parent::__construct();
        $this->load->database();
    }
    public function getSubscriptionDataWithProjectID($projectID) {
        $this->db->select("*");
        $this->db->where('FPROJECTID',$projectID);
        $result = $this->db->get('T_SUBSCRIBECONFIRMRECORD')->result_array();
        return $result;
    }
    public function getSubscriptionDataWithUserID($userID) {
        $this->db->select("*");
        $this->db->where('FUSERID',$UserID);
        $result = $this->db->get('T_SUBSCRIBECONFIRMRECORD')->result_array();
        return $result;
    }
    
    public function getSubscriptionDataWithBankID($BankID) {
        $this->db->select("*");
        $this->db->where('FBANKID',$BankID);
        $result = $this->db->get('T_SUBSCRIBECONFIRMRECORD')->result_array();
        return $result;
    }
}