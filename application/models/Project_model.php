<?php
defined('BASEPATH') or exit('Error');

/**
 *
*/
class Project_model extends CI_Model
{
    public $FID;
    public $FNAME;
    public $FNUMBER;
    public $FSTATE;
    public $FSTATUS;
    public $FCREATETIME;
    public function __construct()
    {
        # code...
        parent::__construct();
        $this->load->database();
    }
    
    public function  getCurrentProject()
    {
        $ProjectList = $this->getProjectBack();
        $data=$ProjectList['data'];
        $result = $data[0];
        $besti = 0;
        foreach ($data as $item) {
            if($item['FID'] > $besti) {
                $besti = $item['FID'];
                $result = $item; 
            }
        }
        return $result;
    }
    
    public function  getProjectTotalNum()
    {
        $query=$this->db->select('*');
        $query=$this->db->where('FSTATUS =', true);
        $query=$this->db->get('T_PROJECT');
        return $query->num_rows();
    }
    
    public function  getProjectBack()
    {
        $query=$this->db->select("*");
        $query=$this->db->get('T_PROJECT');
        $result = $query->result_array();
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] = $result;
        return  $data;
    }
    
    public function getProjectList($begin,$count,$userID,$subscribeStartDate, $subscribeEndDate, $status,$projectName){
        $tablename = 'T_PROJECT';
        //$test = strval($subscribeStartDate);
        $where ='';
        $startdatetime = new DateTime($subscribeStartDate);
        $startTime= $startdatetime->format('Y-m-d H:i:s');
        $endDatetime = new DateTime($subscribeEndDate);
        $endTime = $endDatetime->format('Y-m-d H:i:s');
        $where = "'".$startTime."' < DATE_FORMAT(FCREATETIME,'%Y-%m-%d %H:%i:%s') AND DATE_FORMAT(FCREATETIME,'%Y-%m-%d %H:%i:%s') <'".$endTime."'";
        if($status) {
            $where = $where.' AND FSTATUS = '.$status;
        }
        if($projectName) {
            $this->db->like('FPROJECTNAME', $projectName); 
        }
        $dataArray = $this->getPageData($tablename, $where, $count, $begin, $this->db);
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $resultArr = array();
        foreach($dataArray as $item) {
            $tempItem['projectName'] = $item['FPROJECTNAME'];
            $tempItem['projectId'] = $item['FID'];
            $tempItem['HDAmount'] = 3;
            $tempItem['regioAmount'] = 3;
            $tempItem['HDAmountComplete'] = "test";
            $tempItem['regioAmountComplete'] = "test";// 临时数据，还没有加入照片
            $this->load->model('Picture_model');
           // $tempItem['picList'] = $this->Picture_model->getPictureWithProjectID($item['FID']);
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

        /*$this->load->model('Pic_model');
        $result['PictureList'] = $this->Pic_model->getProjectID($projectId);
        $this->load->model('News_model');
        $result['NEWSList'] = $this->News_model->getProjectID($projectId);
        $this->load->model('Follower_model');
        $result['FollowerList'] = $this->Follower_model->getProjectID($projectId);
        $this->load->model('FollowScheme_model');
        $result['FollowSchemeList'] = $this->FollowScheme_model->getProjectID($projectId);*/

        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] = $result;
        return  $data;
    }
    
    public function  getProjectInfoWithProjectID($projectId) {
        
        $query=$this->db->select("*");
        $query=$this->db->where('FPROJECTID',$projectId);
        $query=$this->db->join('T_PROJECT', 'T_PROJECT.FID='.$projectId);
        $query=$this->db->get('T_PROJECTDETAILINFO');
        $result = $query->result_array();
        return $result;
        if ($result)
            return $result[0]; 
        else 
            return "error";
    }
    
    public function  getProjectWithProjectID($projectId) {
    
        $query=$this->db->select("*");
        $query=$this->db->where('FPROJECTID',$projectId);
        $query=$this->db->get('T_PROJECT');
        $result = $query->result_array();
        return $result[0];
    }
    
    public function  addProject($userID,$projectNumber,$projectName,$state) {
        $this->FNUMBER = $projectNumber;
        $this->FNAME = $projectName;
        $this->FCREATETIME = date('Y-m-d H:i:s');
        $this->FSTATUS = true;
        $this->FSTATE =$state;
        $this->FID='12345';//临时
        $this->db->insert('T_PROJECT', $this);
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] = $this->db->insert_id();
        return  $data;
    }
}