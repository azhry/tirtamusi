<?php

class Parameter_uji_m extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']	='parameter_uji';
		$this->data['primary_key']	='id_parameter';
	}
	public function get_pengujian()
	{
		$query = $this->db->query('SELECT AVG(dosis_alum) AS avg_dosis_alum, AVG(turb) AS avg_turb, tanggal FROM parameter_uji GROUP BY tanggal ORDER BY tanggal ASC');
		return $query->result();
	}

	public function get_pengujian2() {
		$query = $this->db->query('SELECT * FROM rata_rata_revisi ORDER BY hari_ke ASC');
		return $query->result();	
	}

	public function get_pengujian3() {
		$query = $this->db->query('SELECT * FROM rata_rata_revisi ORDER BY turb ASC');
		return $query->result();	
	}

	public function get_rekap_pengujian($cond ='') {

		$this->db->select('*, SUM(dosis_alum) AS total_alum, MONTH(tanggal) AS bulan, YEAR(tanggal) AS tahun');
		$this->db->from($this->data['table_name']);
		$this->db->group_by( 'MONTH(tanggal)');

		if ( (is_array($cond) && count($cond) > 0) or (is_string($cond) && strlen($cond) >= 3 ) )
		{
			$this->db->where($cond);
			$query = $this->db->get();
			return $query->row();
		}

		$query = $this->db->get();
		return $query->result();
	} 

}