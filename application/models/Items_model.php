<?php
class Items_model extends  CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_items($id = FALSE)
    {
        if($id  === FALSE )
        {
            $query = $this->db->get('item');
            return $query->result_array();
        }

        $query = $this->db->get_where('id',array('id'=>$id));
        return $query->row_array();

    }

    public function get_last_item(){
        $this->db->select('name');
        $this->db->from('item');
        $this->db->order_by('id','DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array()['name'];
    }

    public function create_item()
    {
        $this->db->insert('item',$this->input->post());
    }





}