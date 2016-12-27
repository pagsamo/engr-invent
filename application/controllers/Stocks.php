<?php

class Stocks extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('stocks_model');
        $this->load->model('items_model');
        $this->load->model('lookup_model');
        $this->load->database();
        $this->load->library('form_validation');
        $this->load->helper('form');
    }


    public function view()
    {
        $data['cats'] = $this->lookup_model->look('category');
        if(isset($_SESSION['info'])){
            $data['info'] = $_SESSION['info'];
            unset($_SESSION['info']);
        }
        $data['stocks'] = $this->stocks_model->get_stocks();
        $this->load->view('templates/header');
        $this->load->view('templates/nav');
        $this->load->view('pages/stocks',$data);
        $this->load->view('templates/footer');
    }

    /**
     * [selected description]
     * @param  [date] $start    [description]
     * @param  [end] $end      [description]
     * @param  [string] $category [description]
     * @return [array]           [api]
     */
    public function selected($start,$end,$category)
    {
        print_r($this->stocks_model->stocks_range($start, $end, $category));
    }


    public function new_stocks()
    {
        $ruleset = array(
            array(
                'field' => 'item_name',
                'label' => 'Item name',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'rp_number',
                'label' => 'RP Number',
                'rules' => 'trim|required|numeric'
            ),
            array(
                'field' => 'amount',
                'label' => 'amount',
                'rules' => 'required|numeric|trim'
            ),
            array(
                'field' => 'supplier',
                'label' => 'supplier',
                'rules' => 'required|trim'
            ),
            array(
                'field' => 'purpose',
                'label' => 'purpose',
                'rules' => 'required'
            ),
            array(
                'field' => 'date',
                'label' => 'Date',
                'rules' => 'required|trim'
            )
        );
        $this->form_validation->set_rules($ruleset);
        if($this->form_validation->run() === FALSE)
        {
            echo json_encode(explode('.',strip_tags(validation_errors())));
        }else{
            $i = $this->input->post('item_id');
            $q = $this->input->post('quantity');
            $start = $this->items_model->get_items($i);
            $total = (int)$start['balance'] + (int)$q;
            $this->db->trans_start();
                $this->items_model->update_balance($i,$total);
                $this->stocks_model->new_stocks();
            $this->db->trans_complete();
            $s = $this->stocks_model->get_last('item_name as i, quantity as q, unit as u');
            $this->session->set_userdata('info',$s['q']." ".$s['u']."s of ".$s['i']." has been added to the stocks.");
            echo json_encode(array('stat'=>true));
        }
    }//new stocks
   





}