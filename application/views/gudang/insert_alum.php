<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title-lift">
				<h3 class="page-header">
					Tambah Data Alum
					</h3>
				</div>
				<div class="clearfix"></div>
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="x_panel">
							<div class="x_content">
								<div><?= $this->session->flashdata('msg') ?></div>
								<?= form_open('gudang/insert-alum') ?>
									<div class="form-grup">
										<label for="jumlah">Jumlah Alum</label>
										<input type="number" name="jumlah" class="form-control">
									</div>
									<input type="submit" class="btn btn-primary" name="tambah" value="Tambah">
								<?= form_close() ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>