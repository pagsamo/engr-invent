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

    public function new_stocks()
    {

    }



}//Class Stocks