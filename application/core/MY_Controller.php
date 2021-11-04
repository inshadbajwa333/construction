<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if(empty($this->session->userdata('loginUser')))
        {
            redirect(base_url());die;
        }
    }
    public function upload($fileName,$path,$type)
    {
        $config['upload_path'] = $path;
        $config['allowed_types'] = ($type=='file')?'gif|jpg|png|jpeg|PNG|JPG|GIF|JPEG|txt|xls|xlsx|pdf':'csv,xls,xlsx,txt,pdf';
        $config['file_name'] = date('Ymd');
        $this->load->library('upload', $config);
        $data=array();
        if (!$this->upload->do_upload($fileName)) {
            $data['result'] = false;
            $data['error'] =  $this->upload->display_errors();

        }
        else {

            $data['data']=$this->upload->data();
            $data['result'] = true;
        }
        return $data;
    }
}
