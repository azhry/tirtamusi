<?php

/**
* 
*/
class Alum_m extends MY_Model
{
	
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name'] = 'alum';
		$this->data['primary_key'] = 'id_alum';
	}

	public function get_first()
	{
		$this->db->select('*');
		$this->db->from($this->data['table_name']);
		$query = $this->db->get();
		return $query->row();
	}
}