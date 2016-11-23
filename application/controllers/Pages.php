<?php

class Pages extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('items_model');
        $this->load->model('release_model');
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
        $data['items'] = $this->analyzing();
        if(isset($_SESSION['info'])){
            $data['info'] = $_SESSION['info'];
            unset($_SESSION['info']);
        }
        $this->load->view('templates/header',$data);
        $this->load->view('templates/nav');
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/footer',$data);
    }

    //algos for analyzing
    public function algos($id,$month,$year)
    {
        $i = $this->items_model->get_items($id);
        $total = $this->release_model->total_in_month($id,$month,$year);
        if($total > $i['frequency'])
        {
            return "FAST";
        }elseif($total == $i['frequency'])
        {
            return 'NORMAL';
        }else{
            return 'SLOW';
        }
    }//algos


    // analyzing
    public function analyzing($month,$year)
    {
        $items = $this->items_model->get_items();
        foreach($items as $i)
        {
            $v = $this->algos($i['id'],$month,$year);
            array_push($i,$v);
            echo $i[0].'<br/>';
        }
        return $items;
    }//analyzing






}