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
          redirect(base_url('dashboard'));
       

    }


    public  function logout()
    {
        $this->session->unset_userdata('loginUser');
        redirect(base_url());

    }

    public function sendotp()
    {
        $post = $this->input->post();
        $ch3 = curl_init();
        curl_setopt($ch3, CURLOPT_URL, $this->api_url . "rest/api/v1/admin/check/emirates/id?emiratesId=" . $post['user_phone']);
        curl_setopt($ch3, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch3, CURLOPT_CUSTOMREQUEST, "GET");
        $response3 = curl_exec($ch3);
        $httpcode = curl_getinfo($ch3, CURLINFO_HTTP_CODE);
        curl_close($ch3);

        // print_r($response3);
        if ($httpcode == "200" or $httpcode == "201")
        {
            $data = true;
        }
        else
        {
            $data = false;
        }
        // echo json_encode($data);
        echo json_encode(array("status" => $data,"data" => $post['user_phone']));
    }
      public function verifyotp()
    {
       $response=array();
      $post=$this->input->post();
         $ch = curl_init();
        $loginUrl = $this->api_url.'rest/api/v1/admin/verify/otp';
        curl_setopt($ch, CURLOPT_URL, $loginUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'eId='.$post['eId'].'&otp='.$post['otp']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $store = curl_exec($ch);
        curl_close($ch);
        $json = json_decode($store, true);



        if($json['statusCode']==200) {

        $userData=$json['result'];
        $this->session->set_userdata('loginUser',$userData);
                $status = true;
            }
            else
            {
            $status = false;
          }

    echo json_encode(array("status" => $status,"data" => $json));

    }

}
