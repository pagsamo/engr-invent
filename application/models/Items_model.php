<?php
class Items_model extends  CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    //get items
    public function get_items($id = FALSE)
    {
        if($id  === FALSE )
        {
            $query = $this->db->get('item');
            return $query->result_array();
        }
        $query = $this->db->get_where('item',array('id'=>$id));
        return $query->row_array();

    }//get items


    public function get_items_by_cat($cat=FALSE)
    {
        if($cat === FALSE)
        {
            return $this->get_items();
        }
        $query = $this->db->get_where('item',array('category'=>$cat));
        return $query->result_array();
    }


    //selected fields
    public function selected_f($string_of_values = 'name, id')
    {
        $this->db->select($string_of_values);
        $this->db->from('item');
        $this->db->order_by('name','DESC');
        $query = $this->db->get();
        return $query->result_array();
    }//selected fields

    //get last item
    public function get_last_item(){
        $this->db->select('name');
        $this->db->from('item');
        $this->db->order_by('id','DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array()['name'];
    }//get last item

    //add to quantity of item added stocks
    public function update_balance($id = null, $q = 0)
    {
        $this->db->set('balance', $q);
        $this->db->where('id', $id);
        $this->db->update('item');
    }//update balance

    //create new item
    public function create_item()
    {
        $this->db->insert('item',$this->input->post());
    }//create new item





}