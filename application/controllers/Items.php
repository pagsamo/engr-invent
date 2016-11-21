<?php

class Items extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('items_model');
        $this->load->database();
    }


    public function lookup()
    {
        echo json_encode($this->items_model->selected_f('name, id, unit'));
    }

    public function create()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $ruleset = array(
            array(
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'unit',
                'label' => 'Unit',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'balance',
                'label' => 'Balance',
                'rules' => 'required|numeric'
            ),
            array(
                'field' => 'frequency',
                'label' => 'Frequency',
                'rules' => 'required|numeric'
            ),
            array(
                'field' => 'category',
                'label' => 'Category',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($ruleset);


        if($this->form_validation->run() === FALSE)
        {
            echo json_encode(explode('.',strip_tags(validation_errors())));
        }else{
            $this->items_model->create_item();
            $name = $this->items_model->get_last_item();
            $this->session->set_userdata('info',$name." has been added.");
            echo json_encode(array('stat'=>true));
        }
    }









}