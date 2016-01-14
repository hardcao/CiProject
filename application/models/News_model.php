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
        $where = 'FPROJECTID = ' + $projectId;
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
    public function  getDynamicNewsDetailtest() {
        $this->db->select("*");
        $this->db->join('booktest','users.username = booktest.username');
        return $this->db->get('users')->result_array();;
    }
    
    
}