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
    
    public function getLoginInfo($begin,$count,$userID,$subscribeStartDate, $subscribeEndDate, $status){
        
    }
    
    /* 获取分页数据及总条数
    * @param string @tablename 表名
    * @param mixed $where 条件
    * @param int $limit 每页条数
    * @param int $offset 当前页
    */
    public function getPageData($tablename, $where, $limit, $offset, $order_by, $db)
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
         
        if($order_by)
        {
            $db->order_by($order_by);
        }
         
        $data = $db->get($tablename)->result_array();
         
        return $data;
    }
}