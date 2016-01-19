<?php
class Tools extends CI_Model
{
    public $FUSERID;
    public $FBANKNO;
    public $FNAME;
    public $FBANKATTRIBUTE;

    public function __construct()
    {
        # code...
        parent::__construct();
    }
    
    public function getDataTime($inputTime) {
        $datetime = new DateTime($inputTime);
        $time= $datetime->format('Y-m-d H:i:s');
        return $time;
    }
    
    public  function  updateData($data,$where,$tableName) {
        $data["success"] = $this->db->update_string($tableName, $data, $where);
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] = '';
        return  $data;
    }
}