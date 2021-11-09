<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
  function __construct() {
        parent::__construct();
        $this->lang->load('message','english');
    }
     
    public function index()
    {        
        $data['title'] = "Home";
       $data['page']='index';
        $this->load->view('theme/template/contents',$data);

    }

    public function construction()
    {        
        $data['title'] = "Construction work";
        $data['works']=$this->m->getAll('works',null,array("w_cat"=>"const"),null,null,'w_id','DESC');
       $data['page']='construction';
        $this->load->view('theme/template/contents',$data);

    }


    public function painting()
    {        
        $data['title'] = "Painting Works";
        $data['works']=$this->m->getAll('works',null,array("w_cat"=>"painting"),null,null,'w_id','DESC');
       $data['page']='painting';
        $this->load->view('theme/template/contents',$data);

    }
    public function refurb()
    {        
        $data['title'] = "Refurb Works";
        $data['works']=$this->m->getAll('works',null,array("w_cat"=>"refurb"),null,null,'w_id','DESC');
       $data['page']='refurb';
        $this->load->view('theme/template/contents',$data);

    }

    public function other()
    {        
        $data['title'] = "Other Works";
        $data['works']=$this->m->getAll('works',null,array("w_cat"=>"other"),null,null,'w_id','DESC');
       $data['page']='other';
        $this->load->view('theme/template/contents',$data);

    }

    public function contact()
    {        
        $data['title'] = "Contact Us";
       $data['page']='contact';
        $this->load->view('theme/template/contents',$data);

    }
    public function contactsubmit()
    {    
        $data = array(
            'type' => $this->input->post('type'),
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'message' => $this->input->post('message')
        );
        // print_r(json_encode($data));

        $insert=$this->m->store('contact',$data);

        if($insert){
                redirect(base_url('contact'));
        }else{
            echo "Some thing went wrong";
        }


    }
    

    
  
}
