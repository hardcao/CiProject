<?php

 defined('BASEPATH') or exit('Error!');

 /**
  *
  */
 class Login extends CI_Controller
 {

  public function __construct()
   {
     # code...
     parent::__construct();
     $this->load->library(array('session'));
     $this->load->helper(array('url'));
     $this->load->model('User_model');
   }

   public function index()
   {
     $this->load->view('loginview');
   }

   public function login(){
       if($this->session->userdata('username')!=''){
            redirect(base_url('/loginview/index'));
       }else{
            $this->load->view('loginview');
        }
    
   }

   public function logout(){
      $this->session->unset_userdata('username');
      redirect(base_url('Login/login'));
   }
 }
