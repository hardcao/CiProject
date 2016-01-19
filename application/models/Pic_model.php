<?php


class Pic_model extends CI_Model
{
    public function __construct()
    {
        # code...
        parent::__construct();
        $this->load->database();
    }

    public function getPic($FID) {
        $this->db->select("*");
        $this->db->where('FID',$FID);
        $result = $this->db->get('T_PIC')->result_array();
        return $result[0];
    }
    
    public function getProjectID($FPROJECTID) {
        $this->db->select("*");
        $this->db->where('FPROJECTID',$FPROJECTID);
        $result = $this->db->get('T_PIC')->result_array();
        return $result;
    }

    public function  addPic($dataArry){
        $insertArry = array(
            'FPROJECTID'=>$dataArry['FPROJECTID'],
            'FNAME' =>$dataArry['FNAME'],
            'FCONTENT' => $dataArry['FCONTENT'],
            'FISMAINPIC' => $dataArry['FISMAINPIC']
        );
        $this->db->insert('T_PIC', $insertArry);
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] = '0';
        return  $data;
    }
}