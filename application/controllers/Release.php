<?php
class Release extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('release_model');
        $this->load->model('items_model');
        $this->load->model('lookup_model');
        $this->load->library('form_validation');
        $this->load->helper('form');
    }//construct



    public function view()
    {
        if(isset($_SESSION['info'])){
            $data['info'] = $_SESSION['info'];
            unset($_SESSION['info']);
        }
        $data['cats'] = $this->lookup_model->look('category');
        $data['release'] = $this->release_model->get_releases();
        $this->load->view('templates/header');
        $this->load->view('templates/nav');
        $this->load->view('pages/release',$data);
        $this->load->view('templates/footer');
    }




    public function new_release()
    {
        $ruleset = array(
            array(
                'field' => 'item_name',
                'label' => 'Item',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'rm_number',
                'label' => 'RM Number',
                'rules' => 'trim|required|numeric'
            ),
            array(
                'field' => 'item_id',
                'label' => 'Item',
                'rules' => 'trim|required|numeric'
            ),
            array(
                'field' => 'quantity',
                'label' => 'Quantity',
                'rules' => 'required|numeric|trim'
            ),
            array(
                'field' => 'requested_by',
                'label' => 'Requested by',
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
            $item_id = $this->input->post('item_id');
            $item_name = $this->input->post('item_name');
            $errors = explode('.',strip_tags(validation_errors()));
            array_pop($errors);
            if($item_id == "" || $item_id == null){
                if($item_name != "" || $item_name != null)
                {
                 array_push($errors, "You cannot add \"".$item_name."\" for it is not registered in the database.");
                }
            }
            echo json_encode($errors);
        }else{

            $i = $this->input->post('item_id');
            $q = $this->input->post('quantity');
            $start = $this->items_model->get_items($i);
            $total = (int)$start['balance'] - (int)$q;
            $this->db->trans_start();
            $this->items_model->update_balance($i,$total);
            $this->release_model->new_release();
            $this->db->trans_complete();
            $r = $this->release_model->get_last('item_name as i, quantity as q, unit as u');
            $this->session->set_userdata('info',$r['q']." ".$r['u']."s of ".$r['i']." has been released from the stocks.");
            echo json_encode(array('stat'=>true));
        }
    }//new_release


}//class release