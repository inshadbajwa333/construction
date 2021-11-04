<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
  function __construct() {
        parent::__construct();
    }  

    public function register()
    {
       $response=array();
      $post=$this->input->post();     
     $cu_token = uniqid();

      $data = array(
        'cu_name' => $this->input->post('cu_name'),
      'cu_email' => $this->input->post('cu_email'),
      'cu_token' => $cu_token,
      'cu_password' => $this->input->post('cu_password')
    );
    $insert=$this->m->store('customers',$data);
    if($insert){
            redirect(base_url('login'));
         }else{
            redirect(base_url('register'));
         }
  
    }
    
    public function login()
    {
       $response=array();
      $post=$this->input->post();
      $checkIfExit=$this->m->checkIfExist('customers',array('cu_email'=>$post['cu_email'],'cu_password'=>$post['cu_password']),null,true);
   
       if($checkIfExit['status']==true) {   

        $customerData=$checkIfExit['data'];
        if($customerData['cu_status']==0)
        {
           $this->session->set_flashdata('category_success', 'Please activiate your account first from your email.');
        }

        $this->session->set_userdata('customerlogin',$customerData);
          
    }
   else{
    $this->session->set_flashdata('category_error', 'Your email or Password Invalid,Please Enter valid credientials');
 redirect(base_url('login'), 'refresh'); 
  }
        $this->session->set_flashdata('category_success', '');
         redirect(base_url(), 'refresh');

    }

}
