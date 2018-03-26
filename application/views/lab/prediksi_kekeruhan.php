<div class="right_col" role="main">
	<div class="pagr-title">
		<div class="title-left">
			<h3 class="page-header"> Prediksi Kekeruhan </h3>
		</div>
		<div class="row">
			<div class="col-md-12 col-xs-12 col-sm-12">
				<div class="x_panel">
					<h2 class="x_title"> Prediksi Kekeruhan</h2>
					<div class="x_content">
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="hari_ke">Hari ke-</label>
									<input type="number" min="1" max="31" name="hari_ke" id="hari_ke" class="form-control">
								</div>
								<div class="form-group">
									<label for="turbidity"> Turbidity</label>
									<input type="number" name="turbidity" id="turbidity" class="form-control" step="0.01">
								</div>
								<button type="button" class="btn btn-primary" onclick="prediksi();"> Prediksi</button>
							</div>
							<div class="col-md-8">
								<div class="row">
									<div class="col-md-6">
										<h3>Hari ke terhadap Dosis Alum</h3>
										<h5 id="s_ahd"></h5>
										<h5 id="s_bhd"></h5>
										<h5 id="s_yhd_rumus"></h5>
										<h4 id="s_yhd_output"></h4>
									</div>
									<div class="col-md-6">
										<h3>Turbidity terhadap Dosis Alum</h3>
										<h5 id="s_atd"></h5>
										<h5 id="s_btd"></h5>
										<h5 id="s_ytd_rumus"></h5>
										<h4 id="s_ytd_output"></h4>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<h3>Hari ke dan Turbidity terhadap Dosis Alum</h3>
										<h5 id="a"></h5>
										<h5 id="b1"></h5>
										<h5 id="b2"></h5>
										<h5 id="rumus"></h5>
										<h4 id="output"></h4>	
									</div>
								</div>

								

								
							</div>
						</div>
						<!-- <div class="row">
							<div class="col-md-12">
								<canvas id="grafik"></canvas>
							</div>
						</div> -->
					</div>
				</div>
			</div>
		</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		// $('#tanggal').datepicker({
		// 	format: 'yyyy-mm-dd'
		// });


	});

	function prediksi(){
		let hari_ke = $( '#hari_ke' ).val();
		if ( hari_ke >= 1 && hari_ke <= 31 ) {
			$.ajax({
			url: '<?= base_url('lab/prediksi') ?>',
			type: 'POST',
			data: {
				prediksi: true,
				hari_ke: $('#hari_ke').val(),
				turbidity: $('#turbidity').val()

			},
			success: function(response) {
				var json = $.parseJSON( response );
				$('#output').text('Dosis Alum: ' + (json.y - 30));
				$( '#s_yhd_output' ).text( 'Dosis Alum: ' + (json.s_yhd - 30) );
				$( '#s_ytd_output' ).text( 'Dosis Alum: ' + (json.s_ytd - 30) );
				$('#rumus').text('y = (Dosis Alum) = ' + json.a + ' + x1 * ' + json.b1 + ' + x2 * ' + json.b2);
				$( '#s_yhd_rumus' ).text( 'y = (Dosis Alum) = ' + json.s_ahd + ' + x * ' + json.s_bhd );
				$( '#s_ytd_rumus' ).text( 'y = (Dosis Alum) = ' + json.s_atd + ' + x * ' + json.s_btd );
				$( '#a' ).text( 'a = ((' + json.sum_res + ' - (' + json.b1 + ' * ' + json.sum_pred1 + ')) - (' + json.b2 + ' * ' + json.sum_pred2 + ')) / ' + json.num_rows );
				$( '#s_ahd' ).text( 'a = ((' + json.s_sum_res_hd + ' - (' + json.s_bhd + ' * ' + json.s_sum_pred_hd + '))) / ' + json.s_num_rows_hd );
				$( '#s_atd' ).text( 'a = ((' + json.s_sum_res_td + ' - (' + json.s_btd + ' * ' + json.s_sum_pred_td + '))) / ' + json.s_num_rows_td );
				var denominator = ((json.fixed_sum_pred1 * json.fixed_sum_pred2) - json.fixed_sum_product_pred1_pred2 * json.fixed_sum_product_pred1_pred2);
				if ( denominator == 0 )
					$( '#b1' ).text( 'b1 = 0' );
				else
					$( '#b1' ).text( 'b1 = ((' + json.fixed_sum_pred2 + ' * ' + json.fixed_sum_product_pred1_res + ') - (' + json.fixed_sum_product_pred2_res + ' * ' + json.fixed_sum_product_pred1_pred2 + ')) / ' + denominator );

				$( '#s_bhd' ).text( 'b = ((' + json.s_num_rows_hd + ' * ' + json.s_sum_pred_res_hd + ') - (' + json.s_sum_pred_hd + ' * ' + json.s_sum_res_hd + ')) / (' + json.s_num_rows_hd + ' * ' + json.s_sum_squared_pred_hd + ' - ' + json.s_sum_pred_hd + ' * ' + json.s_sum_pred_hd + ')' );

				var denominator = ((json.fixed_sum_pred1 * json.fixed_sum_pred2) - json.fixed_sum_product_pred1_pred2 * json.fixed_sum_product_pred1_pred2);
				if ( denominator == 0 )
					$( '#b2' ).text( 'b2 = 0' );
				else
					$( '#b2' ).text( 'b2 = ((' + json.fixed_sum_pred1 + ' * ' + json.fixed_sum_product_pred2_res + ') - (' + json.fixed_sum_product_pred1_res + ' * ' + json.fixed_sum_product_pred1_pred2 + ')) / ' + denominator );

				$( '#s_btd' ).text( 'b = ((' + json.s_num_rows_td + ' * ' + json.s_sum_pred_res_td + ') - (' + json.s_sum_pred_td + ' * ' + json.s_sum_res_td + ')) / (' + json.s_num_rows_td + ' * ' + json.s_sum_squared_pred_td + ' - ' + json.s_sum_pred_td + ' * ' + json.s_sum_pred_td + ')' );
			},
			error: function(err) { console.log(err.responseText); }
		});
		} else {
			alert( 'Hari ke harus berada diantara 1 dan 31' );
		}
		
		return false;
	}

	
</script>