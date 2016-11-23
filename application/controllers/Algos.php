<?php

/**
 * Here lies my algorithm on analyzing data per month
 */
class Algos extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('items_model');
		$this->load->model('release_model');
	}


	/**
	 * get item frequency
	 * get total quantity of release items
	 * if total number of release items that month is more than frequency 
	 * then result is fast if equals then normal
	 * if lower then slow
	 */
	










}//Alogs