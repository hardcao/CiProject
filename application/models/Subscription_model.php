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

    public function getSubscribeList($projectId)
    {
        $selectData = "T_USER.FNAME as FNAME, T_USER.FORG as FORG,T_FOLLOWER.FSTATE as FSTATE,T_SUBSCRIBECONFIRMRECORD.FAMOUNT as FAMOUNT,T_SUBSCRIBECONFIRMRECORD.FLEVERAMOUNT as FLEVERAMOUNT,T_SUBSCRIBECONFIRMRECORD.FCONFIRMAMOUNT as FCONFIRMAMOUNT,T_SUBSCRIBECONFIRMRECORD.FLEVERCONFIRMAMOUNT as FLEVERCONFIRMAMOUNT";
         $this->db->select($selectData);
         $this->db->join('T_USER','T_USER.FID=T_SUBSCRIBECONFIRMRECORD.FUSERID');
         $this->db->join('T_FOLLOWER','T_FOLLOWER.FUSERID=T_SUBSCRIBECONFIRMRECORD.FUSERID');
        $this->db->where('T_SUBSCRIBECONFIRMRECORD.FPROJECTID',$projectId);
        $result = $this->db->get('T_SUBSCRIBECONFIRMRECORD')->result_array();
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] = $result;
        return  $data;
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