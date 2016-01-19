<?php
defined('BASEPATH') or exit('Error');

/**
 *
*/
class News_model extends CI_Model
{
    public function __construct()
    {
        # code...
        parent::__construct();
        $this->load->database();
    }
    
    public function  getDynamicNews($begin,$count,$userID,$projectId)
    {
        $tablename = 'T_NEWS';
        $where = '';//FPROJECTID='.$projectId;
        if($userID) {
          //  $where +=' AND FCREATORID ='.$userID;
        }
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $result = $this->getPageData($tablename, $where, $count, $begin, $this->db);
        $data['data'] = $result;
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
    
    public function  getDynamicNewsDetail($newsId) {
        $this->db->select("*");
        $this->db->where('FID',$newsId);
        $this->db->order_by('FRELEASEDATE', 'asc');
        $result = $this->db->get('T_NEWS')->result_array();
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] = $result;
        return $data;
    }
    
    public function  addNews($dataArry){
        $insertArry = array(
            'FPROJECTID'=>$dataArry['FPROJECTID'],
            'FTITLE' =>$dataArry['FTITLE'],
            'FCREATORID' => $dataArry['FCREATORID'],
            'FCONTENT' => $dataArry['FCONTENT']
        );
        $this->db->insert('T_NEWS', $insertArry);
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] = '0';
        return  $data;
    }
    
    public function  getDynamicNewsDetailtest() {
        $this->db->select("*");
        $this->db->join('booktest','users.username = booktest.username');
        return $this->db->get('users')->result_array();;
    }
    
    public function getNewsListWithProjectID($projectID) {
        $this->db->select("*");
        $this->db->where('FPROJECTID',$projectID);
        $result = $this->db->get('T_NEWS')->result_array();
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] = $result;
        return  $data; ;
    }
    
    public function getProjectID($FPROJECTID) {
        $this->db->select("*");
        $this->db->where('FPROJECTID',$FPROJECTID);
        $result = $this->db->get('T_NEWS')->result_array();
        return $result;
    }
    
    
}