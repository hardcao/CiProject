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
        $subscribeAmountTotal = 0;
        $payAmountTotal = 0;
        $leverageAmountTotal = 0;
        $payAmountTotal = 0;
        $bonusAmountTotal = 0;
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
        }
        $data['data'] = $result;
        return $data;
    }
}