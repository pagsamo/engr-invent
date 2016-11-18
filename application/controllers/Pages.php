<?php

class Pages extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('items_model');
    }

    public function view($page = 'home')
    {
//        validation of the create item form
        $this->load->library('form_validation');
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
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/footer',$data);
    }
}