<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
    }
     public function index()
    {
        $data['title'] = "View All Contacts";
        $user=$this->session->userdata('loginUser');        
        $data['contacts']=$this->m->getAll('contact',null,null,null,null,'c_id','DESC');
        $data['page']='viewContacts';
        $this->load->view('admin/template/contents',$data);

    }




}
