<?php

class Stocks extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('stocks_model');
        $this->load->database();
        $this->load->library('form_validation');
        $this->load->helper('form');
    }


    public function view()
    {
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
            $this->stocks_model->new_stocks();
            $s = $this->stocks_model->get_last('item_name, quantity');
            $this->session->set_userdata('info',$s['item_name']." x ".$s['quantity']." has been added to the stocks.");
            echo json_encode(array('stat'=>true));
        }
    }//new stocks
   





}