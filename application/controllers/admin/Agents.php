<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agents extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
    }
     public function index()
    {
        $user=$this->session->userdata('loginUser');
        
              $data['page']='agents/agentTemplates';
              $this->load->view('admin/template/contents',$data);

    }

    public function changeStatusUser()
    {
        $user = $this->session->userdata('loginUser');
        $post = $this->input->post();
        $headers = array(
            "Content-type: application/json",
            "Authorization: Bearer " . $user['token'] . ""
        );
        $ch3 = curl_init();
        curl_setopt($ch3, CURLOPT_URL, $this->api_url . "/api/user/deactivate/" . $post['id']);
        curl_setopt($ch3, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch3, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch3, CURLOPT_HTTPHEADER, $headers);
        $response3 = curl_exec($ch3);
        $httpcode = curl_getinfo($ch3, CURLINFO_HTTP_CODE);
        curl_close($ch3);

        if ($httpcode == "200" or $httpcode == "201")
        {
            $data = true;
        }
        else
        {
            $data = false;
        }
        echo json_encode($data);

    }
     public function viewUserDetail($id)
    {
               $user=$this->session->userdata('loginUser');
          $headers  =  array(
            "Content-type: application/json",
            "Authorization: Bearer ".$user['token'].""
         );
              $ch4 = curl_init();
         curl_setopt($ch4, CURLOPT_URL, $this->api_url ."/api/user/get/".$id);
         curl_setopt($ch4, CURLOPT_RETURNTRANSFER, true);
         curl_setopt($ch4, CURLOPT_TIMEOUT, 10);
         curl_setopt($ch4, CURLOPT_HTTPHEADER, $headers);

         $result = curl_exec($ch4);
          curl_close($ch4);

          $json = json_decode($result, true);
          $data['view'] = $json;
          
          $ch5 = curl_init();
         curl_setopt($ch5, CURLOPT_URL, $this->api_url ."/api/review/user/".$id);
         curl_setopt($ch5, CURLOPT_RETURNTRANSFER, true);
         curl_setopt($ch5, CURLOPT_TIMEOUT, 10);
         curl_setopt($ch5, CURLOPT_HTTPHEADER, $headers);

         $result1 = curl_exec($ch5);
          curl_close($ch5);

          $json1 = json_decode($result1, true);
          $data['reviews'] = $json1;



               $data['page']='users/viewUserDetail';
               $this->load->view('admin/template/contents',$data);

    }

     public function delete($id)
    {
        $user = $this
            ->session
            ->userdata('loginUser');
        $post = $this
            ->input
            ->post();
        $headers = array(
            "Content-type: application/json",
            "Authorization: " . $user['token'] . ""
        );
        $ch3 = curl_init();
        curl_setopt($ch3, CURLOPT_URL, $this->api_url . "rest/api/v1/admin/delete/delivery/boy?id=" . $id);
        curl_setopt($ch3, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch3, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch3, CURLOPT_HTTPHEADER, $headers);
        $response3 = curl_exec($ch3);
        $httpcode = curl_getinfo($ch3, CURLINFO_HTTP_CODE);
        curl_close($ch3);

         if ($httpcode == "200" or $httpcode == "201")
        {
             $this->session->set_flashdata('category_success', 'Data Deleted Successfully', 100);
             redirect(base_url().'all-riders');
        }
        else
        {
              echo "Data faild to delete";
        }

    }

    

    public function mapviewUser() {
        $data['title'] = "View All Restaurants";
         $user=$this->session->userdata('loginUser');
             $headers  =  array(
               "Content-type: application/json",
               "Authorization: Bearer ".$user['token'].""
            );
   
         header("Access-Control-Allow-Origin: *");
           $ch = curl_init();
   
           curl_setopt($ch, CURLOPT_PROXY, $this->api_url); //your proxy url
           curl_setopt($ch, CURLOPT_URL, $this->api_url."/api/user/all");
           curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
           curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
           curl_setopt($ch, CURLOPT_TIMEOUT, 10);
           curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
   
            if(curl_exec($ch) === FALSE)
        {
            die("Curl failed: " . curl_error($ch));  // Never goes here
        }
   
           $result = curl_exec($ch);
           $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
   
            curl_close($ch);
   
            $json = json_decode($result, true);
   
            $alld = array();
                  foreach($json as $value){
   
            $alld[] = $value;
   
                  }
                 
                   $markers = [];
       $infowindow = [];
                 foreach($alld as $data => $value){
       if(is_array($value)):
         foreach($value as $data1){
             foreach($data1['addresses'] as $data2){
              $markers[] = [
            $data2['lat'], $data2['lng']
         ];
   
         $infowindow[] = [
         ""
         ];
         }
         }
         endif;
                 }
   
       $location['markers'] = json_encode($markers);
       $location['infowindow'] = json_encode($infowindow);
   
       $this->load->view('admin/users/usersmap',$location);
       }

        public function addNew()
    {
        
        $data['page'] = 'users/addUser';
        $this
            ->load
            ->view('admin/template/contents', $data);

    }

    public function createUser(){

       
        $config['upload_path'] = 'assets/users/';
        $config['allowed_types'] = 'gif|jpg|png|pdf|txt|doc|docx|jpeg|zip|xls|xlsx';
        $config['max_size'] = 2000;
        $config['max_width'] = 1500;
        $config['max_height'] = 1500;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('u_img')) 
		{
            $error = array('error' => $this->upload->display_errors());
        }else{
            $data['u_img'] = $this->upload->data('file_name');
        }

        $data = array(
            'u_name' => $this->input->post('u_name'),
            'u_email' => $this->input->post('u_email'),
            'u_password' => $this->input->post('u_password'),
            'u_img' => $data['u_img'],
            'u_role' => $this->input->post('u_role'),
            'u_status' => 1,
        );

        $insert=$this->m->store('users',$data);

        if($insert){
                redirect(base_url('all-users'));
        }else{
            echo "Some thing went wrong";
        }

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
    function edit($id)
    {
        $user=$this->session->userdata('loginUser');
        $data['user']=$this->m->getAll('users',null,array('u_id'=>$id),null,true);
        $data['page']='users/editUser';
        $this->load->view('admin/template/contents',$data);

    }

    public function update(){

       
        $config['upload_path'] = 'assets/users/';
        $config['allowed_types'] = 'gif|jpg|png|pdf|txt|doc|docx|jpeg|zip|xls|xlsx';
        $config['max_size'] = 2000;
        $config['max_width'] = 1500;
        $config['max_height'] = 1500;

        $this->load->library('upload', $config);
        $post = $this->input->post();
        if(!empty($post['u_img'])){           

        if (!$this->upload->do_upload('u_img')) 
		{
            $error = array('error' => $this->upload->display_errors());
        }else{
            $data['u_img'] = $this->upload->data('file_name');
        }
    }else{
        $data['u_img'] = $post['old_img'];
    }

        $data = array(
            'u_name' => $this->input->post('u_name'),
            'u_email' => $this->input->post('u_email'),
            'u_password' => $this->input->post('u_password'),
            'u_img' => $data['u_img'],
            'u_role' => $this->input->post('u_role'),
            'u_status' => 1,
        );
        $update=$this->m->update('users',$data);

        if($update){
                redirect(base_url('all-users'));
        }else{
            echo "Some thing went wrong";
        }

    }



}
