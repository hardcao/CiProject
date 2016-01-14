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
        $subscribeAmountTotal = 0;//还未实现
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
        //建议在认购数据表中添加一个认购项目名
        $tablename = 'T_SUBSCRIBECONFIRMRECORD';
        $where ='';
        if($projectId){
           $where += 'FPROJECTID = ' + $projectId;
        }
        if($userID) {
            $where += 'AND FCREATORID =' + $userID;
        }
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] = $this->getPageData($tablename, $where, $count, $begin, $his->db);;
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
        $total = $dbhandle->count_all_results($tablename);
         
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