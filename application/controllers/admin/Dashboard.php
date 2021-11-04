<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Dashboard extends CI_Controller {



    public function __construct()

    {

        parent::__construct();


    }
    public function index()

    {
      $data['page']='index';
      $this->load->view('admin/template/contents',$data);
      
    }

    public function viewDetailVisa($id)

    {
      $data['o']=$this->m->getAll('orders',null,array('o_id'=>$id),null,true);
      $data['page']='orderDetail';
      $this->load->view('theme/template/contents',$data);
      
    }

    public function addPrice()

    {
      
      $data['page']='addPrice';
      $this->load->view('theme/template/contents',$data);
      
    }

    public function allPrices()

    {
      $data['prices']=$this->m->getAll('prices','*',null,null,null,'p_id','DESC','p_country');
      $data['page']='allPrices';
      $this->load->view('theme/template/contents',$data);
      
    }

    public function editPrice($country)

    {
      $data['e']=$this->m->getAll('prices','*',array('p_country'=>$country),null,null,'p_id','ASC',null);
     
      $data['page']='editPrices';
      $this->load->view('theme/template/contents',$data);
      
    }

    public function storePrice()

    {
      $post = $this->input->post();
    $visa_type=$post['visa_type'];
    $price=$post['price'];
    $desc=$post['desc'];

    $sample = array();
  for($z=0; $z<count($visa_type); $z++){     
      $insert=$this->m->store('prices',array("p_country"=>$post['country_code'],"p_price"=>$price[$z],"p_visatype"=>$visa_type[$z],"p_desc"=>$desc[$z]));
  }       
      
      $data['page']='addPrice';
      $this->load->view('theme/template/contents',$data);
      
    }

    public function updatePrice()

    {
      $post = $this->input->post();
    $country=$post['p_country'];
    $visa_type=$post['visa_type'];
    $price=$post['price'];
    $desc=$post['desc'];


    $delete=$this->m->delete('prices',array('p_country'=> $country));
    $sample = array();
  for($z=0; $z<count($visa_type); $z++){     
      $insert=$this->m->store('prices',array("p_country"=>$country,"p_price"=>$price[$z],"p_visatype"=>$visa_type[$z],"p_desc"=>$desc[$z]));
    }       
  $data['prices']=$this->m->getAll('prices','*',null,null,null,'p_id','DESC','p_country');
      $data['page']='allPrices';
      $this->load->view('theme/template/contents',$data);
      
    }

    public function deletePrices($country){

      $post = $this->input->post();

      $delete=$this->m->delete('prices',array('p_country'=> $country));

      $data['prices']=$this->m->getAll('prices','*',null,null,null,'p_id','DESC','p_country');
      $data['page']='allPrices';
      $this->load->view('theme/template/contents',$data);

  }

  function check_country()  
    {  
              if($this->m->is_country_exsit($_POST["country_code"]))  
              {  
                   echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"> Country already exist in list </span></label>';  
              }  
              else  
              {  
                echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> </label>';  
              }  
          
    } 
}
