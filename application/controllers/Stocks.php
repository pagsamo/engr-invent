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
        $data['stocks'] = $this->stocks_model->get_stocks();
        $this->load->view('templates/header');
        $this->load->view('templates/nav');
        $this->load->view('pages/stocks',$data);
        $this->load->view('templates/footer');
    }

    





}