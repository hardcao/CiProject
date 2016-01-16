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
    
    public function getSubscriptionDataWithRecordId($RecordId) {
        $this->db->select("*");
        $this->db->where('FID',$RecordId);
        $result = $this->db->get('T_SUBSCRIBECONFIRMRECORD')->result_array();
        return $result[0];
    }
    
    public function getSubscriptionDataWithProjectID($projectID) {
        $this->db->select("*");
        $this->db->where('FPROJECTID',$projectID);
        $result = $this->db->get('T_SUBSCRIBECONFIRMRECORD')->result_array();
        return $result;
    }
    public function getSubscriptionDataWithUserID($userID) {
        $this->db->select("*");
        $this->db->where('FUSERID',$userID);
        $result = $this->db->get('T_SUBSCRIBECONFIRMRECORD')->result_array();
        return $result;
    }
    
    public function getSubscriptionDataWithBankID($BankID) {
        $this->db->select("*");
        $this->db->where('FBANKID',$BankID);
        $result = $this->db->get('T_SUBSCRIBECONFIRMRECORD')->result_array();
        return $result;
    }
    
    public function getPeopleCount()
    {
        $this->db->select("*");
        return $this->db->get('T_SUBSCRIBECONFIRMRECORD')->num_rows();
    }
    
    public function getSubcribeAmountTotal()
    {
        $this->db->select("*");
        
        $result = $this->db->get('T_SUBSCRIBECONFIRMRECORD')->result_array();
        $subcribeAmountTotal = 0;
        foreach ( $result as $item) {
            $subcribeAmountTotal += intval($item['FAMOUNT']) + intval($item['FLEVERAMOUNT']);
        }
        return $subcribeAmountTotal;
    }
    
    public function  getStatisticDetail() {
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $this->load->model("Project_model");
        $result['projectCount'] = $this->Project_model->getProjectTotalNum();
        $result['peopleCount'] = $this->getPeopleCount();
        $result['subcribeAmountTotal'] = $this->getSubcribeAmountTotal();
        $this->load->model("BonusRecord_model");
        $result['bonusAmountTotal'] = $this->BonusRecord_model->getBonusAmountTotal();
        $data['data'] = $result;
        return $data;
    }
    
    public  function  applySubscribe($userID, $projectID, $subscribeAmount, $subscribeRatio, $bankId) {
    	$this->load->model('Project_model');
        $project = $this->Project_model->getProjectInfoWithProjectID($projectID);
        $insertArr = array(
            'FPROJECTID' => $projectID,
            'FUSERID' => $userID,
            'FBANKID' => $bankId,
            'FAMOUNT' => 'test',
            'FLEVERRATIO' => $subscribeRatio,
            'FLEVERAMOUNT' => 'test',
            'FCONFIRMAMOUNT' => 'test',
            'FLEVERCONFIRMAMOUNT' => 'test',
            'FPROJECTNAME' => $project['FNAME']
        );
        $result=  $this->db->insert('T_SUBSCRIBECONFIRMRECORD', $insertArr);
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] = $result;
        return  $data;
    }
}