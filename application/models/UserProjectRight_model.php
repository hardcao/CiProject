<?php
defined('BASEPATH') or exit('Error');

/**
 *
*/
class UserProjectRight_model extends CI_Model
{
    public function __construct()
    {
        # code...
        parent::__construct();
        $this->load->database();
    }
    
    public function getUserProjectRight($userID,$ProjctID) {
        $selectData = "T_USERPROJECTRIGHT.FID as FID,T_USERPROJECTRIGHT.FBASICS as FBASICS,T_USERPROJECTRIGHT.FNEWS as FNEWS,T_USERPROJECTRIGHT.FSUBSCRIPTION as FSUBSCRIPTION,T_USERPROJECTRIGHT.FPAYCONFIRM as FPAYCONFIRM,T_USER.FNAME as FUSERNAME,T_PROJECT.FNAME as FPROJECTNAME,T_USERPROJECTRIGHT.FBONUSDETAIL as FBONUSDETAIL";
        $where = 'T_PROJECT.FID ='.$ProjctID.' AND T_USER.FID = '.$userID;
        $this->db->where($where);
        $this->db->select( $selectData);
        $this->db->join('T_USER', 'T_USER.FID=T_USERPROJECTRIGHT.FUSERID');
        $this->db->join('T_PROJECT', 'T_PROJECT.FID=T_USERPROJECTRIGHT.FPROJECTID');
        $result = $this->db->get('T_USERPROJECTRIGHT')->result_array();
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] = $result;
        return  $data; ;
    }

    public function getProjectUserRightWithProjectID($ProjctID)
    {
        $selectData = "T_USERPROJECTRIGHT.FID as FID,T_USERPROJECTRIGHT.FBASICS as FBASICS,T_USERPROJECTRIGHT.FNEWS as FNEWS,T_USERPROJECTRIGHT.FSUBSCRIPTION as FSUBSCRIPTION,T_USERPROJECTRIGHT.FPAYCONFIRM as FPAYCONFIRM,T_USER.FNAME as FUSERNAME,T_PROJECT.FNAME as FPROJECTNAME,T_USERPROJECTRIGHT.FBONUSDETAIL as FBONUSDETAIL";
        $this->db->select( $selectData);
        $this->db->where('T_PROJECT.FID',$ProjctID);
        $this->db->join('T_USER', 'T_USER.FID=T_USERPROJECTRIGHT.FUSERID');
        $this->db->join('T_PROJECT', 'T_PROJECT.FID=T_USERPROJECTRIGHT.FPROJECTID');
        $result = $this->db->get('T_USERPROJECTRIGHT')->result_array();
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] = $result;
        return  $data;
    }

     public function getProjectUserRightWithUserID($userID)
    {
        $selectData = "T_USERPROJECTRIGHT.FID as FID,T_USERPROJECTRIGHT.FBASICS as FBASICS,T_USERPROJECTRIGHT.FNEWS as FNEWS,T_USERPROJECTRIGHT.FSUBSCRIPTION as FSUBSCRIPTION,T_USERPROJECTRIGHT.FPAYCONFIRM as FPAYCONFIRM,T_USER.FNAME as FUSERNAME,T_PROJECT.FNAME as FPROJECTNAME,T_USERPROJECTRIGHT.FBONUSDETAIL as FBONUSDETAIL";
        $this->db->select( $selectData);
        $this->db->where('T_USER.FID',$userID);
        $this->db->join('T_USER', 'T_USER.FID=T_USERPROJECTRIGHT.FUSERID');
        $this->db->join('T_PROJECT', 'T_PROJECT.FID=T_USERPROJECTRIGHT.FPROJECTID');
        $result = $this->db->get('T_USERPROJECTRIGHT')->result_array();
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] = $result;
        return  $data;
    }

    public function getAllUserRight($ProjctID,$userName)
    {
        $userInfo = $this->getAllUserInfo($userName);
        $insertArr = array();
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
       
       
        foreach ($userInfo as $item) {
            $searchResult = $this->getUserProjectRight($item['FID'],$ProjctID);
            
            $tempResult = $searchResult['data'];
            if($tempResult != NULL) {
                $tempResult['FSTATUS'] = true;
            } else {
                $tempResult =  $item;
                $tempResult['FSTATUS'] = false;
                $tempResult['FNEWS'] = false;
                $tempResult['FSUBSCRIPTION'] = false;
                $tempResult['FPAYCONFIRM'] = false;
                $tempResult['FBONUSDETAIL'] = false;
                $tempResult['FBASICS'] = false;
            }
            array_push($insertArr,  $tempResult);
        }
       
        $data['data'] = $insertArr;
        return  $data;
    }

    public function getAllUserInfo($userName)
    {
        $selectData = "T_USER.FID as FID,T_USER.FNAME as FUSERNAME";
        if($userName != NULL )
             $this->db->like('FNAME',$userName);
        $this->db->select( $selectData);
        $this->db->order_by('T_USER.FORG','DESC');
        $result = $this->db->get('T_USER')->result_array();
        return $result;
    }
}