<?php
class Stocks_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }//constructor


    //get stocks
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

    /**
     * [total_in_mont description]
     * @param  [type] $item_id [description]
     * @param  [type] $month   [description]
     * @param  [type] $year    [description]
     * @return [type]          [description]
     */
    public function total_in_month($item_id, $month, $year)
    {
        $dend = days_in_month($month,$year);
        $pre = $year."-".$month."-";
        $query = "SELECT SUM(quantity) ";
        $query .= " FROM stocks WHERE item_id={$item_id}";
        $query .= " AND date >= '".$pre."01'";
        $query .= " AND date <= '".$pre.$dend."'";
        $q = $this->db->query($query);
        $q2 = $q->row_array();
        return array_pop($q2);
    }//total in month


}//Class Stocks