<?php
	
	
	class Asisten_manajer extends MY_Controller
	{
		
		public function __construct()
		{
			parent::__construct();

			$this->data['nip']	=$this->session->userdata('nip');
			$this->data['jabatan']	=$this->session->userdata('jabatan');

			if(!isset($this->data['nip'], $this->data['jabatan']))
			{
				$this->session->sess_destroy();
				redirect('login');
				exit;
			}

			if($this->data['jabatan'] != 'Asisten Manajer')
			{
				$this->session->sess_destroy();
				redirect('login');
				exit;
			}

			$this->load->model('pegawai_m');
			$this->data['pegawai']	= $this->pegawai_m->get_row(['nip' => $this->data['nip'], 'jabatan' => $this->data['jabatan']]);

		}

		public function index() {

			$this->load->model('kualitas_air_m');
			$this->data['kualitas_air']		=$this->kualitas_air_m->get_by_order('id_kualitas', 'DESC' );
			$this->data['title']			='Laporan Kualitas Air';
			$this->data['content']			='asisten_manajer/laporan_kualitas_air';
			$this->template( $this->data, 'asisten_manajer');
		}

		public function download_laporan(){

			$this->load->model( 'kualitas_air_m');
			$this->data['kualitas_air']		=$this->kualitas_air_m->get_by_order('id_kualitas', 'DESC');
			$html = $this->load->view('asisten_manajer/laporan', $this->data, true);
			$pdfFilePath = 'Laporan Kualitas Air - ' .date('Y-m-d') . '.pdf';
			$this->load->library('m_pdf');
			$this->m_pdf->pdf->WriteHTML($html);
			$this->m_pdf->pdf->Output($pdfFilePath, "D");
		}
	}