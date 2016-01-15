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
    
    public function  getProjectTotalNum()
    {
        $query=$this->db->select('*');
        $query=$this->db->where('FSTATUS =', true);
        $query=$this->db->get('T_PROJECT');
        return $query->num_rows();
    }
    
    public function getProjectList($begin,$count,$userID,$subscribeStartDate, $subscribeEndDate, $status){
        $tablename = 'T_PROJECT';
        $where ='';
        $where = $subscribeStartDate.'< FCREATETIME AND  FCREATETIME < '.$subscribeEndDate;
        if($status) {
            $where += 'AND FSTATUS = '.$status;
        }
        $dataArray = $this->getPageData($tablename, $where, $count, $begin, $this->db);
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $resultArr = array();
        foreach($dataArray as $item) {
            $tempItem['projectName'] = $item['FNAME'];
            $tempItem['projectId'] = $item['FID'];
            $tempItem['HDAmount'] = 3;
            $tempItem['regioAmount'] = 3;
            $tempItem['HDAmountComplete'] = "test";
            $tempItem['regioAmountComplete'] = "test";// 临时数据，还没有加入照片
            $this->load->model('Picture_model');
            $tempItem['picList'] = $this->Picture_model->getPictureWithProjectID($item['FID']);
            array_push($resultArr,$tempItem);
        }
        $data['data'] =  $resultArr;
     
        return $data;
    }
    
    /* 鑾峰彇鍒嗛〉鏁版嵁鍙婃�绘潯鏁�
    * @param string @tablename 琛ㄥ悕
    * @param mixed $where 鏉′欢
    * @param int $limit 姣忛〉鏉℃暟
    * @param int $offset 褰撳墠椤�
    */
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
                 $query=$dbhandle->where($where);
            }
            else
            {
                $query = $dbhandle->where($where, NULL, false);
            }
        }
         
        $db = clone($dbhandle);
         
        if($limit)
        {
            $query= $db->limit($limit);
        }
         
        if($offset)
        {
            $query = $db->offset($offset);
        }
         
        $query = $db->get($tablename);
        $data = $query->result_array();
         
        return $data;
    }
    
    public function  getProjectDetailInfo($projectId,$fields){
        $result = $this->getProjectInfoWithProjectID($projectId);
        if($fields) {
            
        } 
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] = $result;
        return  $result;
    }
    
    public function  getProjectInfoWithProjectID($projectId) {
        
        $query=$this->db->select("*");
        $query=$this->db->where('FID',$projectId);
        $query=$this->db->get('T_PROJECT');
        return $query->result_array();
    }
}