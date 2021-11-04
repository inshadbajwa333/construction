<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Withoutlogin extends CI_Controller {



    public function __construct()

    {

        parent::__construct();

         $this->load->library('paypal_lib');

    }



     public function helpCenter()

    {

        $user=$this->session->userdata('loginUser');

        $data['con']=$this->m->getAll('z_contact',null,array('c_status'=>0,'userId'=>$user['user_id']),null,null,'c_id','DESC',null,10);
       $data['noti']=$this->m->getAll('z_noti','*',array('n_status'=>0,'n_userId'=>$user['user_id']),null,null,'n_status','DESC',null,5);
        

           $data['page']='helpCenter';

        $this->load->view('admin/wosidebar/contents',$data);
    }

     

}

