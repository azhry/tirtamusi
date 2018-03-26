<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title-left">
				<h3 class="page-header">
				Data Parameter Uji
					<button class="btn btn-primary" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Tambah Data</button>
					<a href="<?= base_url( 'lab/download-laporan-proses-koagulasi' ) ?>" class="btn btn-primary pull-right"><i class="fa fa-print"></i>Download Laporan</a>
				</h3>
			</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
				<h2 class="x_title"> Data Parameter Uji</h2>
					<div class="x_content">
						<div><?= $this->session->flashdata('msg') ?></div>
						<table id="datatable" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>ID</th>
									<th>Hari ke-</th>
									<th>Dosis Alum</th>
									<th>Turb</th>
									<th>Ph</th>
									<!-- <th>Optimum</th> -->
									<th>Aksi</th>
									
								</tr>
							</thead>
							<tbody>
								<?php $i = 0; foreach ($parameter_uji as $row): ?>
									<tr>
									<td><?= $row->id_parameter ?></td>
									<!-- <td><?= $row->tanggal ?></td> -->
									<td>
										<?php
											if ( ++$i % 32 == 0 ) {
												$i = 1;
												echo $i;
											} else echo $i;
										?>
									</td>
									<td><?= $row->dosis_alum ?></td>
									<td><?= $row->turb ?></td>
									<td><?= $row->ph ?></td>
									<!-- <td><?= $row->optimum ?></td> --> 
									<td>
										<!-- <a data-toggle="modal" data-target="#edit" href=""
										onclick="get_parameter_uji('<?=$row->id_parameter ?>')
										;" class="btn btn-primary"><i class="fa fa-edit"> 
										</i></a> -->
										<a href="<?= base_url('lab/parameter_uji?delete=true&id_parameter=' . $row->id_parameter) ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
		<div class="modal-dialog" role="document">
			<?= form_open('lab/parameter_uji') ?>
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times; </span></button>
						<h4 class="modal-title"> Tambah Data Pengujian</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="tanggal"> Tanggal</label>
							<input type="text" id="tanggal" class="form-control" name="tanggal">
						</div>
						<div class="form-group">
							<label for="dosis_alum"> Dosis Alum</label>
							<input type="text" class="form-control" name="dosis_alum">
						</div>
						<div class="form-group">
							<label for="turb"> Turb</label>
							<input type="text" class="form-control" name="turb">
						</div>
						<div class="form-group">
							<label for="ph"> Ph</label>
							<input type="text" class="form-control" name="ph">
						</div>
						<!-- <div class="form-group">
							<label for="optimum"> Optimum</label>
							<input type="text" class="form-control" name="optimum">
						</div> -->
						<input type="submit" name="submit" value="Tambah" class="btn btn-primary">
					</div>
					<div class="modal-footer"></div>
					</div>
				<?= form_close() ?>
				</div>
		</div>

<div class="modal fade" tabindex="-1" role="dialog" id="edit">
	<div class="modal-dialog" role="document">
	<?= form_open('lab/parameter_uji') ?>
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Edit Data Pengujian</h4>
				</div>
				<input type="hidden" name="id_parameter" id="id_parameter">
				<div class="modal-body">
					<div class="form-group">
						<label for="tanggal">Tanggal</label>
						<input type="text" id="tanggal_edit" class="form-control" name="tanggal">
					</div>
					<div class="form-group">
						<label for="dosis_alum">Dosis Alum</label>
						<input type="text" class="form-control" name="dosis_alum" id="dosis_alum">
					</div>
					<div class="form-group">
						<label for="turb">Turb</label>
						<input type="text" class="form-control" name="turb" id="turb">
					</div>
					<div class="form-group">
						<label for="ph">Ph</label>
						<input type="text" class="form-control" name="ph" id="ph">
					</div>
					<!-- <div class="form-group">
						<label for="optimum"> Optimum</label>
						<input type="text" class="form-control" name="optimum" id="optimum">
					</div> -->
					<input type="submit" name="edit" value="Edit" class="btn btn-primary">
					</div>
					<div class="modal-footer"></div>
					</div>
				<?= form_close() ?>
			</div>
		</div>

<script type="text/javascript">
			$(document).ready(function(){
				$('#datatable').DataTable({
					responsive: true,
					ordering: false
				});
				$('#tanggal').datepicker({
					format: 'yyyy-mm-dd'
				});
			});

	function get_parameter_uji(id_parameter) {
		$.ajax({
			url: '<?= base_url('lab/parameter-uji') ?>',
			type: 'POST',
			data: {
				get: true,
				id_parameter: id_parameter
			},
			success: function(response) {
				console.log(response);
				var json = $.parseJSON(response);
				$('#id_parameter').val(json.id_parameter);
				$('#tanggal_edit').val(json.tanggal);
				$('#dosis_alum').val(json.dosis_alum);
				$('#turb').val(json.turb);
				$('#ph').val(json.ph);
				// $('#optimum').val(json.optimum);
				
			}
		});
	}
</script>

