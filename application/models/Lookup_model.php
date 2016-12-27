<?php

Class Lookup_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	/**
	 * [categories description]
	 * @return [type] [description]
	 */
	public function look($tb_name = null)
	{
		if($tb_name == null)
		{
			$query = $this->db->get('category');
			return $query->result_array();	
		}
		$query = $this->db->get($tb_name);
		return $query->result_array();
	}//categories


}//class declaration