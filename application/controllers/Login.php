<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
  function __construct() {
        parent::__construct();
    }
    public function index()
    {
    $this->load->view('admin/login');

    }

    public function newlogin()
    {
    $this->load->view('login');

    }

    public function userLogin()
    {
      $response=array();
      $post=$this->input->post();
      $checkIfExit=$this->m->checkIfExist('login_reg',array('users_email'=>$post['email'],'password'=>$post['password']),null,true);
   
       if($checkIfExit['status']==true) {   

        $userData=$checkIfExit['data'];
        if($userData['u_status']==0)
        {
           $this->session->set_flashdata('category_success', 'Your Account is deactivate,please contact with admin');
        }

        $this->session->set_userdata('loginUser',$userData);
          
    }
   else{
    $this->session->set_flashdata('category_error', 'Your email or Password Invalid,Please Enter valid credientials');
 redirect(base_url('login'), 'refresh'); 
  }
        // $this->session->set_flashdata('category_success', 'Welcome To Only Tourism,Login Successfully');
        //  redirect(base_url('dashboard'), 'refresh');

         $user=$this->session->userdata('loginUser');
          redirect(base_url('all-users'));
       

    }


    public  function logout()
    {
        $this->session->unset_userdata('loginUser');
        redirect(base_url());

    }


}
