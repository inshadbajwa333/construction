<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Pages extends MY_Controller {



    public function __construct()

    {

        parent::__construct();


    }
    public function index()

    {
      $data['blogs']=$this->m->getAll('blogs','*',null,null,null,'b_id','DESC',null);
      $data['page']='pages/viewAllPages';
      $this->load->view('theme/template/contents',$data);
      
    }


    public function addPage()

    {
      
      $data['page']='pages/addPage';
      $this->load->view('theme/template/contents',$data);
      
    }


    public function editPage($id)

    {
     $data['b']=$this->m->getAll('blogs',null,array('b_id'=>$id),null,true);
      $data['page']='pages/editPage';
      $this->load->view('theme/template/contents',$data);
      
    }

    public function storePage()

    {
        $data = $this->input->post();
        $config['upload_path'] = 'assets/blogs/';
        $config['allowed_types'] = 'gif|jpg|png|pdf|txt|doc|docx|jpeg|zip|xls|xlsx';
        $config['max_size'] = 2000;
        $config['max_width'] = 1500;
        $config['max_height'] = 1500;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('b_feature_img')) 
		{
            $error = array('error' => $this->upload->display_errors());
        }else{
            $data['b_feature_img'] = $this->upload->data('file_name');
        }


       

        $data = array(
            'b_title_en' => $this->input->post('b_title_en'),
            'b_title_ar' => $this->input->post('b_title_ar'),
            'b_permalink' => $this->input->post('b_permalink'),
            'b_feature_img' => $data['b_feature_img'],
            'b_desc_en' => $this->input->post('b_desc_en'),
            'b_desc_ar' => $this->input->post('b_desc_ar'),
            'b_meta_title_en' => $this->input->post('b_meta_title_en'),
            'b_meta_title_ar' => $this->input->post('b_meta_title_ar'),
            'b_meta_desc_en' => $this->input->post('b_meta_desc_en'),
            'b_meta_desc_ar' => $this->input->post('b_meta_desc_ar')
        );
       

        $insert=$this->m->store('blogs',$data);

        if($insert){
                redirect(base_url('add-page'));
        }else{
            echo "Some thing went wrong";
        }
    
      
    }

    public function updatePage()

    {
        $post = $this->input->post();
        $config['upload_path'] = 'assets/blogs/';
        $config['allowed_types'] = 'gif|jpg|png|pdf|txt|doc|docx|jpeg|zip|xls|xlsx';
        $config['max_size'] = 2000;
        $config['max_width'] = 1500;
        $config['max_height'] = 1500;

        $this->load->library('upload', $config);


        
            if(!empty($post['b_feature_img'])){           

                if (!$this->upload->do_upload('b_feature_img')) 
                {
                    $error = array('error' => $this->upload->display_errors());
                }else{
                    $data['b_feature_img'] = $this->upload->data('file_name');
                }
            }else{
                $data['b_feature_img'] = $this->input->post('old_img');
            }

            

        $data = array(
            'b_id' => $this->input->post('b_id'),
            'b_title_en' => $this->input->post('b_title_en'),
            'b_title_ar' => $this->input->post('b_title_ar'),
            'b_permalink' => $this->input->post('b_permalink'),
            'b_feature_img' => $data['b_feature_img'],
            'b_desc_en' => $this->input->post('b_desc_en'),
            'b_desc_ar' => $this->input->post('b_desc_ar'),
            'b_meta_title_en' => $this->input->post('b_meta_title_en'),
            'b_meta_title_ar' => $this->input->post('b_meta_title_ar'),
            'b_meta_desc_en' => $this->input->post('b_meta_desc_en'),
            'b_meta_desc_ar' => $this->input->post('b_meta_desc_ar')
        );

        $update=$this->m->update('blogs',$data,array('b_id'=>$data['b_id']));

        if($update){
                redirect(base_url('all-pages'));
        }else{
            echo "Some thing went wrong";
        }

      
    }

    public function deletePrices($country){

      $post = $this->input->post();

      $delete=$this->m->delete('prices',array('p_country'=> $country));

      $data['prices']=$this->m->getAll('prices','*',null,null,null,'p_id','DESC','p_country');
      $data['page']='allPrices';
      $this->load->view('theme/template/contents',$data);

  }

    private function _do_upload()
    {
        $config['upload_path']          = 'assets/blogs/';
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
