<?php

class Regresi_m extends MY_Model
{
	private $X;
	private $y;

	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']	='parameter_uji';
		$this->data['primary_key']	='id_parameter';
	}

	public function set_variable($x,$y)
	{
		$this->x = $x;
		$this->y = $y;
		$this->db->query( "DROP VIEW IF EXISTS rata_rata_revisi" );
		$this->db->query( "CREATE VIEW rata_rata_revisi AS SELECT DATE_FORMAT(tanggal, '%d') AS hari_ke, AVG(turb) AS turb, AVG(dosis_alum) AS dosis_alum FROM `parameter_uji` GROUP BY DATE_FORMAT(tanggal, '%d') ORDER BY DATE_FORMAT(tanggal, '%d') ASC" );
		$this->data['table_name'] = 'rata_rata_revisi';
	}

	public function total($field, $cond ='',$group_by = '')
	{
		if ($field == 'tanggal')
		{
			$this->db->select('SUM(UNIX_TIMESTAMP(' .$field . ')) AS "' .$field . '"');
		}
		else
		{
			$this->db->select('SUM(' . $field . ') AS "' . $field . '"');
		}
		$this->db->from($this->data['table_name']);
		if((is_array($cond) && count($cond) > 0) or (is_string($cond) && strlen($cond) > 3))
			$this->db->where($cond);
		if(strlen($group_by) > 0)
			$this->db->group_by($group_by);
		$query = $this->db->get();
		return $query->row();
	}

	public function count($field, $cond ='',$group_by = '')
	{
		$this->db->select('SELECT COUNT(' .$field. ') AS "'.$field.'"');
		$this->db->from($this->data['table_name']);
		if((is_array($cond) && count($cond) >0) or (is_string($cond) && strlen($cond) > 3))
			$this->db->where($cond);
		if(strlen($group_by) > 0)
			$this->db->group_by($group_by);
		$query = $this->db->get();
		return $query->row();
	}
	public function avg($field, $cond ='',$group_by = '')
	{
		$this->db->select('SELECT AVG(' .$field. ') AS "'.$field.'"');
		$this->db->from($this->data['table_name']);
		if((is_array($cond) && count($cond) >0) or(is_string($cond) && strlen($cond) > 3))
			$this->db->where($cond);
		if(strlen($group_by) > 0)
			$this->db->group_by($group_by);
		$query = $this->db->get();
		return $query->row();
	}

	public function total_ab($field_a, $field_b, $cond = '', $group_by = '')
	{
		// if ($field_a == 'tanggal')
		// {
		// 	$this->db->select('SUM(UNIX_TIMESTAMP(' . $field_a . ') * ' . $field_b . ')AS result');
		// }
		// else if ($field_b =='tanggal')
		// {
			$this->db->select('SUM(' . $field_a . ' * ' . $field_b . ') AS result');
		// }

		$this->db->from($this->data['table_name']);
		if((is_array($cond) && count($cond) >0) or(is_string($cond) && strlen($cond) > 3))
			$this->db->where($cond);
		if(strlen($group_by) > 0)
			$this->db->group_by($group_by);
		$query = $this->db->get();
		return $query->row();
	}

	public function total_squared($field, $cond= '', $group_by='')
	{
		if ($field == 'tanggal')
		{
			$this->db->select('SUM(UNIX_TIMESTAMP(' . $field . ') * UNIX_TIMESTAMP(' .$field . ')) AS ' . $field);
		}
		else
		{
			$this->db->select('SUM(' . $field . ' * ' . $field . ') AS ' .$field);
		}
		$this->db->from($this->data['table_name']);
		if((is_array($cond) && count($cond) > 0) or (is_string($cond) && strlen($cond) > 3))
			$this->db->where($cond);
		if(strlen($group_by) > 0)
			$this->db->get();
		$query = $this->db->get();
		return $query->row();
	}

	public function get_a($x, $y)
	{
		$num_rows = count($this->get());
		return ($this->total($y)->{$y} - ($this->get_b($x, $y) * $this->total($x)->{$x})) / $num_rows;
	}
	public function get_b($x, $y)
	{
		$num_rows = count($this->get());
		$denominator = ($num_rows * $this->total_squared($x)->{$x}) - ($this->total($x)->{$x} * $this-> total($x)->{$x});
		if ($denominator <= 0) return 0;
		return (($num_rows * $this->total_ab($x, $y)->result)-($this->total($x)->{$x} * $this->total($y) ->{$y})) / $denominator;
	}
	public function predict($x)
	{
		if ($this->x =='tanggal')
		{
			$x = strtotime($x);
		}
		return $this->get_a($this->x, $this->y) + $this->get_b($this->x, $this->y) * $x;
	}
}