<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
    }
     public function index()
    {
      $user=$this->session->userdata('loginUser');
        
      $data['contacts']=$this->m->getAll('contacts',null,null,null,null,'contact_id','DESC');
      $data['users']=$this->m->getAll('users',null,null,null,null,'u_id','DESC');
              $data['page']='contacts/viewContacts';
              $this->load->view('admin/template/contents',$data);

    }

    public function myContacts()
    {
      $user=$this->session->userdata('loginUser');
      $data['users']=$this->m->getAll('users',null,null,null,null,'u_id','DESC');
      $data['mycontacts']=$this->m->getAll('contacts',null,array('added_by_id' => $user['u_id']),null,null,'contact_id','DESC');
              $data['page']='contacts/myContacts';
              $this->load->view('admin/template/contents',$data);

    }

    public function addNewContact(){
        $user=$this->session->userdata('loginUser');
         
        $data['page'] = 'contacts/addContact';
        $this->load->view('admin/template/contents',$data);
    }

    public function emailFilter(){
        $user=$this->session->userdata('loginUser');
        $data['temp']=$this->m->getAll('agents',null,null,null,null,'a_id','DESC');
        $data['users']=$this->m->getAll('users',null,null,null,null,'u_id','DESC');
        $data['page'] = 'contacts/emailFilter';
        $this->load->view('admin/template/contents',$data);
    }
    

    public function filterAndSend(){
        $user=$this->session->userdata('loginUser');

        $data = array(            
            'contact_country' => $this->input->post('contact_country'),
            'contact_type' => $this->input->post('contact_type'),
            'compaign_name' => $this->input->post('compaign_name'),
            'send_by_email' => $this->input->post('send_by_email'),           
            'send_to' => $this->input->post('send_to')           
            
        );
        $data['userEmail']=$this->m->getAll('users',null,array('u_email'=>$data['send_by_email']),null,true);
        
        $data['staff_name'] = $user['u_name'];

        if($data['contact_country'] == "allCountries" && $data['contact_type'] == "bothType" && $data['send_to'] == "allClients"){
            $data1['mycontacts']=$this->m->getAll('contacts',null,null,null,null,'contact_id','DESC');
       
        }elseif($data['contact_country'] ==  "allCountries" && $data['send_to'] == "allClients"){
            $data1['mycontacts']=$this->m->getAll('contacts',null,array('contact_type' => $data['contact_type']),null,null,'contact_id','DESC');
        
        }elseif($data['contact_country'] ==  "allCountries" && $data['contact_type'] == "bothType"){
            $data1['mycontacts']=$this->m->getAll('contacts',null,array('added_by_name' => $data['send_to']),null,null,'contact_id','DESC');
        
        }elseif($data['send_to'] == "allClients"){
            $data1['mycontacts']=$this->m->getAll('contacts',null,array('contact_country' => $data['contact_country'],'contact_type' => $data['contact_type']),null,null,'contact_id','DESC');
        
        }elseif($data['contact_country'] == "allCountries"){
            $data1['mycontacts']=$this->m->getAll('contacts',null,array('added_by_name' => $data['send_to'],'contact_type' => $data['contact_type']),null,null,'contact_id','DESC');
        }else{
            $data1['mycontacts']=$this->m->getAll('contacts',null,array('contact_country' => $data['contact_country'],'contact_type' => $data['contact_type'],'added_by_name' => $data['send_to']),null,null,'contact_id','DESC');
        }


              
       $data['mycontacts'] = $data1['mycontacts'];

        
        foreach($data1['mycontacts'] as $myc){
            $rec = array("Email"=>$myc['contact_email'],"AttributeData"=>array("Attribute"=>array("Name"=>"Name","Value"=>$myc['contact_name'])));
        $data['emailjson'] = array("UserInfo" => 
                             array("API_Key"=>"NX5tEEXx6UIMTPWxcGiNs1mD51z45KpX54QmbTUGeE6R5iT2RK","RecipientData" => 
                             array("Recipient"=>$rec), "FromEmailId" => $data['send_by_email'], "TemplateID" => $data['compaign_name']));
        $encodejson = json_encode($data['emailjson']);
        $jSON = json_decode($encodejson, true);

        $xml = $this->array2xml($jSON, false);
        
        $ch7 = curl_init();
    
        curl_setopt($ch7, CURLOPT_URL, "https://apiv2.nestedlogics.net/API/Campaign/ShootCampaignNow");
        curl_setopt($ch7, CURLOPT_POST, true);
        curl_setopt($ch7, CURLOPT_POSTFIELDS, $xml);
        curl_setopt($ch7, CURLOPT_RETURNTRANSFER, 1);
        $response2 = curl_exec($ch7);
        $httpcode = curl_getinfo($ch7, CURLINFO_HTTP_CODE);

        $insert=$this->m->store('history',array("his_email"=>$myc['contact_email'],"his_country"=>$myc['contact_country'],"his_admin_name"=>$data['send_by_email']));
        }
        $data['sentToCount'] = count($data1['mycontacts']);
        $storeEmail = array(            
            'e_by_name' => $data['userEmail']['u_name'],
            'e_country' => $data['contact_country'],
            'e_count' =>$data['sentToCount'],
            'created_at' => date("Y-m-d")            
        );
        $insert=$this->m->store('emailhistory',$storeEmail);
        $data['page']='contacts/sentEmailResult';
        $this->load->view('admin/template/contents',$data);

        
    }


    public function ajaxfilter(){


        $data = array(            
            'contact_country' => $this->input->post('contact_country'),
            'contact_type' => $this->input->post('contact_type'),
            'added_by_name' => $this->input->post('added_by_name')
            
        );
       
        if($data['contact_country'] == "allCountries" && $data['contact_type'] == "bothType" && $data['added_by_name'] == "allClients"){
            $data1['mycontacts']=$this->m->getAll('contacts',null,null,null,null,'contact_id','DESC');
       
        }elseif($data['contact_country'] ==  "allCountries" && $data['added_by_name'] == "allClients"){
            $data1['mycontacts']=$this->m->getAll('contacts',null,array('contact_type' => $data['contact_type']),null,null,'contact_id','DESC');
        
        }elseif($data['contact_country'] ==  "allCountries" && $data['contact_type'] == "bothType"){
            $data1['mycontacts']=$this->m->getAll('contacts',null,array('added_by_name' => $data['added_by_name']),null,null,'contact_id','DESC');
        
        }elseif($data['added_by_name'] == "allClients"){
            $data1['mycontacts']=$this->m->getAll('contacts',null,array('contact_country' => $data['contact_country'],'contact_type' => $data['contact_type']),null,null,'contact_id','DESC');
        
        }elseif($data['contact_country'] == "allCountries"){
            $data1['mycontacts']=$this->m->getAll('contacts',null,array('added_by_name' => $data['added_by_name'],'contact_type' => $data['contact_type']),null,null,'contact_id','DESC');
        }else{
            $data1['mycontacts']=$this->m->getAll('contacts',null,array('contact_country' => $data['contact_country'],'contact_type' => $data['contact_type'],'added_by_name' => $data['added_by_name']),null,null,'contact_id','DESC');
        }
              
       $data['mycontacts'] = $data1['mycontacts'];
       $count = count($data['mycontacts']);
       return print_r(json_encode($count));
    }
    public function createContact(){
        $data = array(
            
            'added_by_id' => $this->input->post('added_by_id'),
            'added_by_name' => $this->input->post('added_by_name'),
            'contact_name' => $this->input->post('contact_name'),
            'contact_email' => $this->input->post('contact_email'),
            'contact_phone' => $this->input->post('contact_phone'),
            'contact_country' => $this->input->post('contact_country'),
            'contact_type' => $this->input->post('contact_type'),
            'contact_status' => $this->input->post('contact_status'),
            'created_at' => date('Y-m-d')
        );
        $user=$this->session->userdata('loginUser');
        $insert=$this->m->store('contacts',$data);
        $rec = array("Email"=>$data['contact_email'],"AttributeData"=>array("Attribute"=>array("Name"=>"Name","Value"=>$data['contact_name'])));
        $data['emailjson'] = array("UserInfo" => 
                             array("API_Key"=>"NX5tEEXx6UIMTPWxcGiNs1mD51z45KpX54QmbTUGeE6R5iT2RK","RecipientData" => 
                             array("Recipient"=>$rec), "FromEmailId" => $user['u_email'], "TemplateID" => "3310"));
        $encodejson = json_encode($data['emailjson']);
        $jSON = json_decode($encodejson, true);

        $xml = $this->array2xml($jSON, false);
        
        $ch7 = curl_init();
    
        curl_setopt($ch7, CURLOPT_URL, "https://apiv2.nestedlogics.net/API/Campaign/ShootCampaignNow");
        curl_setopt($ch7, CURLOPT_POST, true);
        curl_setopt($ch7, CURLOPT_POSTFIELDS, $xml);
        curl_setopt($ch7, CURLOPT_RETURNTRANSFER, 1);
        $response2 = curl_exec($ch7);
        $httpcode = curl_getinfo($ch7, CURLINFO_HTTP_CODE);
        if($insert){
            $user=$this->session->userdata('loginUser');
             if($user['u_role'] == "admin"){ 
                redirect(base_url('all-contacts'));
             }else{
                redirect(base_url('my-contacts'));
             }
        }else{
            echo "Some thing went wrong";
        } 

    }

    public function array2xml($array, $xml = false){

        if($xml === false){
            $xml = new SimpleXMLElement('<root/>');
        }
    
        foreach($array as $key => $value){
            if(is_array($value)){
                $this->array2xml($value, $xml->addChild($key));
            } else {
                $xml->addChild($key, $value);
            }
        }
    
        return $xml->asXML();
    }

    public function update(){


        $data = array(
            'contact_id' => $this->input->post('contact_id'),
            'added_by_id' => $this->input->post('added_by_id'),
            'added_by_name' => $this->input->post('added_by_name'),
            'contact_name' => $this->input->post('contact_name'),
            'contact_email' => $this->input->post('contact_email'),
            'contact_phone' => $this->input->post('contact_phone'),
            'contact_country' => $this->input->post('contact_country'),
            'contact_type' => $this->input->post('contact_type'),
            'contact_status' => $this->input->post('contact_status'),
            'created_at' => date('Y-m-d')
        );

        $update=$this->m->update('contacts',$data,array('contact_id'=>$data['contact_id']));

        if($update){
            $user=$this->session->userdata('loginUser');
             if($user['u_role'] == "admin"){ 
                redirect(base_url('all-contacts'));
             }else{
                redirect(base_url('my-contacts'));
             }
        }else{
            echo "Some thing went wrong";
        } 

    }

    public function filter_date(){

        $date = $this->input->post('filter_date');
        $data['users']=$this->m->getAll('users',null,null,null,null,'u_id','DESC');

        if ($date != "") {
            $result = $this->m->show_data_by_date($date);
            
            if ($result) {
            $data['contacts'] = $result;
            } else {
            $data['contacts'] = "No data found";
            }
            } else {
            $data['date_error_message'] = "Date field is required";
            }
            $data = json_decode( json_encode($data), true);
                $data['date'] = $date;
                $data['page']='contacts/viewContacts';
                $this->load->view('admin/template/contents',$data);
    }
    
    function check_email_avalibility()  
    {  
         if(!filter_var($_POST["contact_email"], FILTER_VALIDATE_EMAIL))  
         {  
              echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> Invalid Email</span></label>';  
         }  
         else  
         {  
              if($this->m->is_email_available($_POST["contact_email"]))  
              {  
                   echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"> Email already in our contact list</span></label>';  
              }  
              else  
              {  
                echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> </label>';  
              }  
         }  
    } 
    public function delete(){

        $post = $this->input->post();

        $delete=$this->m->delete('tours',array('t_id'=> $post['id']));


        if ($delete)
        {
            $data = true;
        }
        else
        {
            $data = false;
        }
        echo json_encode($data);

    }

    function edit($id)
    {
        $user=$this->session->userdata('loginUser');
        $data['contact']=$this->m->getAll('contacts',null,array('contact_id'=>$id),null,true);
        $data['page']='contacts/editContact';
        $this->load->view('admin/template/contents',$data);

    }

    private function _do_upload()
    {
        $config['upload_path']          = 'assets/tours/';
        $config['allowed_types']        = 'gif|jpg|png|pdf|txt|doc|docx|jpeg|zip|xls|xlsx';
        $config['max_size']             = 1000000; //set max size allowed in Kilobyte
        $config['max_width']            = 10000; // set max width image allowed
        $config['max_height']           = 10000; // set max height allowed
 
        $this->load->library('upload', $config);
 
        if(!$this->upload->do_upload()) //upload and validate
        {
            $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); 
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

    public function changeStatus()
    {
        $user = $this->session->userdata('loginUser');
        $post = $this->input->post();
        $update=$this->m->update('tours',array('t_status'=>$post['status']),array('t_id'=>$post['id']));
        if ($update)
        {
            $data = true;
        }
        else
        {
            $data = false;
        }
        echo json_encode($data);

    }


}
