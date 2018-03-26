<?php
	$nama_bulan = [
		'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
	];
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		#bigWrapper{
			width: 100%;
		}
		#header{
			text-align: center;
			font-size: 26px;
			margin-bottom: 50px;
			border-bottom: 5px double black;
			padding-bottom: 15px;
			width: 1332px;
			margin: 0 auto;
			height: 100px;
		}

		.logoo{
			margin-top: -210px;
			width: 100px;
			height: 70px;
			margin-left: 5px;
			margin-right: 40px;
		}
		.logoo img{
			width: 100px;
			height: 50px;
		}
		.title{
			margin: 0 auto;
			margin-top: -80px;
			width: 600px;
			font-size: 18px;
		}
		table,th,td{
			border: 1px solid black;
		}
		table{
			border-collapse: collapse;;
		}
		tr:nth-child(even){
			background-color: #f2f2f2 
		}
		tr:first-child(even){
			width: 40px;
		}
		th{
			background-color: #4CAF50;
			color: white;
			/*min-width:100px;*/
		}
		td{
			padding: 2px;
			padding-left: 10px;
			text-align: center;
		}
		#logo2{
			padding-left: 1000px;
		}
	</style>
</head>
<body style="margin-top: 250px;">
	<div id="bigWrapper">
		<div id="header">
			<div class="logoo">
				<!--<img scr="<? base_url('') ?>assets/img/logo.jpg">-->
			</div>

			<div class="title">
				<strong>
					Laporan Data Alum<br>
					PDAM TirtaMusi<br>
				</strong>
			</div>
			<div class="logoo" id="logo2" style="margin-top: -80px;">
				<!--<img scr="<?= base_url('') ?>assets/img/pdam.png" width="70" height="100">-->
			</div>
		</div>
		<div class="content" style="margin: 0 auto; width: 100%;">
			<p style="margin-top: 50px; width: 100%; font-weight: bold; font-size: 18px; text-align: center; margin-bottom: 30px;">Laporan Data Alum</p>
			<table style="width: 100%;">
				<tr>
					<th>No.</th>
					<th>Tanggal</th>
					<th>Jam</th>
					<th>Stok Alum</th>
					<th>Terpakai</th>
					<th>Ditambahkan oleh</th>
					
				</tr>
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
			</table>
		</div>
	</div>
</body>
</html>