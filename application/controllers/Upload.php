<?php

class upload extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
    }

    public function index()
    {
        $this->load->view('upload_success', array('error' => ' ' ));
    }

    public function addEnclosure()
    {
        
        $config['upload_path']      = './fileFolder/';
        $config['allowed_types']    = 'gif|jpg|png|txt|xls|doc';
        $config['max_size']     = 100;
        $config['max_width']        = 1024;
        $config['max_height']       = 768;

        $this->load->library('upload', $config);
        
        if ( ! $this->upload->do_upload('userfile'))
        {
            $error = array('error' => $this->upload->display_errors());

            $this->load->view('upload_form', $error);
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
           echo $data['upload_data']['file_name'];
           
                    
        }
    }
}
?>