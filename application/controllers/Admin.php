<?php 

class Admin extends MY_Controller {

	public function __construct() {

		parent::__construct();
		$this->data['nip'] =$this->session->userdata('nip');
		$this->data['jabatan'] =$this->session->userdata('jabatan');

		if(!isset($this->data['nip'], $this->data['jabatan']))
		{
			$this->session->sess_destroy();
			redirect('login');
			exit;
		}
		if($this->data['jabatan']!='Admin')
		{
			$this->session->sess_destroy();
			redirect('login');
			exit;

		}

	}


	public function index() {

		$this->load->model( 'pegawai_m' );
		if ( $this->POST( 'submit' ) ) {

			$cek_pengguna = $this->pegawai_m->get_row([ 'nip' => $this->POST( 'nip' ) ]);
			if ( $cek_pengguna ) {
				$this->flashmsg( 'NIP telah digunakan', 'danger' );
				redirect( 'admin' );
				exit;
			}

			$this->data['pegawai'] = [
				'nip'			=> $this->POST( 'nip' ),
				'password'		=> md5( $this->POST( 'password' ) ),
				'nama'			=> $this->POST( 'nama' ),
				'jenis_kelamin'	=> $this->POST( 'jenis_kelamin' ),
				'jabatan'		=> $this->POST( 'jabatan' )
			];
			$this->pegawai_m->insert( $this->data['pegawai'] );
			$this->flashmsg( 'Data pengguna berhasil ditambahkan' );
			redirect( 'admin' );
			exit;

		}

		if ( $this->POST( 'edit' ) ) {

			$cek_pengguna = $this->pegawai_m->get_row([ 'nip' => $this->POST( 'nip' ) ]);
			if ( $cek_pengguna ) {
				$this->flashmsg( 'NIP telah digunakan', 'danger' );
				redirect( 'admin' );
				exit;
			}
			
			$this->data['pegawai'] = [
				'nip'			=> $this->POST( 'nip' ),
				'nama'			=> $this->POST( 'nama' ),
				'jenis_kelamin'	=> $this->POST( 'jenis_kelamin' ),
				'jabatan'		=> $this->POST( 'jabatan' )
			];
			$password = $this->POST( 'password' );
			if ( !empty( $password ) ) {
				$this->data['pegawai']['password'] = md5( $password );
			}
			$this->pegawai_m->update( $this->POST( 'id_pegawai' ), $this->data['pegawai'] );
			$this->flashmsg( 'Data pengguna berhasil diedit' );
			redirect( 'admin' );
			exit;

		}

		if ( $this->GET( 'delete' ) && $this->GET( 'id_pegawai' ) ) {

			$this->pegawai_m->delete( $this->GET( 'id_pegawai' ) );
			$this->flashmsg( 'Data pengguna berhasil dihapus' );
			redirect( 'admin' );
			exit;

		}

		if ( $this->POST( 'get' ) && $this->POST( 'id_pegawai' ) ) {

			$this->data['pegawai'] = $this->pegawai_m->get_row([ 'id_pegawai' => $this->POST( 'id_pegawai' ) ]);
			$jenis_kelamin = [
				'Laki-laki'	=> 'Laki-laki',
				'Perempuan'	=> 'Perempuan'
			];
			$this->data['pegawai']->dropdown_jenis_kelamin = form_dropdown( 'jenis_kelamin', $jenis_kelamin, $this->data['pegawai']->jenis_kelamin, [ 'class' => 'form-control' ] );
			$jabatan = [
				'Admin'				=> 'Admin',
				'Asisten Manajer'	=> 'Asisten Manajer',
				'Lab'				=> 'Lab',
				'Gudang'			=> 'Gudang'
			];
			$this->data['pegawai']->dropdown_jabatan = form_dropdown( 'jabatan', $jabatan, $this->data['pegawai']->jabatan, [ 'class' => 'form-control' ] );
			echo json_encode( $this->data['pegawai'] );
			exit;

		}
		$this->data['pegawai'] 	= $this->pegawai_m->get();
		$this->data['title']	= 'Data Pengguna';
		$this->data['content']	= 'admin/data_pengguna';
		$this->template( $this->data, 'admin' );

	}

}