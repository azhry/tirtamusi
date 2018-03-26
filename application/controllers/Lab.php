<?php
	class Lab extends MY_Controller
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
			if($this->data['jabatan']!='Lab')
			{
				$this->session->sess_destroy();
				redirect('login');
				exit;

			}

		}

		public function index()
		{
			$this->load->model('kualitas_air_m');
			$this->load->model('parameter_uji_m');
			$this->load->model('regresi_linier_ganda_m');
			$this->data['parameter_uji'] = $this->parameter_uji_m->get();
			$this->data['kualitas_air'] = $this->kualitas_air_m->get();
			$this->data['prediksi_kekeruhan'] = $this->regresi_linier_ganda_m->get();
			$this->data['title'] = 'Dashboard';
			$this->data['content'] = 'lab/dashboard';
			$this->template($this->data,'lab');
		}

		public function kualitas_air()
		{
			$this->load->model('kualitas_air_m');
			if($this->POST('submit'))
			{
				$this->data['kualitas_air'] = [
				 	'tanggal' => $this->POST('tanggal'),
				 	'jam' 	  => $this->POST('jam'),
				 	'turb' 	  => $this->POST('turb'),
				 	'ph' 	  => $this->POST('ph'),
				 	'dhl' 	  => $this->POST('dhl'),
				 	'tds' 	  => $this->POST('tds'),
				 	'tss' 	  => $this->POST('tss'),
				 	'temp' 	  => $this->POST('temp'),
				 	'jenis'	  => $this->POST('jenis')
				];

				$this->kualitas_air_m->insert($this->data['kualitas_air']);
				redirect('lab/kualitas_air');
				exit;
			}

			if ($this->GET('delete') && $this->GET('id_kualitas'))
			{
				$this->kualitas_air_m->delete($this->GET('id_kualitas'));
				redirect('lab/kualitas-air');
				exit;
			}

			if ($this->POST('get') && $this->POST('id_kualitas'))
			{
				$kualitas_air = $this->kualitas_air_m->get_row(['id_kualitas' => $this->POST('id_kualitas')]);
				echo json_encode($kualitas_air);
				exit;
			}

			if($this->POST('edit'))
			{
				$this->data['kualitas_air'] = [
				 	'tanggal' => $this->POST('tanggal'),
				 	'jam' 	  => $this->POST('jam'),
				 	'turb' 	  => $this->POST('turb'),
				 	'ph' 	  => $this->POST('ph'),
				 	'dhl' 	  => $this->POST('dhl'),
				 	'tds' 	  => $this->POST('tds'),
				 	'tss' 	  => $this->POST('tss'),
				 	'temp' 	  => $this->POST('temp'),
				 	'jenis'	  => $this->POST('jenis')	

				];

				$this->kualitas_air_m->update($this->POST('id_kualitas'), $this->data['kualitas_air']);
				redirect('lab/kualitas_air');
				exit;
			}
			$this->data['kualitas_air'] = $this->kualitas_air_m->get();
			$this->data['title'] = 'Kualitas Air';
			$this->data['content'] = 'lab/kualitas_air';
			$this->template($this->data,'lab');
		}

		public function parameter_uji()
		{
			$this->load->model('parameter_uji_m');
			if($this->POST('submit'))
			{
				$this->load->model('alum_m');
				$dosis_alum = $this->POST('dosis_alum');
				$tersedia = true;
				$data_id = [];
				$idx = 0;
				do{

					$stok = $this->alum_m->get( 'jumlah != terpakai' );
					if( count($stok) <= 0 && count($stok) > $idx) {
						$tersedia = false;
						break;
					}
					$temp_idx = $idx;
					if ( $stok[$idx]->jumlah - $dosis_alum > 0 ) {
						$data_id[ $stok[$idx]->id_alum ] = [ 'update',$dosis_alum];
					} else{
						$data_id[ $stok[$idx]->id_alum ] = [ 'update',$stok[$idx]->jumlah];
						$idx++;
					}
					$dosis_alum -= $stok[$temp_idx]->jumlah;

				} while ($dosis_alum > 0 ); 

				if ($tersedia){
					foreach ($data_id as $key => $value) {
						if ($value == 'delete' ) {
							$this->alum_m->delete($key);
						} else {
							$alum = $this->alum_m->get_row([ 'id_alum' => $key ]);
							if ( $alum ) {
								$this->alum_m->update( $key, [ 'terpakai' => $alum->terpakai + $value[1] ] );
							}
						}
					}


					$this->data['parameter'] = [
						'dosis_alum'		=>$this->POST('dosis_alum'),
						'turb'				=>$this->POST('turb'),
						'ph'				=>$this->POST('ph'),
						// 'optimum'			=>$this->POST('optimum'),
						'tanggal'			=>$this->POST('tanggal')
					];
					$this->parameter_uji_m->insert($this->data['parameter']);
					$this->flashmsg( 'Alum berhasil dipakai untuk pengujian');
				}else {
					$this->flashmsg( 'Stok tidak tersedia', 'danger');

				}

				redirect('lab/parameter_uji');
				exit;
			}

			if ($this->POST('get') && $this->POST('id_parameter'))
			{
				$parameter_uji = $this->parameter_uji_m->get_row(['id_parameter' => $this->POST('id_parameter')]);
				echo json_encode($parameter_uji);
				exit;
			}

			if ($this->GET('delete') && $this->GET('id_parameter'))
			{
				$this->parameter_uji_m->delete($this->GET('id_parameter'));
				redirect('lab/parameter-uji');
				exit;
			}

			$this->data['parameter_uji']	=$this->parameter_uji_m->get_by_order('tanggal','ASC');
			$this->data['title']			='Parameter Uji';
			$this->data['content']			='lab/parameter_uji';
			$this->template($this->data, 'lab');
		}

		public function prediksi()
		{
			$this->load->model('regresi_linier_ganda_m2');
			$this->load->model('parameter_uji_m');
			$this->regresi_linier_ganda_m2->set_variables(['hari_ke','turb','dosis_alum']);
			if ($this->POST('prediksi'))
			{
				$dosis_alum = $this->regresi_linier_ganda_m2->predict([$this->POST('hari_ke'), $this->POST('turbidity')]);
				$response['num_rows']	= $this->regresi_linier_ganda_m2->num_rows;
				$response['fixed_sum_pred1'] = $this->regresi_linier_ganda_m2->fixed_sum_pred1();
				$response['fixed_sum_pred2'] = $this->regresi_linier_ganda_m2->fixed_sum_pred2();
				$response['fixed_sum_product_pred1_pred2'] = $this->regresi_linier_ganda_m2->fixed_sum_product_pred1_pred2();
				$response['fixed_sum_product_pred1_res'] = $this->regresi_linier_ganda_m2->fixed_sum_product_pred1_res();
				$response['fixed_sum_product_pred2_res'] = $this->regresi_linier_ganda_m2->fixed_sum_product_pred2_res();
				$response['sum_res'] 	= $this->regresi_linier_ganda_m2->sum_res();
				$response['sum_pred1']	= $this->regresi_linier_ganda_m2->sum_pred1();
				$response['sum_pred2']	= $this->regresi_linier_ganda_m2->sum_pred2();
				$response['a'] 			= $this->regresi_linier_ganda_m2->get_a();
				$response['b1'] 		= $this->regresi_linier_ganda_m2->get_b1();
				$response['b2']			= $this->regresi_linier_ganda_m2->get_b2();
				$response['y']			= $dosis_alum + 28;

				$this->load->model( 'regresi_m' );
				$this->regresi_m->set_variable( 'hari_ke', 'dosis_alum' );
				$response['s_yhd'] = $this->regresi_m->predict( $this->POST( 'hari_ke' ) ) + 28;
				$response['s_ahd'] = $this->regresi_m->get_a( 'hari_ke', 'dosis_alum' );
				$response['s_bhd'] = $this->regresi_m->get_b( 'hari_ke', 'dosis_alum' );
				$response['s_num_rows_hd'] = count( $this->regresi_m->get() );
				$response['s_sum_res_hd'] = $this->regresi_m->total( 'dosis_alum' )->{'dosis_alum'};
				$response['s_sum_pred_hd'] = $this->regresi_m->total( 'hari_ke' )->{'hari_ke'};
				$response['s_sum_squared_pred_hd'] = $this->regresi_m->total_squared( 'hari_ke' )->{'hari_ke'};
				$response['s_sum_pred_res_hd'] = $this->regresi_m->total_ab( 'hari_ke', 'dosis_alum' )->result;

				$this->regresi_m->set_variable( 'turb', 'dosis_alum' );
				$response['s_ytd'] = $this->regresi_m->predict( $this->POST( 'turbidity' ) ) + 28;
				$response['s_atd'] = $this->regresi_m->get_a( 'turb', 'dosis_alum' );
				$response['s_btd'] = $this->regresi_m->get_b( 'turb', 'dosis_alum' );
				$response['s_num_rows_td'] = count( $this->regresi_m->get() );
				$response['s_sum_res_td'] = $this->regresi_m->total( 'dosis_alum' )->{'dosis_alum'};
				$response['s_sum_pred_td'] = $this->regresi_m->total( 'turb' )->{'turb'};
				$response['s_sum_squared_pred_td'] = $this->regresi_m->total_squared( 'turb' )->{'turb'};
				$response['s_sum_pred_res_td'] = $this->regresi_m->total_ab( 'turb', 'dosis_alum' )->result;
				echo json_encode($response);
				exit;
			
			}
			$this->data['uji']		=$this->parameter_uji_m->get_pengujian2();
			$this->data['terprediksi']	= [];
			foreach ($this->data['uji'] AS $row) {
				
				$this->data['terprediksi'] []= [
					'hari_ke'		=> $row->hari_ke,
					'dosis_alum'	=> $this->regresi_linier_ganda_m2->predict( $row->hari_ke ) + 28
				];

			}
			
			$this->data['title']	= 'Prediksi Kekeruhan';
			$this->data['content']	='lab/prediksi_kekeruhan';
			$this->template($this->data, 'lab');
		}

		public function grafik()
		{
			$this->load->model('parameter_uji_m');
			$this->load->model('regresi_m');
			$this->load->model('regresi_linier_ganda_m2');

			$this->regresi_linier_ganda_m2->set_variables(['hari_ke','turb','dosis_alum']);
			
			$this->data['uji']		= $this->parameter_uji_m->get_pengujian2();
			$this->data['terprediksi']	= [];
			foreach ($this->data['uji'] AS $row)
			{
				$this->data['terprediksi'] []= [
					'hari_ke'		=> $row->hari_ke,
					'dosis_alum'	=> $this->regresi_linier_ganda_m2->predict([ $row->hari_ke, $row->turb ])
				];
			}

			$this->data['uji2']		= $this->parameter_uji_m->get_pengujian3();
			$this->data['terprediksi2']	= [];
			foreach ($this->data['uji2'] AS $row)
			{
				$this->data['terprediksi2'] []= [
					'turb'			=> $row->turb,
					'dosis_alum'	=> $this->regresi_linier_ganda_m2->predict([ $row->hari_ke, $row->turb ])
				];
			}

			$this->regresi_m->set_variable('turb', 'dosis_alum');
			$this->data['uji3'] = $this->parameter_uji_m->get_pengujian3();
			$this->data['terprediksi3'] = [];
			foreach ( $this->data['uji3'] as $row ) {

				$this->data['terprediksi3'] []= [
					'turb'			=> $row->turb,
					'dosis_alum'	=> $this->regresi_m->predict($row->turb)
				];

			}

			$this->regresi_m->set_variable('hari_ke', 'dosis_alum');
			$this->data['uji4'] = $this->parameter_uji_m->get_pengujian2();
			$this->data['terprediksi4'] = [];
			foreach ( $this->data['uji4'] as $row ) {

				$this->data['terprediksi4'] []= [
					'hari_ke'		=> $row->hari_ke,
					'dosis_alum'	=> $this->regresi_m->predict($row->hari_ke)
				];

			}

			$this->data['RMSE'] = $this->regresi_linier_ganda_m2->RMSE();
			
			$this->data['title']	= 'Grafik';
			$this->data['content']	='lab/grafik';
			$this->template($this->data, 'lab');
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

		public function download_laporan_proses_koagulasi(){

			$this->load->model( 'parameter_uji_m');
			$this->data['parameter_uji']		=$this->parameter_uji_m->get_by_order('id_parameter', 'DESC');
			$html = $this->load->view('lab/laporan', $this->data, true);
			$pdfFilePath = 'Laporan Proses Koagulasi - ' .date('Y-m-d') . '.pdf';
			$this->load->library('m_pdf');
			$this->m_pdf->pdf->WriteHTML($html);
			$this->m_pdf->pdf->Output($pdfFilePath, "D");
		}
	}
