<?php
defined('BASEPATH') or exit('Error!');

/**
 *
*/
class BonusRecord extends CI_Controller
{

    public function __construct()
    {
        # code...
        parent::__construct();
        $this->load->model('BonusRecord_model');
    }
}