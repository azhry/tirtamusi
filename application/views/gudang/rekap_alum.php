<?php
	$nama_bulan = [
		'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
	];
?>
<div class="right_col" role="main">
		<div class="">
			<div class="page-title">
				<div class="title-left">
				<h3 class="page-header">
					Rekap Alum
				</h3>
			</div>
			<div class="clearfix"></div>
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="x_panel">
							<div class="x_title">
								<h2>Rekap Alum</h2>
							</div>
							<div class="x_content">
								<div><?= $this->session->flashdata('msg') ?></div>
								<table id="datatable" class="table table-bordered table-striped">
									<thead>
									<tr>
										<th>No.</th>
										<th>Bulan</th>
										<th>Tahun</th>
										<th>Total Alum</th>
									</tr>
									</thead>
									<tbody>
										<?php $i = 0; foreach ($rekap_alum as $row): ?> 

										<tr>
											<td><?= ++$i ?></td>
											<td><?= $nama_bulan[$row->bulan -1] ?></td>
											<td><?= $row->tahun ?></td>
											<td><?= $row->total_alum ?></td>
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

<script type="text/javascript">
	$(document).ready(function() {
		$('#datatable').DataTable({
			responsive: true
		});
	});
</script>