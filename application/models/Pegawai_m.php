<?php

class Pegawai_m extends MY_Model

{
	public function __construct()
	{
		parent::__construct();
		$this->data['table_name'] = 'pegawai';
		$this->data['primary_key'] = 'id_pegawai';
	}
	public function login($nip, $password)
{
	$pegawai = $this->get_row(['nip'=> $nip, 'password'=> $password]);
	if ($pegawai)
	{
		$this->session->set_userdata([
			'nip' => $nip,
			'jabatan' => $pegawai->jabatan
		]);
		return $pegawai;
	}
	return FALSE;
}
}