<?php

class Regresi_linier_ganda_m extends MY_Model
{
	private $variables;
	private $response;
	private $predictor;
	private $res;
	private $pred;
	private $num_rows;

	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']	= 'parameter_uji';
		$this->data['primary_key']	= 'id_parameter';
		$this->num_rows = count($this->get());
	}

	public function set_variables($variables)
	{
		$this->variables	= $variables;
		$this->response 	= array_slice($this->variables, count($this->variables) -1);
		$this->predictor	= array_slice($this->variables, 0, count($this->variables) -1);
		$this->res = [];
		$this->pred = [];

		foreach ($this->predictor as $predictor)
		{
			$this->pred[$predictor]	= 0;
		}
		foreach ($this->response as $response) 
		{
			$this->res[$response] =0;
		}
	}

	public function predict($predictor)
	{
		for ($i = 0; $i < count($this->predictor); $i++)
		{
			if($this->predictor[$i] =='tanggal')
			{
				$predictor[$i] = strtotime($predictor[$i]);
			}
		}
		return $this->get_a() + $this->get_b1() * $predictor[0] + $this->get_b2() * $predictor[1];
	}

	public function get_a()
	{
		return ($this->sum_res() - ($this->get_b1() * $this->sum_pred1()) -($this->get_b2() * $this->sum_pred2()) ) / $this->num_rows;
	}

	public function get_b1()
	{
		$denominator = (($this->fixed_sum_pred1() * $this->fixed_sum_pred2()) - pow($this->fixed_sum_product_pred1_pred2(), 2) );

		if ($denominator == 0)
			return 0;

		return(($this->fixed_sum_pred2() * $this->fixed_sum_product_pred1_res()) - ($this->fixed_sum_product_pred2_res() * $this->fixed_sum_product_pred1_pred2()) ) / $denominator;
	}

	public function get_b2()
	{
		$denominator = (($this->fixed_sum_pred1() * $this->fixed_sum_pred2()) - pow($this->fixed_sum_product_pred1_pred2(), 2));

		if ($denominator == 0)
			return 0; 

		return(($this->fixed_sum_pred1() * $this->fixed_sum_product_pred2_res()) - ($this->fixed_sum_product_pred1_res() * $this->fixed_sum_product_pred1_pred2()) ) / $denominator;
	}

	public function fixed_sum_pred1()
	{
		$denominator = $this->num_rows;
		if ($denominator == 0)
			return 0;

		return $this->sum_pred1_squared() - (pow($this->sum_pred1(), 2) / $denominator); 
	}

	public function fixed_sum_pred2()
	{
		$denominator = $this->num_rows;
		if($denominator == 0)
			return 0;

		return $this->sum_pred2_squared() - (pow($this->sum_pred2(), 2) / $this->num_rows); 
	}

	public function fixed_sum_res()
	{
		$denominator = $this->num_rows;
		if($denominator == 0)
			return 0;

		return $this->sum_res_squared() - (pow($this->sum_res(), 2) / $this->num_rows); 
	}

	public function fixed_sum_product_pred1_res()
	{
		$denominator = $this->num_rows;
		if($denominator == 0)
			return $this->sum_product_pred1_res();

		return $this->sum_product_pred1_res() - (($this->sum_pred1() * $this->sum_res()) / $this->num_rows); 
	}

	public function fixed_sum_product_pred2_res()
	{
		$denominator = $this->num_rows;
		if($denominator == 0)
			return $this->sum_product_pred2_res();

		return $this->sum_product_pred2_res() - (($this->sum_pred2() * $this->sum_res()) / $this->num_rows); 
	}

	public function fixed_sum_product_pred1_pred2()
	{
		$denominator = $this->num_rows;
		if($denominator == 0)
			return $this->sum_product_pred1_pred2();

		return $this->sum_product_pred1_pred2() - (($this->sum_pred1() * $this->sum_pred2()) / $this->num_rows); 
	}

	public function sum_product_pred1_res()
	{
		$sql ='SUM(';
		if ($this->predictor[0] == 'tanggal')
		{
			$sql .='UNIX_TIMESTAMP(' .$this->predictor[0] . ') * ';
		}
		else
		{
			$sql .=$this->predictor[0] . ' * ';
		}
		$sql .='' .$this->response[0] . ')AS result';
		$this->db->select($sql);
		$this->db->from($this->data['table_name']);
		$query = $this->db->get();
		return $query->row()->result;
	}

	public function sum_product_pred2_res()
	{
		$sql = 'SUM(';
		if ($this->predictor[1] == 'tanggal')
		{
			$sql .= 'UNIX_TIMESTAMP(' .$this->predictor[1] . ') *';
		}
		else
		{
			$sql .=$this->predictor[1] . ' * ';
		}
		$sql .= ' ' .$this->response[0] . ')AS result';
		$this->db->select($sql);
		$this->db->from($this->data['table_name']);
		$query = $this->db->get();
		return $query->row()->result;
	}

	public function sum_product_pred1_pred2()
	{
		$sql = 'SUM(';
		if ($this->predictor[0] == 'tanggal')
		{
			$sql .= 'UNIX_TIMESTAMP(' .$this->predictor[1] . ') *';
		}
		else
		{
			$sql .=$this->predictor[0] . ' * ';
		}
		if($this->predictor[1] =='tanggal')
		{
			$sql .='UNIX_TIMESTAMP(' .$this->predictor[1] . ')';
		}
		else
		{
			$sql .=$this->predictor[1];
		}
		$sql .=') AS result';
		$this->db->select($sql);
		$this->db->from($this->data['table_name']);
		$query = $this->db->get();
		return $query->row()->result;
	}

	
	public function sum_res()
	{
		$this->db->select('SUM(' .$this->response[0] . ') AS result');
		$this->db->from($this->data['table_name']);
		$query = $this->db->get();
		return $query->row()->result;
	}
	public function sum_res_squared()
	{
		$this->db->select('SUM(' .$this->response[0].' * '. $this->response[0] . ')  AS result');
		$this->db->from($this->data['table_name']);
		$query = $this->db->get();
		return $query->row()->result;
	}

	public function sum_pred1()
	{
		$this->db->select('SUM(' .$this->predictor[0] .')  AS result');
		$this->db->from($this->data['table_name']);
		$query = $this->db->get();
		return $query->row()->result;
	}

	public function sum_pred1_squared()
	{
		$sql = 'SUM(';
		if ($this->predictor[0] == 'tanggal')
		{
			$sql .= 'UNIX_TIMESTAMP(' .$this->predictor[0] . ') *';
		}
		else
		{
			$sql .=$this->predictor[0] . ' * ';
		}
		if ($this->predictor[0] == 'tanggal')
		{
			$sql .= 'UNIX_TIMESTAMP(' . $this->predictor[0] .')';
		}
		else
		{
			$sql .= $this->predictor[0];
		}
		$sql .= ') AS result';
		$this->db->select($sql);
		$this->db->from($this->data['table_name']);
		$query = $this->db->get();
		return $query->row()->result;
	}

	public function sum_pred2()
	{
		$this->db->select('SUM(' .$this->predictor[1].')  AS result');
		$this->db->from($this->data['table_name']);
		$query = $this->db->get();
		return $query->row()->result;
	}
	public function sum_pred2_squared()
	{
		$sql = 'SUM(';
		if ($this->predictor[1] == 'tanggal')
		{
			$sql .= 'UNIX_TIMESTAMP(' .$this->predictor[1] . ') *';
		}
		else
		{
			$sql .=$this->predictor[1] . ' * ';
		}
		if($this->predictor[1] == 'tanggal')
		{
			$sql .= 'UNIX_TIMESTAMP(' . $this->predictor[1] . ')';
		}
		else
		{
			$sql .= $this->predictor[1];
		}
		$sql .= ') AS result';
		$this->db->select($sql);
		$this->db->from($this->data['table_name']);
		$query = $this->db->get();
		return $query->row()->result;
	}
}