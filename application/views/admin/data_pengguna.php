<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title-left">
				<h3 class="page-header">
				Data Pengguna
					<button class="btn btn-primary" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Tambah Data</button>
				</h3>
			</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
				<h2 class="x_title"> Data Pengguna</h2>
					<div class="x_content">
						<div><?= $this->session->flashdata('msg') ?></div>
						<table id="datatable" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>ID</th>
									<th>NIP</th>
									<th>Nama</th>
									<th>Jenis Kelamin</th>
									<th>Jabatan</th>
									<th>Aksi</th>
									
								</tr>
							</thead>
							<tbody>
								<?php $i = 0; foreach ($pegawai as $row): ?>
									<tr>
									<td><?= $row->id_pegawai ?></td>
									<td><?= $row->nip ?></td>
									<td><?= $row->nama ?></td>
									<td><?= $row->jenis_kelamin ?></td>
									<td><?= $row->jabatan ?></td>
									<td>
										<a data-toggle="modal" data-target="#edit" href=""
										onclick="get_pegawai('<?=$row->id_pegawai ?>')
										;" class="btn btn-primary"><i class="fa fa-edit"> 
										</i></a>
										<a href="<?= base_url('admin?delete=true&id_pegawai=' . $row->id_pegawai) ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
			<?= form_open('admin') ?>
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times; </span></button>
						<h4 class="modal-title"> Tambah Pengguna</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="nip">NIP</label>
							<input type="text" id="nip" class="form-control" name="nip">
						</div>
						<div class="form-group">
							<label for="nama">Nama</label>
							<input type="text" id="nama" class="form-control" name="nama">
						</div>
						<div class="form-group">
							<label for="jenis_kelamin">Jenis Kelamin</label>
							<select class="form-control" name="jenis_kelamin">
								<option>Pilih Jenis Kelamin</option>
								<option value="Laki-laki">Laki-laki</option>
								<option value="Perempuan">Perempuan</option>
							</select>
						</div>
						<div class="form-group">
							<label for="jabatan">Jabatan</label>
							<select class="form-control" name="jabatan">
								<option>Pilih Jabatan</option>
								<option value="Gudang">Gudang</option>
								<option value="Lab">Lab</option>
								<option value="Asisten Manajer">Asisten Manajer</option>
								<option value="Admin">Admin</option>
							</select>
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" id="password" class="form-control" name="password">
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
	<?= form_open('admin') ?>
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Edit Data Pengujian</h4>
				</div>
				<input type="hidden" name="id_parameter" id="id_parameter">
				<div class="modal-body">
					<input type="hidden" name="id_pegawai" id="id_pegawai_edit" />
					<div class="form-group">
							<label for="nip">NIP</label>
							<input type="text" id="nip_edit" class="form-control" name="nip">
						</div>
						<div class="form-group">
							<label for="nama">Nama</label>
							<input type="text" id="nama_edit" class="form-control" name="nama">
						</div>
						<div class="form-group">
							<label for="jenis_kelamin">Jenis Kelamin</label>
							<div id="jenis_kelamin_edit"></div>
						</div>
						<div class="form-group">
							<label for="jabatan">Jabatan</label>
							<div id="jabatan_edit"></div>
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" id="password_edit" class="form-control" name="password">
						</div>
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

	function get_pegawai(id_pegawai) {
		$.ajax({
			url: '<?= base_url('admin') ?>',
			type: 'POST',
			data: {
				get: true,
				id_pegawai: id_pegawai
			},
			success: function(response) {
				console.log(response);
				var json = $.parseJSON(response);
				$( '#id_pegawai_edit' ).val( id_pegawai );
				$('#nip_edit').val(json.nip);
				$('#nama_edit').val(json.nama);
				$('#jenis_kelamin_edit').html(json.dropdown_jenis_kelamin);
				$('#jabatan_edit').html(json.dropdown_jabatan);
				
			}
		});
	}
</script>

