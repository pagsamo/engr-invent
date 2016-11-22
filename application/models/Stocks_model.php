<?php
class Stocks_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }//constructor


    public function get_stocks()
    {
        $query  = $this->db->get('stocks');
        return $query->result_array();

    }//get_stocks

    //new stock form input
    public function new_stocks()
    {
        $this->db->insert('stocks',$this->input->post());
    }//new stock form input

    //get last stock
    public function get_last($string_of_fields = 'item_name'){
        $this->db->select($string_of_fields);
        $this->db->from('stocks');
        $this->db->order_by('id','DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }//get last stock


}//Class Stocks