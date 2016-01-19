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
    
    public  function  updateData($data,$tableName) {
        $where = 'FID = '.$data['FID'];
        $this->db->update($tableName, $data, $where);
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] = '';
        return  $data;
    }
}