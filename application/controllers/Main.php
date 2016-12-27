<?php

class Main extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('items_model');
        $this->load->model('release_model');
        $this->load->model('lookup_model');
        $this->load->model('stocks_model');
        $this->load->library('form_validation');
        $this->load->helper('form');
    }

    //view
    public function view($month=null,$year=null,$cat=null)
    {
        $data['m'] = $month == null?default_now()[1]:$month;
        $data['y'] = $year == null?default_now()[0]:$year;
        $data['c'] = $cat == null?'ALL':$cat;
        $data['cats'] = $this->lookup_model->look();
        $data['items'] = $this->analyzing($month,$year,$cat);
        if(isset($_SESSION['info'])){
            $data['info'] = $_SESSION['info'];
            unset($_SESSION['info']);
        }
        $this->load->view('templates/header',$data);
        $this->load->view('templates/nav');
        $this->load->view('pages/home', $data);
        $this->load->view('templates/footer',$data);
    }//view

    //algos for analyzing
    public function algos($id,$month,$year)
    {

        $i = $this->items_model->get_items($id);
        $total = $this->release_model->total_in_month($id,$month,$year);
        $total = $total == 0 ? 0:$total; 
        if($total > $i['frequency'])
        {
            return array($total, "FAST");
        }elseif($total == $i['frequency'])
        {
            return array($total, 'NORMAL');
        }else{
            return array($total, 'SLOW');
        }
    }//algos


    // analyzing
    public function analyzing($month=null,$year=null,$cat=null)
    {
        if($month == null && $year == null)
        {
            $month = default_now()[1];
            $year = default_now()[0];
        }
        if($cat === null || $cat == "ALL" || $cat == "all"){
            $items = $this->items_model->get_items();
        }else{
            $items = $this->items_model->get_items_by_cat($cat);
        }
        $all = [];
        foreach($items as $i)
        {
            $v = $this->algos($i['id'],$month,$year);
            array_push($i,$v);
            array_push($all,$i);
        }
        return $all;
    }//analyzing

    
    /**
     * test placeholder
     * @return [type] [description]
     */
    public function test()
    {
        print_r($this->stocks_model->stocks_range('2016-10-01','2016-12-31','ELECTRICAL'));
    }//test



}//class declaration