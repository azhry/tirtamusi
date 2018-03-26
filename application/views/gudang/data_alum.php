<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title-left">
				<h3 class="page-header">
				Data Alum
				<a class="btn btn-primary" href="<?= base_url('gudang/insert-alum') ?>"><i class="fa fa-plus"></i> Tambah Data Alum</a>
				<a href="<?= base_url( 'gudang/download_laporan_data_alum' ) ?>" class="btn btn-primary pull-right"><i class="fa fa-print"></i>Download Laporan</a>
				</h3>
			</div>
			<div class="clearfix"></div>
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						<h2 class="x_title"> Data Alum</h2>
						<div class="x_content">
							<div><?= $this->session->flashdata('msg') ?></div>
							<table id="datatable" class="table table-bordered table-striped">
								<thead>
								 <tr>
								 	<th>ID</th>
								 	<th>Tanggal</th>
								 	<th>Jam</th>
								 	<th>Stok Alum</th>
								 	<th>Terpakai</th>
								 	<th>Ditambahkan oleh</th>
								 	
								</thead>
								<tbody>
									<?php foreach ($alum as $row): ?>

									<?php $waktu = explode( ' ', $row->tanggal ) ?>
									<tr>
										<td><?= $row->id_alum ?></td>
										<td><?= $waktu[0] ?></td>
										<td><?= $waktu[1] ?></td>
										<td><?= $row->jumlah ?></td>
										<td><?= $row->terpakai ?></td>
										<td>
												<?php 
													$pegawai = $this->pegawai_m->get_row(['id_pegawai' => $row->id_pegawai]);
													echo $pegawai ? $pegawai->nama : '-';
												?>
										</td>
										
								<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



<script type="text/javascript">
	$(document). ready(function(){
		$('#datatable').DataTable({
			responsive:true
		});
	});
</script>
