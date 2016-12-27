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


    /**
     * [stocks_range description]
     * Filter stocks by item, month, year, category or only item
     * The current month and all items are shown by default
     * @param  [type] $month    [description]
     * @param  [type] $year     [description]
     * @param  [type] $category [description]
     * @param  [type] $item_id  [description]
     * @return [type]           [description]
     */
    public function stocks_range($start=null, $end=null, $category=null, $item_id=null)
    {
        //get last day of month
        $start = $start==null?month_default()[0]:$start;
        $end = $end==null?month_default()[1]:$end;
        $query = 'SELECT * FROM ';
        $query .= 'stocks ';
        $query .= 'WHERE date >= "'.$start.'" ';
        $query .= 'AND date <= "'.$end.'" ';
        if($category!=null)
        {
            $query .= 'AND item_category = "'.$category.'"';
            $q = $this->db->query($query);
            $q2 = $q->result_array();
            return $q2;
        }
        if($item_id!=null)
        {
            $query .= 'AND item_id = "'.$item_id.'"';
            $q = $this->db->query($query);
            $q2 = $q->result_array();
            return $q2;
        }
        $q = $this->db->query($query);
        $q2 = $q->result_array();
        return $q2;
    }//stocks_range_selection

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
     * @param  [int] $item_id [description]
     * @param  [int] $month   [description]
     * @param  [int] $year    [description]
     * @return [int]          [description]
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