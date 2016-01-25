<?php  
defined('BASEPATH') or exit('Error!');

/**
 *
*/
class UserProjectRight extends CI_Controller
{

    public function __construct()
    {
        # code...
        parent::__construct();
        $this->load->model('UserProjectRight_model');
    }

    
}