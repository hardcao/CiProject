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
        
        return array('total' => $total, 'data' => $data);
    }
}