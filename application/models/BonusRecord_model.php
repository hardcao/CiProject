<?php
defined('BASEPATH') or exit('Error');

class BonusRecord_model extends CI_Model
{
    public function __construct()
    {
        # code...
        parent::__construct();
        $this->load->database();
    }
    
    public function  addpayDataArry($subscribeConfigrmRecordId, $bonusTimes,$bonusAmount,$bonusyDate) {
        $this->load->model('Subscription_model');
        $result = $this->Subscription_model->getSubscriptionDataWithRecordId($subscribeConfigrmRecordId);
        $data = array (
            'FSUBSCRIBECONFIGRMRECORDID' => $subscribeConfigrmRecordId,
            'FBONUSDATE' => $bonusyDate,
            'FBONUSAMOUNT' => $bonusAmount,
            'FPROJECTNAME' =>$result['FPROJECTNAME'],
            'FPROJECTID' => $result['FPROJECTID'],
            'FUSERID' => $result['FUSERID']
        );
        return $data;
    }
    
    public function addBonusList($dataArr) {
        $insertArr = array();
        $result = '';
        foreach ($dataArr as $item) {
        	$oneData = $this->addpayDataArry($item['subscribeConfigrmRecordId'], $item['bonusTimes'], $item['bonusAmount'], $item['bonusyDate']);
        	$result=  $this->db->insert('T_BONUSRECORD', $oneData);
        	//array_push($insertArr, $oneData);
        }
       
        //$result=  $this->db->insert('T_BONUSRECORD', $insertArr);
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] = $result;
        return  $data;
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
    public function getPersonBounsDetail($begin,$count,$userID,$projectId){
        $tablename = 'T_PAYRECORD';
        $where ='';
        if($projectId){
            $where += 'FPROJECTID = '.$projectId;
        }
        if($userID) {
            $where += ' AND FUSERID ='.$userID;
        }
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $result =  $this->getPageData($tablename, $where, $count, $begin, $this->db);;
        $totalPayAmount = 0;
        if($projectId && $userID) {
            foreach ($result as $item) {
                $totalPayAmount +=intval($item['FBONUSAMOUNT']);
            }
        }
        $data['data'] = $result;
        if($totalPayAmount != 0) {
            $data['totalBonusAmount'] = $totalPayAmount;
        }
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
        
        public function getFollower($FID) {
            $this->db->select("*");
            $this->db->where('FID',$FID);
            $result = $this->db->get('T_PAYRECORD')->result_array();
            return $result[0];
        }

         public function getAllPayRecod($projectId) {
            $selectData = "T_SUBSCRIBECONFIRMRECORD.FID as FID, T_USER.FNAME as FNAME, T_USER.FORG as FORG,T_FOLLOWER.FSTATE as FSTATE,T_SUBSCRIBECONFIRMRECORD.FCONFIRMAMOUNT as FCONFIRMAMOUNT,T_BANKINFO.FBANKNO as FBANKNO";
            $this->db->select($selectData);
            $this->db->join('T_USER','T_USER.FID=T_SUBSCRIBECONFIRMRECORD.FUSERID');
            $this->db->join('T_FOLLOWER','T_FOLLOWER.FUSERID=T_SUBSCRIBECONFIRMRECORD.FUSERID');
            $this->db->join('T_BANKINFO','T_BANKINFO.FID=T_SUBSCRIBECONFIRMRECORD.FBANKID');
            $this->db->where('T_SUBSCRIBECONFIRMRECORD.FPROJECTID',$projectId);
            $result = $this->db->get('T_SUBSCRIBECONFIRMRECORD')->result_array();
            return $result;
        }

        public function getAllPayRecodFilds($projectId) {
            $selectData = "T_SUBSCRIBECONFIRMRECORD.FID as FID,T_USER.FNAME as FNAME, T_USER.FORG as FORG,T_FOLLOWER.FSTATE as FSTATE,T_SUBSCRIBECONFIRMRECORD.FCONFIRMAMOUNT as FCONFIRMAMOUNT";
            $this->db->select($selectData);
            $this->db->join('T_USER','T_USER.FID=T_SUBSCRIBECONFIRMRECORD.FUSERID');
            $this->db->join('T_FOLLOWER','T_FOLLOWER.FUSERID=T_SUBSCRIBECONFIRMRECORD.FUSERID');
            $this->db->where('T_SUBSCRIBECONFIRMRECORD.FPROJECTID',$projectId);
            $result = $this->db->get('T_SUBSCRIBECONFIRMRECORD')->list_fields();
            return $result;
        }

    
        public function getBonusRecordListByName($subscribeStartDate, $subscribeEndDate,$userName) {
            $tablename = 'T_PROJECT';
       
            if($subscribeStartDate || $subscribeEndDate){
                $startdatetime = new DateTime($subscribeStartDate);
                $startTime= $startdatetime->format('Y-m-d H:i:s');
                $endDatetime = new DateTime($subscribeEndDate);
                $endTime = $endDatetime->format('Y-m-d H:i:s');
                $where = "'".$startTime."' < DATE_FORMAT(T_BONUSRECORD.FBONUSDATE,'%Y-%m-%d %H:%i:%s') AND DATE_FORMAT(T_BONUSRECORD.FBONUSDATE,'%Y-%m-%d %H:%i:%s') <'".$endTime."'";
                $this->db->where($where);
            }
       
            $selectData = "T_BONUSRECORD.FID as FID, T_USER.FNAME as FNAME, T_USER.FORG as FORG,T_FOLLOWER.FSTATE as FSTATE,T_SUBSCRIBECONFIRMRECORD.FCONFIRMAMOUNT as FCONFIRMAMOUNT,T_BONUSRECORD.FBONUSTIMES as FBONUSTIMES,T_BONUSRECORD.FBONUSDATE as FBONUSDATE,T_BONUSRECORD.FBONUSAMOUNT as FBONUSAMOUNT";
            $this->db->select($selectData);
            $this->db->join('T_USER','T_USER.FID=T_SUBSCRIBECONFIRMRECORD.FUSERID');
            $this->db->join('T_FOLLOWER','T_FOLLOWER.FUSERID=T_SUBSCRIBECONFIRMRECORD.FUSERID');
            $this->db->join('T_BONUSRECORD','T_BONUSRECORD.FSUBSCRIBECONFIGRMRECORDID=T_SUBSCRIBECONFIRMRECORD.FID');
            if($userName)
                $this->db->like('FNAME',$userName);
            $result = $this->db->get('T_SUBSCRIBECONFIRMRECORD')->result_array();
            $data["success"] = true;
            $data["errorCode"] = 0;
            $data["error"] = 0;
            $data['data'] =  $result;
            return $data;
        }

        public function exportPayRecordXls() {
            $selectData = "T_SUBSCRIBECONFIRMRECORD.FID as FID, T_USER.FNAME as FNAME, T_USER.FORG as FORG,T_FOLLOWER.FSTATE as FSTATE,T_SUBSCRIBECONFIRMRECORD.FCONFIRMAMOUNT as FCONFIRMAMOUNT,T_BONUSRECORD.FBONUSTIMES as FBONUSTIMES,T_BONUSRECORD.FBONUSDATE as FBONUSDATE,T_BONUSRECORD.FBONUSAMOUNT as FBONUSAMOUNT";
            $this->db->select($selectData);
            $this->db->join('T_USER','T_USER.FID=T_SUBSCRIBECONFIRMRECORD.FUSERID');
            $this->db->join('T_FOLLOWER','T_FOLLOWER.FUSERID=T_SUBSCRIBECONFIRMRECORD.FUSERID');
            $this->db->join('T_BONUSRECORD','T_BONUSRECORD.FSUBSCRIBECONFIGRMRECORDID=T_SUBSCRIBECONFIRMRECORD.FID');
            $result = $this->db->get('T_SUBSCRIBECONFIRMRECORD')->result_array();
            return $result;
    }
}