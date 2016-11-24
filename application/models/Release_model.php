<?php
class Release_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
        $this->load->helper('date');
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



    // get last release
    public function get_last($string_of_fields = 'item_name'){
        $this->db->select($string_of_fields);
        $this->db->from('release');
        $this->db->order_by('id','DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }//get last stock

  
  //total in month
  public function total_in_month($item_id,$month,$year)
  {
    $dend = days_in_month($month,$year);
    $pre = $year."-".$month."-";
    $query = "SELECT SUM(quantity) ";
    $query .= " FROM release WHERE item_id={$item_id}";
    $query .= " AND date >= '".$pre."01'";
    $query .= " AND date <= '".$pre.$dend."'";
    $q = $this->db->query($query);
    $q2 = $q->row_array();
    if(empty($q2))
    {
        return '0';
    }else{
        return array_pop($q2);
    }
  }//total in month


 



}//release model