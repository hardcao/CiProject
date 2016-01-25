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
    
    

    public function  getAllNews()
    {
        
        $query=$this->db->select("*");
       // $sql = "SELECT * FROM T_NEWS LEFT OUTER JOIN TableB ON TableA.name = TableB.name";
        $query=$this->db->join('T_USER', 'T_USER.FID=T_NEWS.FCREATORID','left outer');
        $query=$this->db->join('T_PROJECT', 'T_PROJECT.FID=T_NEWS.FPROJECTID','left outer');
        $query=$this->db->get('T_NEWS');
        $result = $query->result_array();
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] = $result;
        return $data;
    }
    public function  getDynamicNews($projectId)
    {
        
        $query=$this->db->select("*");
        $query=$this->db->where('FPROJECTID',$projectId);
       // $sql = "SELECT * FROM T_NEWS LEFT OUTER JOIN TableB ON TableA.name = TableB.name";
        $query=$this->db->join('T_USER', 'T_USER.FID=T_NEWS.FCREATORID','left outer');
        $query=$this->db->join('T_PROJECT', 'T_PROJECT.FID=T_NEWS.FPROJECTID','left outer');
        $query=$this->db->get('T_NEWS');
        $result = $query->result_array();
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] = $result;
        return $data;
    }
    public function getPageData($tablename, $where, $limit, $offset, $db,$joinTable,$joinWhere)
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
        $this->db->join('T_PROJECT', 'T_PROJECT.FID=T_NEWS.FPROJECTID');
        $this->db->join('T_USER', 'T_USER.FID=T_NEWS.FCREATORID');
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