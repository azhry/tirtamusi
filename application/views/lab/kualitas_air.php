<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title-left">
				<h3 class="page-header">	
				Data Kualitas Air
				<button class="btn btn-primary" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Tambah Data</button>
				<a href="<?= base_url( 'lab/download-laporan' ) ?>" class="btn btn-primary pull-right"><i class="fa fa-print"></i>Download Laporan</a>
				</h3>
			</div>
			<div class="clearfix"></div>
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						<h2 class="x_title"> Data Kualitas Air</h2>
						<div class="x_content">
							<div><?= $this->session->flashdata('msg') ?></div>
							<table id="datatable" class="table table-bordered table-striped">
								<thead>
								 <tr>
								 	<th>ID</th>
								 	<th>Tanggal</th>
								 	<th>Jam</th>
								 	<th>Turb</th>
								 	<th>Ph</th>
								 	<th>Dhl</th>
								 	<th>Tds</th>
								 	<th>Tss</th>
								 	<th>Temp</th>
								 	<th>Jenis</th>
								 	<th>Aksi</th>
								 </tr>
								</thead>
								<tbody>
									<?php foreach ($kualitas_air as $row): ?>
									<tr>
										<td><?= $row->id_kualitas ?></td>
										<td><?= $row->tanggal ?></td>
										<td><?= $row->jam ?></td>
										<td><?= $row->turb ?></td>
										<td><?= $row->ph ?></td>
										<td><?= $row->dhl ?></td>
										<td><?= $row->tds ?></td>
										<td><?= $row->tss ?></td>
										<td><?= $row->temp ?></td>
										<td><?= $row->jenis ?></td>
										<td>
											<a data-toggle="modal" data-target="#edit" href="" onclick="get_kualitas_air('<?= $row->id_kualitas ?>');" class="btn btn-primary"><i class="fa fa-edit"></i></a>
											<a href="<?= base_url('lab/kualitas-air?delete=true&id_kualitas=' . $row->id_kualitas) ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
										</td>
									</tr>
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

<div class="modal fade" tabindex="-1" role="dialog" id="tambah">
	<div class="modal-dialog modal-lg" role="document">
	<?= form_open('lab/kualitas_air') ?>
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times; </span></button>
				<h4 class="modal-title">Tambah Data Kualitas Air</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="tanggal">Tanggal</label>
								<input type="text" id="tanggal" class="form-control" name="tanggal">
							</div>
							<div class="form-group">
								<label for="jam">Jam</label>
								<input type="text" class="form-control" name="jam">
							</div>
							<div class="form-group">
								<label for="turb">Turb</label>
								<input type="text" class="form-control" name="turb">
							</div>
							<div class="form-group">
								<label for="ph">Ph</label>
								<input min="0" max="14" type="number" step="any" class="form-control" name="ph">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="dhl">Dhl</label>
								<input type="text" class="form-control" name="dhl">
							</div>
							<div class="form-group">
								<label for="tds">Tds</label>
								<input type="text" class="form-control" name="tds">
							</div>
							<div class="form-group">
								<label for="tss">Tss</label>
								<input type="text" class="form-control" name="tss">
							</div>
							<div class="form-group">
								<label for="temp">Temp</label>
								<input type="text" class="form-control" name="temp">
							</div>
							<div class="form-group">
								<label for="jenis">Jenis</label><br>
								<input type="radio" name="jenis" value="Baku" /> Baku<br>
								<input type="radio" name="jenis" value="Bersih" /> Bersih<br>
							</div>
						</div>
					</div>
					
					
					<input type="submit" name="submit" value="Tambah" class="btn btn-primary">
					</div>
					<div class="modal-footer"></div>
					</div>
				<?= form_close() ?>
			</div>
		</div>

<div class="modal fade" tabindex="-1" role="dialog" id="edit">
	<div class="modal-dialog" role="document">
	<?= form_open('lab/kualitas-air') ?>
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times; </span></button>
				<h4 class="modal-title">Edit Data Kualitas Air</h4>
				</div>
				<input type="hidden" name="id_kualitas" id="id_kualitas">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="tanggal">Tanggal</label>
								<input type="text" id="tanggal_edit" class="form-control" name="tanggal">
							</div>
							<div class="form-group">
								<label for="jam">Jam</label>
								<input type="text" class="form-control" name="jam" id="jam">
							</div>
							<div class="form-group">
								<label for="turb">Turb</label>
								<input type="text" class="form-control" name="turb" id="turb">
							</div>
							<div class="form-group">
								<label for="ph">Ph</label>
								<input type="text" class="form-control" name="ph" id="ph">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="dhl">Dhl</label>
								<input type="text" class="form-control" name="dhl" id="dhl">
							</div>
							<div class="form-group">
								<label for="tds">Tds</label>
								<input type="text" class="form-control" name="tds" id="tds">
							</div>
							<div class="form-group">
								<label for="tss">Tss</label>
								<input type="text" class="form-control" name="tss" id="tss">
							</div>
							<div class="form-group">
								<label for="temp">Temp</label>
								<input type="text" class="form-control" name="temp" id="temp">
							</div>
							<div class="form-group" id="jenis">
								
							</div>
						</div>
					</div>
					
					<input type="submit" name="edit" value="Edit" class="btn btn-primary">
					</div>
					<div class="modal-footer"></div>
					</div>
				<?= form_close() ?>
			</div>
		</div>

<script type="text/javascript">
	$(document). ready(function(){
		$('#datatable').DataTable({
			responsive:true
		});
		$('#tanggal, #tanggal_edit').datepicker({

			format:'yyyy-mm-dd'
		});
	});

	function get_kualitas_air(id_kualitas) {
		$.ajax({
			url: '<?= base_url('lab/kualitas-air') ?>',
			type: 'POST',
			data: {
				get: true,
				id_kualitas: id_kualitas
			},
			success: function(response) {
				console.log(response);
				var json = $.parseJSON(response);
				$('#id_kualitas').val(json.id_kualitas);
				$('#tanggal_edit').val(json.tanggal);
				$('#jam').val(json.jam);
				$('#turb').val(json.turb);
				$('#ph').val(json.ph);
				$('#dhl').val(json.dhl);
				$('#tds').val(json.tds);
				$('#tss').val(json.tss);
				$('#temp').val(json.temp);
				if ( json.jenis == 'Baku' ) {
					$( '#jenis' ).html('<label for="jenis">Jenis</label><br>' +
					'<input type="radio" name="jenis" value="Baku" checked /> Baku<br>' +
					'<input type="radio" name="jenis" value="Bersih" /> Bersih<br>');
				} else if ( json.jenis == 'Bersih' ) {
					$( '#jenis' ).html('<label for="jenis">Jenis</label><br>' +
					'<input type="radio" name="jenis" value="Baku" /> Baku<br>' +
					'<input type="radio" name="jenis" value="Bersih" checked /> Bersih<br>');
				}
			}
		});
	}
</script>
