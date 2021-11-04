<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Blogs extends MY_Controller {



    public function __construct()

    {

        parent::__construct();


    }
    public function index()

    {
      $data['nblogs']=$this->m->getAll('allblogs','*',null,null,null,'nb_id','DESC',null);
      $data['page']='blogs/viewAllBlogs';
      $this->load->view('theme/template/contents',$data);
      
    }


    public function addBlog()

    {
      
      $data['page']='blogs/addBlog';
      $this->load->view('theme/template/contents',$data);
      
    }


    public function editBlog($id)

    {
     $data['b']=$this->m->getAll('allblogs',null,array('nb_id'=>$id),null,true);
      $data['page']='blogs/editBlog';
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

        if (!$this->upload->do_upload('nb_feature_img')) 
		{
            $error = array('error' => $this->upload->display_errors());
        }else{
            $data['nb_feature_img'] = $this->upload->data('file_name');
        }


       

        $data = array(
            'nb_title_en' => $this->input->post('nb_title_en'),
            'nb_title_ar' => $this->input->post('nb_title_ar'),
            'nb_short_text_en' => $this->input->post('nb_short_text_en'),
            'nb_short_text_ar' => $this->input->post('nb_short_text_ar'),
            'nb_permalink' => $this->input->post('nb_permalink'),
            'nb_desc_en' => $this->input->post('nb_desc_en'),
            'nb_desc_ar' => $this->input->post('nb_desc_ar'),
            'nb_meta_title_en' => $this->input->post('nb_meta_title_en'),
            'nb_meta_title_ar' => $this->input->post('nb_meta_title_ar'),
            'nb_meta_desc_en' => $this->input->post('nb_meta_desc_en'),
            'nb_meta_desc_ar' => $this->input->post('nb_meta_desc_ar'),
            'nb_published_by' => $this->input->post('nb_published_by'),
            'nb_published_date' => $this->input->post('nb_published_date')
        );

        $insert=$this->m->store('allblogs',$data);

        if($insert){
                redirect(base_url('add-blog'));
        }else{
            echo "Some thing went wrong";
        }
    
      
    }

    public function updateBlog()

    {
        $post = $this->input->post();
        $config['upload_path'] = 'assets/blogs/';
        $config['allowed_types'] = 'gif|jpg|png|pdf|txt|doc|docx|jpeg|zip|xls|xlsx';
        $config['max_size'] = 2000;
        $config['max_width'] = 1500;
        $config['max_height'] = 1500;

        $this->load->library('upload', $config);


        
            if(!empty($post['nb_feature_img'])){           

                if (!$this->upload->do_upload('nb_feature_img')) 
                {
                    $error = array('error' => $this->upload->display_errors());
                }else{
                    $data['nb_feature_img'] = $this->upload->data('file_name');
                }
            }else{
                $data['nb_feature_img'] = $this->input->post('old_img');
            }

            

        $data = array(
            'nb_id' => $this->input->post('nb_id'),
            'nb_title_en' => $this->input->post('nb_title_en'),
            'nb_title_ar' => $this->input->post('nb_title_ar'),
            'nb_short_text_en' => $this->input->post('nb_short_text_en'),
            'nb_short_text_ar' => $this->input->post('nb_short_text_ar'),
            'nb_permalink' => $this->input->post('nb_permalink'),
            'nb_feature_img' => $data['nb_feature_img'],
            'nb_desc_en' => $this->input->post('nb_desc_en'),
            'nb_desc_ar' => $this->input->post('nb_desc_ar'),
            'nb_meta_title_en' => $this->input->post('nb_meta_title_en'),
            'nb_meta_title_ar' => $this->input->post('nb_meta_title_ar'),
            'nb_meta_desc_en' => $this->input->post('nb_meta_desc_en'),
            'nb_meta_desc_ar' => $this->input->post('nb_meta_desc_ar'),
            'nb_published_by' => $this->input->post('nb_published_by'),
            'nb_published_date' => $this->input->post('nb_published_date')
        );

        $update=$this->m->update('allblogs',$data,array('nb_id'=>$data['nb_id']));

        if($update){
                redirect(base_url('all-blogs'));
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
 
        if(!$this->upload->do_upload($name)) //upload and validate
        {
            $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); 
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

}
