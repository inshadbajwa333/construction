<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tours extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
    }
     public function index()
    {
      $user=$this->session->userdata('loginUser');
        
      $data['tours']=$this->m->getAll('tours',null,null,null,null,'t_id','DESC');
              $data['page']='tours/viewTours';
              $this->load->view('admin/template/contents',$data);

    }

    public function addNewTour(){
        $user=$this->session->userdata('loginUser');
         
        $data['page'] = 'tours/addTour';
        $this->load->view('admin/template/contents',$data);
    }

    public function createTour(){

       
        $config['upload_path'] = 'assets/tours/';
        $config['allowed_types'] = 'gif|jpg|png|pdf|txt|doc|docx|jpeg|zip|xls|xlsx';
        $config['max_size'] = 2000;
        $config['max_width'] = 1500;
        $config['max_height'] = 1500;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('t_feature_img')) 
		{
            $error = array('error' => $this->upload->display_errors());
        }else{
            $data['t_feature_img'] = $this->upload->data('file_name');
        }

        $count = count($_FILES['t_images']['name']);
    
        for($i=0;$i<$count;$i++){
      
          if(!empty($_FILES['t_images']['name'][$i])){
      
            $_FILES['file']['name'] = $_FILES['t_images']['name'][$i];
            $_FILES['file']['type'] = $_FILES['t_images']['type'][$i];
            $_FILES['file']['tmp_name'] = $_FILES['t_images']['tmp_name'][$i];
            $_FILES['file']['error'] = $_FILES['t_images']['error'][$i];
            $_FILES['file']['size'] = $_FILES['t_images']['size'][$i];
    
            $config['upload_path'] = 'assets/tours/';
            $config['allowed_types'] = 'gif|jpg|png|pdf|txt|doc|docx|jpeg|zip|xls|xlsx';
            $config['max_size'] = '5000';
            $config['file_name'] = $_FILES['t_images']['name'][$i];
     
            $this->load->library('upload',$config); 
      
            if($this->upload->do_upload('file')){
              $uploadData = $this->upload->data();
              $filename = $uploadData['file_name'];
     
              $data['t_images'][] = $filename;
            }
          }
     
        }

        $data = array(
            't_title' => $this->input->post('t_title'),
            't_ar_title' => $this->input->post('t_ar_title'),
            't_type' => $this->input->post('t_type'),
            't_duration' => $this->input->post('t_duration'),
            't_location' => $this->input->post('t_location'),
            't_desc' => $this->input->post('t_desc'),
            't_ar_desc' => $this->input->post('t_ar_desc'),
            't_price' => $this->input->post('t_price'),
            't_child_price' => $this->input->post('t_child_price'),
            't_infant_price' => $this->input->post('t_infant_price'),
            't_adult_cost_price' => $this->input->post('t_adult_cost_price'),
            't_child_cost_price' => $this->input->post('t_child_cost_price'),
            't_infant_cost_price' => $this->input->post('t_infant_cost_price'),
            't_meta_title' => $this->input->post('t_meta_title'),
            't_meta_slug' => $this->input->post('t_meta_slug'),
            't_meta_keyword' => $this->input->post('t_meta_keyword'),
            't_meta_desc' => $this->input->post('t_meta_desc'),
            't_feature_img' => $data['t_feature_img'],
            't_images' => serialize($data['t_images'])
        );
        // print_r(json_encode($data));

        $insert=$this->m->store('tours',$data);

        if($insert){
                redirect(base_url('all-tours'));
        }else{
            echo "Some thing went wrong";
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
