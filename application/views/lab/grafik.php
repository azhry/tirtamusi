<div class="right_col" role="main">
	<div class="pagr-title">
		<div class="title-left">
			<h3 class="page-header"> Grafik </h3>
		</div>
		<div class="row">
			<div class="col-md-12 col-xs-12 col-sm-12">
				<div class="x_panel">
					<h2 class="x_title"> Grafik</h2>
					<div class="x_content">
						<div class="row">
							<div class="col-md-12">
								<h5>Root Mean Squared Error: <?= round($RMSE * 100, 2) . '%' ?></h5>
								<canvas id="grafik-asli"></canvas>
								<h5 class="text-center">Hari ke-</h5>
								<canvas id="grafik-palsu"></canvas>
								<h5 class="text-center">Turbidity</h5>
								<canvas id="grafik-hari-ke"></canvas>
								<h5 class="text-center">Hari ke-</h5>
								<canvas id="grafik-turbidity"></canvas>
								<h5 class="text-center">Turbidity</h5>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		
		var config = {
			type: 'line',
			data:{
				labels: [
					<?php foreach ($uji as $row): ?>
						<?= $row->hari_ke . ',' ?>
					<?php endforeach; ?>
				],
				datasets:[{
					label: 'Aktual',
					backgroundColor: 'rgb(225,0,0)',
					borderColor: 'rgb(225,0,0)',
					fill: false,
					data:[
						<?php $x = []; foreach ( $uji as $row ): ?>
							<?php $x []= $row->dosis_alum;  ?>
							<?= $row->dosis_alum . ',' ?>
						<?php endforeach; ?>
					]
				},{
					label: 'Terprediksi',
					backgroundColor: 'rgb(0,0,255)',
					borderColor: 'rgb(0,0,255)',
					fill: false,
					data:[
						<?php $x = []; foreach ( $terprediksi as $row ): ?>
							<?php $x []= $row['dosis_alum'];  ?>
							<?= $row['dosis_alum'] . ',' ?>
						<?php endforeach; ?>
					]
				}]

			},
			options: {
				responsive: true,
				title:{
					display: true,
					text: 'Data Regresi Hari-ke dan Turbidity Terhadap Dosis Alum Jika Sumbu X Merupakan Hari ke-'
				},
				scales: {
					yAxes: [{
                        display: true,
                        ticks: {
                            beginAtZero: true,
                            steps: 5,
                            stepValue: 5,
                            max: <?= max($x) + 5 ?>,
                            min: <?= min($x) - 5 ?>
                        }
                    }]
				}
			}
		};

		var ctx = document.getElementById('grafik-asli').getContext('2d');
		new Chart(ctx, config);

		var config2 = {
			type: 'line',
			data:{
				labels: [
					<?php $x = []; foreach ( $uji2 as $row ): ?>
						<?php $x []= $row->turb;  ?>
						<?= round($row->turb, 2) . ',' ?>
					<?php endforeach; ?>	
				],
				datasets:[{
					label: 'Aktual',
					backgroundColor: 'rgb(225,0,0)',
					borderColor: 'rgb(225,0,0)',
					fill: false,
					data:[
						<?php $x = []; foreach ( $uji2 as $row ): ?>
							<?php $x []= $row->dosis_alum;  ?>
							<?= $row->dosis_alum . ',' ?>
						<?php endforeach; ?>
					]
				}, {
					label: 'Terprediksi',
					backgroundColor: 'rgb(0,0,255)',
					borderColor: 'rgb(0,0,255)',
					fill: false,
					data:[
						<?php $x = []; foreach ( $terprediksi2 as $row ): ?>
							<?php $x []= $row['dosis_alum'];  ?>
							<?= $row['dosis_alum'] . ',' ?>
						<?php endforeach; ?>
					]
				}]
			},
			options: {
				responsive: true,
				title:{
					display: true,
					text: 'Data Regresi Hari-ke dan Turbidity Terhadap Dosis Alum Jika Sumbu X Merupakan Turbidity'
				},
				scales: {
					yAxes: [{
                        display: true,
                        ticks: {
                            beginAtZero: true,
                            steps: 5,
                            stepValue: 5,
                            max: <?= max($x) + 5 ?>,
                            min: <?= min($x) - 5 ?>
                        }
                    }],
                    xAxes: [{
                    	display: true,
                    	ticks: {
                    		beginAtZero: true,
                    		steps: 2,
                    		stepValue: 2,
                    		max: <?= max($x) + 2 ?>
                    	}
                    }]
				}
			}
		};


		var ctx2 = document.getElementById('grafik-palsu').getContext('2d');
		new Chart(ctx2, config2);


		var config3 = {
			type: 'line',
			data:{
				labels: [
					<?php $x = []; foreach ( $uji3 as $row ): ?>
						<?php $x []= $row->turb;  ?>
						<?= round($row->turb, 2) . ',' ?>
					<?php endforeach; ?>	
				],
				datasets:[{
					label: 'Aktual',
					backgroundColor: 'rgb(225,0,0)',
					borderColor: 'rgb(225,0,0)',
					fill: false,
					data:[
						<?php $x = []; foreach ( $uji3 as $row ): ?>
							<?php $x []= $row->dosis_alum;  ?>
							<?= $row->dosis_alum . ',' ?>
						<?php endforeach; ?>
					]
				}, {
					label: 'Terprediksi',
					backgroundColor: 'rgb(0,0,255)',
					borderColor: 'rgb(0,0,255)',
					fill: false,
					data:[
						<?php $x = []; foreach ( $terprediksi3 as $row ): ?>
							<?php $x []= $row['dosis_alum'];  ?>
							<?= $row['dosis_alum'] . ',' ?>
						<?php endforeach; ?>
					]
				}]
			},
			options: {
				responsive: true,
				title:{
					display: true,
					text: 'Data Regresi Turbidity Terhadap Dosis Alum'
				},
				scales: {
					yAxes: [{
                        display: true,
                        ticks: {
                            beginAtZero: true,
                            steps: 5,
                            stepValue: 5,
                            max: <?= max($x) + 5 ?>,
                            min: <?= min($x) - 5 ?>
                        }
                    }],
                    xAxes: [{
                    	display: true,
                    	ticks: {
                    		beginAtZero: true,
                    		steps: 2,
                    		stepValue: 2,
                    		max: <?= max($x) + 2 ?>
                    	}
                    }]
				}
			}
		};


		var ctx3 = document.getElementById('grafik-turbidity').getContext('2d');
		new Chart(ctx3, config3);


		var config4 = {
			type: 'line',
			data:{
				labels: [
					<?php $x = []; foreach ( $uji4 as $row ): ?>
						<?php $x []= $row->hari_ke;  ?>
						<?= round($row->hari_ke, 2) . ',' ?>
					<?php endforeach; ?>	
				],
				datasets:[{
					label: 'Aktual',
					backgroundColor: 'rgb(225,0,0)',
					borderColor: 'rgb(225,0,0)',
					fill: false,
					data:[
						<?php $x = []; foreach ( $uji4 as $row ): ?>
							<?php $x []= $row->dosis_alum;  ?>
							<?= $row->dosis_alum . ',' ?>
						<?php endforeach; ?>
					]
				}, {
					label: 'Terprediksi',
					backgroundColor: 'rgb(0,0,255)',
					borderColor: 'rgb(0,0,255)',
					fill: false,
					data:[
						<?php $x = []; foreach ( $terprediksi4 as $row ): ?>
							<?php $x []= $row['dosis_alum'];  ?>
							<?= $row['dosis_alum'] . ',' ?>
						<?php endforeach; ?>
					]
				}]
			},
			options: {
				responsive: true,
				title:{
					display: true,
					text: 'Data Regresi Hari Ke- Terhadap Dosis Alum'
				},
				scales: {
					yAxes: [{
                        display: true,
                        ticks: {
                            beginAtZero: true,
                            steps: 5,
                            stepValue: 5,
                            max: <?= max($x) + 5 ?>,
                            min: <?= min($x) - 5 ?>
                        }
                    }],
                    xAxes: [{
                    	display: true,
                    	ticks: {
                    		beginAtZero: true,
                    		steps: 2,
                    		stepValue: 2,
                    		max: <?= max($x) + 2 ?>
                    	}
                    }]
				}
			}
		};


		var ctx4 = document.getElementById('grafik-hari-ke').getContext('2d');
		new Chart(ctx4, config4);

	});

	
</script>