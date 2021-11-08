<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Works extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
    }
     public function viewAllWork($id)
    {
        $data['title'] = "View All Users";
        $user=$this->session->userdata('loginUser');        
        $data['works']=$this->m->getAll('works',null,array("uId"=>$id),null,null,'w_id','DESC');
        $data['page']='works/viewWorks';
        $this->load->view('admin/template/contents',$data);

    }

    public function addWork($id)
    {
        $data['title'] = "View All Users";
        $data['id'] = $id;
        $user=$this->session->userdata('loginUser');        
        $data['page']='works/addWork';
        $this->load->view('admin/template/contents',$data);

    }

    public function createWork(){

       
        $config['upload_path'] = 'assets/works/';
        $config['allowed_types'] = 'gif|jpg|png|pdf|txt|doc|docx|jpeg|zip|xls|xlsx';
        $config['max_size'] = 2000;
        $config['max_width'] = 1500;
        $config['max_height'] = 1500;

        $this->load->library('upload', $config);

        // if (!$this->upload->do_upload('t_feature_img')) 
		// {
        //     $error = array('error' => $this->upload->display_errors());
        // }else{
        //     $data['t_feature_img'] = $this->upload->data('file_name');
        // }

        $count = count($_FILES['before']['name']);
    
        for($i=0;$i<$count;$i++){
      
          if(!empty($_FILES['before']['name'][$i])){
      
            $_FILES['file']['name'] = $_FILES['before']['name'][$i];
            $_FILES['file']['type'] = $_FILES['before']['type'][$i];
            $_FILES['file']['tmp_name'] = $_FILES['before']['tmp_name'][$i];
            $_FILES['file']['error'] = $_FILES['before']['error'][$i];
            $_FILES['file']['size'] = $_FILES['before']['size'][$i];
    
            $config['upload_path'] = 'assets/works/';
            $config['allowed_types'] = 'gif|jpg|png|pdf|txt|doc|docx|jpeg|zip|xls|xlsx';
            $config['max_size'] = '5000';
            $config['file_name'] = $_FILES['before']['name'][$i];
     
            $this->load->library('upload',$config); 
      
            if($this->upload->do_upload('file')){
              $uploadData = $this->upload->data();
              $filename = $uploadData['file_name'];
     
              $data['before'][] = $filename;
            }
          }
     
        }

        $count = count($_FILES['after']['name']);
    
        for($i=0;$i<$count;$i++){
      
          if(!empty($_FILES['after']['name'][$i])){
      
            $_FILES['file']['name'] = $_FILES['after']['name'][$i];
            $_FILES['file']['type'] = $_FILES['after']['type'][$i];
            $_FILES['file']['tmp_name'] = $_FILES['after']['tmp_name'][$i];
            $_FILES['file']['error'] = $_FILES['after']['error'][$i];
            $_FILES['file']['size'] = $_FILES['after']['size'][$i];
    
            $config['upload_path'] = 'assets/works/';
            $config['allowed_types'] = 'gif|jpg|png|pdf|txt|doc|docx|jpeg|zip|xls|xlsx';
            $config['max_size'] = '5000';
            $config['file_name'] = $_FILES['after']['name'][$i];
     
            $this->load->library('upload',$config); 
      
            if($this->upload->do_upload('file')){
              $uploadData = $this->upload->data();
              $filename = $uploadData['file_name'];
     
              $data['after'][] = $filename;
            }
          }
     
        }

        $data = array(
            'uId' => $this->input->post('uId'),
            'w_before_explain' => $this->input->post('beforeExp'),
            'w_before' => serialize($data['before']),
            'w_after' => serialize($data['after']),
            'w_cat' => $this->input->post('w_cat')
        );
        // print_r(json_encode($data));

        $insert=$this->m->store('works',$data);

        if($insert){
                redirect(base_url('all-works'));
        }else{
            echo "Some thing went wrong";
        }

    }


    private function _do_upload()
    {
        $config['upload_path']          = 'assets/works/';
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
}
