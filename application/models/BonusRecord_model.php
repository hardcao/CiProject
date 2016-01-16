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
    
    public function  addpayDataArry($subscribeConfigrmRecordId, $bonusTimes,$bonusAmount,$bonusyDate) {
        $this->load->model('Subscription_model');
        $result = $this->Subscription_model->getSubscriptionDataWithRecordId($subscribeConfigrmRecordId);
        $data = array (
            'FSUBSCRIBECONFIGRMRECORDID' => $subscribeConfigrmRecordId,
            'FBONUSTIMES' => $bonusTimes,
            'FBONUSDATE' => $bonusyDate,
            'FBONUSAMOUNT' => $bonusAmount,
            'FCREATETIME' => time(),
            'FPROJECTNAME' =>$result['FPROJECTNAME'],
            'FPROJECTID' => $result['FPROJECTID'],
            'FUSERID' => $result['FUSERID']
        );
        return $data;
    }
    
    public function addBonusList($dataArr) {
        $insertArr = array();
        foreach ($dataArr as $item) {
        	$oneData = $this->addpayDataArry($item['subscribeConfigrmRecordId'], $item['bonusTimes'], $item['bonusAmount'], $item['bonusyDate']);
        	array_push($insertArr, $oneData);
        }
       
        $result=  $this->db->insert('T_BONUSRECORD', $insertArr);
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
}