<?php
class FollowScheme_model extends CI_Model
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
    
    public function getProjectID($FPROJECTID) {
        $this->db->select("*");
        $this->db->where('FPROJECTID',$FPROJECTID);
        $result = $this->db->get('T_FOLLOWAGREEMENT')->result_array();
        return $result;
    }

    public function getPersonBankInfo($FID) {
        $this->db->select("*");
        $this->db->where('FID',$FID);
        $result = $this->db->get('T_FOLLOWSCHEME')->result_array();
        return $result[0];
    }
    
    public function  addFollowScheme($dataArry){
        $insertArry = array(
        'FPROJECTID'=>$dataArry['FPROJECTID'],
        'FSUBSCRIBESTARTDATE' =>$dataArry['FSUBSCRIBESTARTDATE'],
        'FSUBSCRIBEENDDATE' => $dataArry['FSUBSCRIBEENDDATE'],
        'FPAYSTARTDATE' => $dataArry['FPAYSTARTDATE'],
        'FPAYENDDATE' => $dataArry['FPAYENDDATE'],
        'FFUNDPEAKE' => $dataArry['FFUNDPEAKE'],
        'FHDRATIO' => $dataArry['FHDRATIO'],
         'FHDAMOUNT'=>$dataArry['FHDAMOUNT'],
        'FREGIONRATIO'=>$dataArry['FREGIONRATIO'],
        'FREGIONAMOUNT'=>$dataArry['FREGIONAMOUNT'],
        'FALLRATION' =>$dataArry['FALLRATION'],
        'FALLAMOUNT'=>$dataArry['FALLAMOUNT'],
       'FLEVERAGEDES' =>$dataArry['FLEVERAGEDES'],
        'FFOLLOWTEAM'=>$dataArry['FFOLLOWTEAM'],
        'FCOLLECTWAY'=>$dataArry['FCOLLECTWAY']
        );
        $this->db->insert('T_BANKINFO', $insertArry);
        $data["success"] = true;
        $data["errorCode"] = 0;
        $data["error"] = 0;
        $data['data'] = '0';
        return  $data;
    }
}