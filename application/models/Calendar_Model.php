<?php

class Calendar_Model extends CI_Model 
{

    public function get_events($start, $id) 
    {
        return $this->db
            ->where("start >=", $start)
            ->where("userId", $id)
            ->get("calendar_events");
    }

    public function get_docs($start, $id) 
    {
        return $this->db
            ->where("doc_expire >=", $start)
            ->where("userId", $id)
            ->get("z_docs");
    }

       public function get_todo($start, $id) 
    {
        return $this->db
            ->where("created_at >=", $start)
            ->where("userId", $id)
            ->where("status ", 0)
            ->get("todos");
    }

    public function add_event($data) 
    {
        $this->db->insert("calendar_events", $data);
    }

    public function get_event($id) 
    {
        return $this->db->where("ID", $id)->get("calendar_events");
    }

    public function update_event($id, $data) 
    {
        $this->db->where("ID", $id)->update("calendar_events", $data);
    }

    public function delete_event($id) 
    {
        $this->db->where("ID", $id)->delete("calendar_events");
    }

}

?>