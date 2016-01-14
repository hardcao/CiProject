<?php
defined('BASEPATH') or exit('Error');

/**
 *
*/
class Project_model extends CI_Model
{
    public function __construct()
    {
        # code...
        parent::__construct();
        $this->load->database();
    }
    
    public function getProjectList($begin,$count,$userID,$subscribeStartDate, $subscribeEndDate, $status){
        $tablename = 'T_PROJECT';
        $joinTableName_1 = 'T_FOLLOWSCHEME';
        $joinTableCondition_1 = 'T_FOLLOWSCHEME.FPROJECTID = T_PROJECT.FPROJECTID';
        $joinTableName_2 = 'T_SUBSCRIBECONFIRMRECORD';
        $joinTableCondition_2 = 'T_SUBSCRIBECONFIRMRECORD.FPROJECTID = T_PROJECT.FPROJECTID';
        $where = $subscribeStartDate+'< FCREATETIME AND  FCREATETIME < ' +  $subscribeEndDate;
        if($status) {
            $where += 'AND FSTATUS = ' + $status;
        }
        $dataArray = $this->getPageData($tablename, $where, $count, $begin, $this->db, $joinTableName_1, $joinTableCondition_1, $joinTableName_2, $joinTableCondition_2);
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $resultArr = array();
        foreach($dataArray as $item) {
            $tempItem['projectName'] = $item['FNAME'];
            $tempItem['projectId'] = $item['FID'];
            $tempItem['HDAmount'] = $item['FHDAMOUNT'];
            $tempItem['regioAmount'] = $item['FREGIONAMOUNT'];
            $tempItem['HDAmountComplete'] = "test";
            $tempItem['regioAmountComplete'] = "test";// 临时数据，还没有加入照片
            array_push($resultArr,$tempItem);
            
        }
     
        echo json_encode($data);
    }
    
    /* 鑾峰彇鍒嗛〉鏁版嵁鍙婃�绘潯鏁�
    * @param string @tablename 琛ㄥ悕
    * @param mixed $where 鏉′欢
    * @param int $limit 姣忛〉鏉℃暟
    * @param int $offset 褰撳墠椤�
    */
    public function getPageData($tablename, $where, $limit, $offset, $db,$joinTableName_1,$joinTableCondition_1,$joinTableName_2,$joinTableCondition_2)
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
         
        if($joinTableName_1)   
        {
            $db->jion($joinTableName_1,$joinTableCondition_1);
        }
        if($joinTableName_2)
        {
            $db->jion($joinTableName_2,$joinTableCondition_2);
        }
        $data = $db->get($tablename)->result_array();
         
        return $data;
    }
    
    public function  getProjectDetailInfo($projectId,$fields){
        $result = $this->getProjectInfoWithProjectID($projectId);
        if($fields) {
            
        } 
        return  $result;
    }
    
    public function  getProjectInfoWithProjectID($projectId) {
        
        $this->db->select("*");
        $this->db->where('FPROJECTID',$projectId);
        return $this->db->get('users')->result_array();
    }
}