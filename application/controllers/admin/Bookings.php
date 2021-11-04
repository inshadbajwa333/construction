<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bookings extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
    }
     public function index()
    {
        $data['title'] = "View All Activities";
        $user=$this->session->userdata('loginUser');
        $data['booking']=$this->m->getAll('bookings',null,null,null,null,'b_id','DESC');
     
        $data['page']='bookings/viewBookings';
        $this->load->view('admin/template/contents',$data);

    }



}
