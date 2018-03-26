<div class="right_col" role="main">
		<div class="">
			<div class="page-title">
				<div class="title-left">
				<h3 class="page-header"> Laporan Kualitas Air <a class="btn btn-primary" href="<?= base_url('asisten-manajer/download-laporan') ?>"><i class="fa fa-download"></i> Download Laporan</a></h3>
			</div>
			<div class="clearfix"></div>
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="x_panel">
							
							<h2 class="x_title"> Laporan Kualitas Air</h2>
							<div class="x_content">
								<div><?= $this->session->flashdata('msg') ?></div>
								<table id="datatable" class="table table-bordered table-striped">
									<thead>
									<tr>
										<th>No.</th>
										<th>Tanggal.</th>
										<th>Turb</th>
										<th>Ph</th>
										<th>Dhl</th>
										<th>Tds</th>
										<th>Tss</th>
										<th>Temp</th>
					
									</tr>
									</thead>
									<tbody>
										<?php $i = 0; foreach ($kualitas_air as $row): ?> 

										<tr>
											<td><?= ++$i ?></td>
											<td><?= $row->tanggal ?></td>
											<td><?= $row->turb ?></td>
											<td><?= $row->ph ?></td>
											<td><?= $row->dhl ?></td>
											<td><?= $row->tds ?></td>
											<td><?= $row->tss ?></td>
											<td><?= $row->temp ?></td>
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