<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_m extends CI_Model
{
    public function __construct()
    {


    }

    function fetch_data($query)
 {
    //  $user=$this->session->userdata('loginUser'); 
    //       $this->db->select("*");

    //       $this->db->from("z_docs");
    //       $this->db->where("z_folder.userId1",$user['user_id']);
    //       $this->db->join('z_users', ' z_docs.userId = z_users.user_id');
    //       $this->db->join('z_folder', ' z_users.user_id = z_folder.userId');
         
    //       if($query != '')
    //       {
          
    //       $this->db->like('doc_title', $query);
    //       $this->db->or_like('doc_cat', $query);
    //       $this->db->or_like('doc_file', $query);
    //       $this->db->or_like('doc_expire', $query);
    //       $this->db->or_like('fol_name', $query);
          
    //       }
          
    //       $this->db->order_by('doc_id', 'DESC');
    //       return $this->db->get();
    $user=$this->session->userdata('loginUser');
    $col = $user['user_id'];
          $sql="SELECT * FROM `z_docs` JOIN `z_users` ON `z_docs`.`userId` = `z_users`.`user_id` JOIN `z_folder` ON `z_users`.`user_id` = `z_folder`.`userId` WHERE `z_folder`.`userId` = '$col' AND `z_docs`.`doc_trash` = '0' AND (`doc_title` LIKE '%".$query."%' ESCAPE '!' OR `doc_cat` LIKE '%".$query."%' ESCAPE '!' OR `doc_file` LIKE '%".$query."%' ESCAPE '!' OR `doc_expire` LIKE '%".$query."%' ESCAPE '!' OR `fol_name` LIKE '%".$query."%' ESCAPE '!' ) ORDER BY `doc_id` DESC";
          $abc = $this->db->query($sql);
    return $abc->result();
 }
   
    public function show_data_by_date($date) {
        
        $this->db->select('*');
        $this->db->from('contacts');
        $this->db->where("created_at",$date);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
        return $query->result();
        } else {
        return false;
        }
        }
      

    
    /*
     * Insert data in the database
     * @param data array
     */
    public function store($tableName, $postData, $inserId = null)
    {
        $insert = $this->db->insert($tableName, $postData);
        if ($insert) {
            if (!empty($inserId)) {
                $result['id'] = $this->db->insert_id();
            }
            $result['status'] = true;
        } else {

            $result['status'] = false;
        }

        return $result;

    }

    
      function is_email_available($user_email)  
         {  
              $this->db->where('contact_email', $user_email);  
              $query = $this->db->get("contacts");  
              if($query->num_rows() > 0)  
              {  
                   return true;  
              }  
              else  
              {  
                   return false;  
              }  
         }   
       

         function is_country_exsit($country)  
         {  
              $this->db->where('p_country', $country);  
              $query = $this->db->get("prices");  
              if($query->num_rows() > 0)  
              {  
                   return true;  
              }  
              else  
              {  
                   return false;  
              }  
         }   

    public function update($tableName, $postData, $where)
    {
        $update = $this->db->where($where)->update($tableName, $postData);
        if ($update) {
            $result['status'] = true;
        } else {

            $result['status'] = false;
        }

        return $result;

    }



    public function checkIfExist($tableName, $whereArray, $getDataArray = null,$getDataRow=null)
    {

        $query = $this->db->where($whereArray)->get($tableName);

        if ($query->num_rows()) {
            $result['status'] = true;
            if (!empty($getDataArray)) {
                $result['data'] = $query->result_array();
            }
            if (!empty($getDataRow)) {
                $result['data'] = $query->row_array();
            }
        } else
            {
            $result['status'] = false;
        }

        return $result;
    }

    public function getAll($table,$fields = "*",$where = null,$numRows=null,$singleRow=null, $orderBy = null, $sort = "ASC",$groupBy=null ,$limit = null, $offset = null)
    {

        $this->db->select("$fields")->from($table);
        if (!empty($where))
            $this->db->where($where);
        if (!empty($orderBy))
            $this->db->order_by($orderBy, $sort);
        if(!empty($groupBy))
             $this->db->group_by($groupBy);
        if (!empty($limit))
            $this->db->limit($limit, $offset);

        $query=$this->db->get();
         if(!empty($numRows))
             return $query->num_rows();
        if(!empty($singleRow))
            return $query->row_array();


         return $query->result_array();

    }
    public function getAllJoins($table1,$table2,$table1Id,$table2Id,$table3=null,$table3Id=null,$tableKfId=null,$where = null,$numRows=null,$singleRow=null, $orderBy = null, $sort = "ASC",$groupBy=null ,$limit = null, $offset = null)
    {

        $this->db->select("*")->from($table1);
        $this->db->join($table2,"$table2.$table2Id=$table1.$table1Id");
        if(!empty($table3))
            $this->db->join($table3,"$table3.$table3Id=$table2.$tableKfId");

        if (!empty($where))
            $this->db->where($where);
        if (!empty($orderBy))
            $this->db->order_by($orderBy, $sort);
        if(!empty($groupBy))
            $this->db->group_by($groupBy);
        if (!empty($limit))
            $this->db->limit($limit, $offset);

        $query=$this->db->get();
        if(!empty($numRows))
            return $query->num_rows();
        if(!empty($singleRow))
            return $query->row_array();


        return $query->result_array();

    }


    public function delete($table,$where)
    {
        $delete=$this->db->where($where)->delete($table);
        if(!$delete)
            return false;

        return true;


    }
    public function updateStatus($table,$where,$status)
    {
        $delete=$this->db->where($where)->update($table,$status);
        if(!$table)
            return false;

        return true;


    }

    public function total($table,$where=null)
    {

        if(!empty($where))
        {
           return $this->db->where($where)->get($table)->num_rows();
        }
        else
        {
            return $this->db->count_all($table);
        }



    }

  public function getFields($table,$fields,$where = null,$singleField=null)
    {

        $this->db->select("$fields")->from($table);
        if (!empty($where))
            $this->db->where($where);
        $query=$this->db->get();
        if(!empty($singleField)):
            return $query->row()->$fields;
      else:
            return $query->row();

endif;

    }

 


    function countItems($table,$where=null)
    {
        $this->db->select('*');
        if($where!=null)
        {
            $this->db->where($where);
        }
        $query=$this->db->get($table);
        return $query->num_rows();

    }

    function countItemsByDate($table,$where=null,$date=null)
    {
        $this->db->select('*');
        if($where!=null)
        {
            $this->db->where($where);
        }
        if($date!=null)
        {
            $this->db->where("created_at",$date);
        }
        $query=$this->db->get($table);
        return $query->num_rows();

    }

    function countItemsByDatenStatus($table,$where=null,$date=null,$statuscheck=null)
    {
        $this->db->select('*');
        if($where!=null)
        {
            $this->db->where($where);
        }
        if($date!=null)
        {
            $this->db->where("created_at",$date);
        }
        if($statuscheck!=null)
        {
            $this->db->where($statuscheck);
        }
        $query=$this->db->get($table);
        return $query->num_rows();

    }

    function countItemsByStatus($table,$where=null,$statuscheck=null)
    {
        $this->db->select('*');
        if($where!=null)
        {
            $this->db->where($where);
        }
        if($statuscheck!=null)
        {
            $this->db->where($statuscheck);
        }
        $query=$this->db->get($table);
        return $query->num_rows();

    }
    

    function sumItems($table,$field,$where=null)
    {

        $this->db->select_sum($field)->from($table);
        if($where !=null)
        {
            $this->db->where($where);
        }
        $q=$this->db->get();
        return $q->row()->$field;
    }
    
}