<?php


class Follower_model extends CI_Model
{
    public $FPROJECTID;
    public $FSUBSCRIBESTARTDATE;
    public $FSUBSCRIBEENDDATE;
    public $FPAYSTARTDATE;
    public $FPAYENDDATE;
    public $FFUNDPEAKE;
    public $FHDRATIO;
    public $FHDAMOUNT;
    public $FREGIONRATIO;
    public $FREGIONAMOUNT;
    public $FALLRATION;
    public $FALLAMOUNT;
    public $FLEVERAGEDES;
    public $FFOLLOWTEAM;
    public $FCOLLECTWAY;

    public function __construct()
    {
        # code...
        parent::__construct();
        $this->load->database();
    }

    public function getFollower($FID) {
        $this->db->select("*");
        $this->db->where('FID',$FID);
        $result = $this->db->get('T_FOLLOWER')->result_array();
        return $result[0];
    }

    public function  addFollower($dataArry){
        $insertArry = array(
            'FPROJECTID'=>$dataArry['FPROJECTID'],
            'FUSERID' =>$dataArry['FUSERID'],
            'FSEQ' => $dataArry['FSEQ'],
            'FSTATE' => $dataArry['FSTATE'],
            'FDUTY' => $dataArry['FDUTY'],
            'FTOPLIMIT' => $dataArry['FTOPLIMIT'],
            'FDOWNLIMT' => $dataArry['FDOWNLIMT'],
            'FREMARK'=>$dataArry['FREMARK']
        );
        $this->db->insert('T_FOLLOWER', $insertArry);
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] = '0';
        return  $data;
    }
}