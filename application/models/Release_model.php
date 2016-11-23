<?php
class Release_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }


    public function get_releases()
    {
        $query  = $this->db->get('release');
        return $query->result_array();
    }//get releases


    public function new_release()
    {
        $this->db->insert('release',$this->input->post());
    }//new release


    public function get_last($string_of_fields = 'item_name'){
        $this->db->select($string_of_fields);
        $this->db->from('release');
        $this->db->order_by('id','DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }//get last stock


}//release model