<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller
{

	private $data = [];

	public function __construct()
	{
		parent::__construct();
		$this->data['nip'] = $this->session->userdata('nip');
		if (isset($this->data['nip']))
		{
			$this->data['jabatan'] = $this->session->userdata('jabatan');
			switch ($this->data['jabatan'])
			{
				case'Lab':
					redirect('lab');
					break;

				case'Gudang':
					redirect('gudang');
					break;
				case'Asisten Manajer':
					redirect('asisten_manajer');
					break;
				case 'Admin':
					redirect('admin');
					exit;
			}
		}
	}

	public function index()
	{
		
		// $this->load->model('regresi_linier_ganda_m');
		// $this->regresi_linier_ganda_m->set_variables(['dosis_alum', 'ph', 'turb']);
		// echo 'Sum X1_2: ' . $this->regresi_linier_ganda_m->fixed_sum_pred1() . '<br>';
		// echo 'Sum X2_2: ' . $this->regresi_linier_ganda_m->fixed_sum_pred2() . '<br>';
		// echo 'Sum Y_2: ' . $this->regresi_linier_ganda_m->fixed_sum_res() . '<br>';
		// echo 'Sum X1Y: ' . $this->regresi_linier_ganda_m->fixed_sum_product_pred1_res() .'<br>';
		// echo 'Sum X2Y: ' . $this->regresi_linier_ganda_m->fixed_sum_product_pred2_res() .'<br>';
		// echo 'Sum X1X2: ' .$this->regresi_linier_ganda_m->fixed_sum_product_pred1_pred2() .'<br>';
		// echo 'b1 :' . $this->regresi_linier_ganda_m->get_b1() . '<br>';
		// echo 'b2 : ' . $this->regresi_linier_ganda_m->get_b2(). '<br>';
		// echo 'a : ' . $this->regresi_linier_ganda_m->get_a(). '<br>';
		// exit;

		if ($this->POST('login-submit'))
		{
			$this->load->model('pegawai_m');

			if (!$this->pegawai_m->required_input(['nip','password'])) 
			{
				$this->flashmsg('Data harus lengkap','warning');
				redirect('login');
				exit;
			}
			
			$this->data = [
				'nip'	=> $this->POST('nip'),
				'password'	=> md5($this->POST('password'))
			];

			$result = $this->pegawai_m->login($this->data['nip'], $this->data['password']);
			if (!isset($result)) 
			{
				$this->flashmsg('NIP atau password salah','danger');
			}
			
			redirect('login');
			exit;
		}
		
		$this->data['title'] = 'LOGIN' . $this->title;
		$this->load->view('login', $this->data);
	}
}
