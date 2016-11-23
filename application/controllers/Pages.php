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

    public function view($month=null,$year=null)
    {
        if($month == null && $year == null)
        {
            $month = $this->dater()[0];
            $year = $this->dater()[1];
        }
        $data['items'] = $this->analyzing($month,$year);
        if(isset($_SESSION['info'])){
            $data['info'] = $_SESSION['info'];
            unset($_SESSION['info']);
        }
        $this->load->view('templates/header',$data);
        $this->load->view('templates/nav');
        $this->load->view('pages/home', $data);
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
        $all = [];
        foreach($items as $i)
        {
            $v = $this->algos($i['id'],$month,$year);
            array_push($i,$v);
            array_push($all,$i);
        }
        return $all;
    }//analyzing


    public function dater()
    {
        date_default_timezone_set('Asia/Manila');
        $c = mdate('%m-%Y',now());
        $a = explode('-',$c);
        return $a;
    }



}