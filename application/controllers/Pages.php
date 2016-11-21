<?php

class Pages extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('items_model');
        $this->load->library('form_validation');
        $this->load->helper('form');
    }

    public function view($page = 'home')
    {
//        validation of the create item form
        if(!file_exists(APPPATH.'views/pages/'.$page.'.php'))
        {
            show_404();
        }

        $data['title'] = ucfirst($page);
        $data['items'] = $this->items_model->get_items();
        if(isset($_SESSION['info'])){
            $data['info'] = $_SESSION['info'];
            unset($_SESSION['info']);
        }
        $this->load->view('templates/header',$data);
        $this->load->view('templates/nav');
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/footer',$data);
    }


    public function view_form($form_name = FALSE)
    {
        $this->load->view('forms/'.$form_name);
    }






}