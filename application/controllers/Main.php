<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
  function __construct() {
        parent::__construct();
        $this->lang->load('message','english');
    }
     
    public function index()
    {        
        $data['title'] = "E-Dubai visa for a Dubai tourist - Get Dubai Visa in 24 hours";
       $data['keywords'] = "dubai visa,apply dubai visa,90 days dubai visa,visa dubai,dubai visa online application,apply for dubai tourist visa online,فيزا دبي من تركيا,how to get uae visa online,dubai visit visa online,dubai tourist visa application,30 days dubai visa,30 days visit visa dubai,apply for dubai visit visa online, dubai visit visa,best visa company in dubai,abu dhabi visa, sharjah visa, Dubai tourism";
       $data['description'] = "E-Dubai visa - Plan your travel to Dubai for tourism, business purpose - Express Service.Get Dubai visa online in 24 hours, A Complete Solution for Travelers - Full Packages Available";
        $data['page']='index';
        $this->load->view('theme/template/contents',$data);

    }
  
}
