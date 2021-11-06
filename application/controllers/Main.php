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
        $data['works']=$this->m->getAll('works',null,null,null,null,'w_id','DESC');
       $data['page']='construction';
        $this->load->view('theme/template/contents',$data);

    }

    
  
}
