<?php
	class Gudang extends MY_Controller
	{
		public function __construct()
		{
			parent::__construct();

			$this->data['nip'] =$this->session->userdata('nip');
			$this->data['jabatan'] =$this->session->userdata('jabatan');

			if(!isset($this->data['nip'], $this->data['jabatan']))
			{
				$this->session->sess_destroy();
				redirect('login');
				exit;
			}
			if($this->data['jabatan']!='Gudang')
			{
				$this->session->sess_destroy();
				redirect('login');
				exit;

			}

			$this->load->model('pegawai_m');
			$this->data['pegawai']	= $this->pegawai_m->get_row(['nip' => $this->data['nip'], 'jabatan' =>$this->data['jabatan']]);

		}

		public function index()
		{
			$this->load->model('alum_m');
			$this->data['alum'] = $this->alum_m->get();
			$this->data['title'] = 'Dashboard';
			$this->data['content'] = 'gudang/dashboard';
			$this->template($this->data,'gudang');
		}

		public function data_alum()
		{
			$this->load->model('alum_m');
			$this->data['alum']		=$this->alum_m->get();
			$this->data['title'] = 'Dashboard';
			$this->data['content'] = 'gudang/data_alum';
			$this->template($this->data,'gudang');		
		}

		public function insert_alum()
		{
			if ($this->POST('tambah'))
			{
				$this->load->model('alum_m');
				$this->data['alum'] =[
						'jumlah'	=>$this->POST('jumlah'),
						'tanggal'	=>date('Y-m-d H:i:s'),
						'id_pegawai' =>$this->data['pegawai']->id_pegawai
						];
						$this->alum_m->insert($this->data['alum']);
						redirect('gudang/data-alum');
						exit;
			}

			$this->data['title']	='Insert Alum';
			$this->data['content']	='gudang/insert_alum';
			$this->template($this->data, 'gudang');
	}

	public function rekap_alum() {

		$this->load->model( 'parameter_uji_m');
		$this->data['rekap_alum']	=$this->parameter_uji_m->get_rekap_pengujian();
		$this->data['title']		='Rekap Alum';
		$this->data['content']		='gudang/rekap_alum';
		$this->template($this->data, 'gudang');
	}
	public function download_laporan_data_alum(){

			$this->load->model('pegawai_m');
			$this->load->model('alum_m');
			$this->data['alum']		=$this->alum_m->get();
			$this->dump($this->data['alum']);
			$html = $this->load->view('gudang/laporan', $this->data, true);
			$pdfFilePath = 'Laporan Data Alum - ' .date('Y-m-d') . '.pdf';
			$this->load->library('m_pdf');
			$this->m_pdf->pdf->WriteHTML($html);
			$this->m_pdf->pdf->Output($pdfFilePath, "D");
		}

}