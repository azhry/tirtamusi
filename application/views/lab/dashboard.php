<div class="right_col" role="main">
	<div class="">
		<div class="row_top_tiles">
			<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<a href="<?= base_url('lab/kualitas_air') ?>">
					<div class="tile-stats">
						<div class="icon"><i class="fa fa-users"></i></div>
						<div class="count"><?= count($kualitas_air) ?></div>
						<h3>Data Kualitas Air</h3>
					</div>
				</a>
			</div>

		
			<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<a href="<?= base_url('lab/parameter-uji') ?>">
					<div class="tile-stats">
						<div class="icon"><i class="fa fa-archive"></i></div>
						<div class="count"><?= count($parameter_uji) ?></div>
						<h3>Proses Koagulasi</h3>
					</div>
				</a>
			</div>
			<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<a href="<?= base_url('lab/grafik') ?>">
					<div class="tile-stats">
						<div class="icon"><i class="fa fa-line-chart"></i></div>
						<div class="count"><?= count($prediksi_kekeruhan) ?></div>
						<h3>Grafik</h3>
					</div>
				</a>
			</div>
		
			<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<a href="<?= base_url('lab/prediksi') ?>">
					<div class="tile-stats">
						<div class="icon"><i class="fa fa-archive"></i></div>
						<div class="count"><?= count($prediksi_kekeruhan) ?></div>
						<h3>Data Prediksi</h3>
					</div>
					</a>
					</div>
			
		</div>
	</div>
</div>