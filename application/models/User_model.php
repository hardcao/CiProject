<?php
defined('BASEPATH') or exit('Error');

/**
 *
*/
class User_model extends CI_Model
{
    public function __construct()
    {
        # code...
        parent::__construct();
        $this->load->database();
        $this->load->model('Tools');
    }
    public function  getAllUsers($userName){
        if($userName) {
            $this->db->where('FNAME',$userName);
        }
        $this->db->select("*");
        $result = $this->db->get('T_USER')->result_array();
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] = $result;
        return $data;
    }
    
    public function getUser($FID) {
        $this->db->select("*");
        $this->db->where('FID',$FID);
        $result = $this->db->get('T_USER')->result_array();
        return $result[0];
    }
    
    public function  addUser($dataArry){
        $insertArry = array(
            'FNUMBER'=>$dataArry['FNUMBER'],
            'FNUMBER' =>$dataArry['FNUMBER'],
            'FORG' => $dataArry['FORG']
        );
        $this->db->insert('T_USER', $insertArry);
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] = '0';
        return  $data;
    }
    
    public function getPersonalDetail($userID) {
        $this->db->select("*");
        $this->db->where('FID',$userID);
        $result = $this->db->get('T_USER')->result_array();
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $this->load->model('Subscription_model');
        $SubscriptionArray = $this->Subscription_model->getSubscriptionDataWithUserID($userID);
        $bonusAmountTotal = 0;
        $subscribeAmountTotal = 0;
        $payAmountTotal = 0;
        $leverageAmountTotal = 0;
        $subscribeProCount = 0;
        foreach ($SubscriptionArray as $item) {
            $subscribeProCount ++;
            $fID = $item['FID'];
            $this->load->model('BonusRecord_model');
            $recodeArray = $this->BonusRecord_model->getSubscriptionDataWithRecodeID($fID);
            foreach ($recodeArray as $recodeItem) {
                $bonusAmountTotal += intval($recodeItem['FBONUSAMOUNT']);
            }
            $this->load->model('PayRecord_model');
            $recodeArray = $this->PayRecord_model->getSubscriptionDataWithRecodeID($fID);
            foreach ($recodeArray as $recodeItem) {
                $payAmountTotal += intval($recodeItem['FPAYAMOUNT']);
            }
            $leverageAmountTotal += intval($item['FAMOUNT']);
        }
        $result['subscribeAmountTotal'] = $subscribeAmountTotal;
        $result['bonusAmountTotal'] = $bonusAmountTotal;
        $result['payAmountTotal'] = $payAmountTotal;
        $result['leverageAmountTotal'] = $leverageAmountTotal;
        $result['subscribeProCount'] = $subscribeProCount;
        $data['data'] = $result;
        return $data;
    }
    
    public function  getPersonSubscribeDetail($begin,$count,$userID,$projectId) {
       
        $tablename = 'T_SUBSCRIBECONFIRMRECORD';
        $where ='';
        if($projectId){
           $where += 'FPROJECTID = '.$projectId;
        }
        if($userID) {
            $where += ' AND FCREATORID ='.$userID;
        }
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] = $this->getPageData($tablename, $where, $count, $begin, $this->db);;
        return $data;
    }
    
    public function getPageData($tablename, $where, $limit, $offset, $db)
    {
        if(empty($tablename))
        {
            return FALSE;
        }
         
        $dbhandle = empty($db) ? $this->db : $db;
         
        if($where)
        {
            if(is_array($where))
            {
                $dbhandle->where($where);
            }
            else
            {
                $dbhandle->where($where, NULL, false);
            }
        }
         
        $db = clone($dbhandle);
         
        if($limit)
        {
            $db->limit($limit);
        }
         
        if($offset)
        {
            $db->offset($offset);
        }
         
        $data = $db->get($tablename)->result_array();
         
        return $data;
    }
    public function getAllProjectUser($projectID) {
        $query=$this->db->select("*");
        $query=$this->db->where('FPROJECTID',$projectID);
        $query=$this->db->join('T_USER', 'T_USER.FID=T_PROJECT_USER.FUSERID');
        $query=$this->db->get('T_PROJECT_USER');
        $result = $query->result_array();
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] = $result;
        return $data;
    }

    public function getAllUsersWithProjectID($projectId,$userName) {
        $followerList = $this->getFollorUserIDList($projectId);
        $allUser = $this->getUserList($userName);
        $insertArry = array();
        foreach ($allUser as $userKey=>$userValue)
        {
            $flag = 1;
            foreach ($followerList as $fkey => $fvalue) {
                if($fvalue['userID'] == $userValue['FID'])
                {
                    unset($allUser[$userKey]);
                    $flag = 0;
                    break;
                }
            }
            if($flag)
                array_push($insertArry, $userValue);
        }
       
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] = $insertArry;
        return $data;
    }
    public function getFollorUserIDList($projectId){
        $this->db->select("T_FOLLOWER.FUSERID as userID");
        $this->db->where('FPROJECTID',$projectId);
        $result = $this->db->get('T_FOLLOWER')->result_array();
        return $result;
    }

    public function getUserList($userName) {
        $this->db->select("*");
        if($userName)
            $this->db->like('FNAME',$userName);
        $result = $this->db->get('T_USER')->result_array();
        return $result;
    }
}