<?php 

class Login_m extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name']	= 'user';
		$this->data['primary_key']	= 'nip';	
	}

	public function login($nip, $password)
	{
		$user = $this->get_row(['nip' => $nip, 'password' => $password]);
		
		if ($user)
		{
			$this->session->set_userdata([
				'nip'		=> $user->nip,
				'jabatan'	=> $user->jabatan
			]);
		}

		return $user;
	}
}