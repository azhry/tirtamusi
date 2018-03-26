<!DOCTYPE html>
<html lang="en">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UFT-8">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-widht, initial-scale=1">

	<title> <?= $title?></title>
	<!-- Bootsrap-->
	<link href="<?= base_url('assets') ?>/vendors/bootstrap/dist/css/bootstrap.min.css" rel=" stylesheet">
	<!--Font Awesome -->
	<link href="<?= base_url('assets') ?>/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<!--NPogress -->
	<link href="<?= base_url('assets') ?>/vendors/nprogress/nprogress.css" rel="stylesheet">
	<!--Animate.css-->
	<link href="<?= base_url('assets') ?>/vendors/animate.css/animate.min.css" rel="stylesheet">
	<!--Custom Theme Style-->
	<link href="<?= base_url('assets') ?>/build/css/custom.min.css" rel="stylesheet">

	</head>
<body class="login" style="background-image: url(<?= base_url('assets/foto/musi.jpg') ?>); background-repeat: no-repeat; background-size: cover;">
	<div>
	<a class="hiddenanchor" id="signup"></a>
	<a class="hiddenanchor" id="signup"></a>

	<div class="login_wrapper" style="background-color: rgba(0, 0, 0, 0.5); padding-right: 12px; padding-left: 12px; margin-top: 100px;">
	<div class="animate from login_from">
		<section class="login_content">
			<?= form_open('login') ?>
				<h1>Login Form</h1>
				<div>
				<input type="text" class="form-control" placeholder="Nip" name="nip" required />
				</div>
				<div>
				<input type="password" class="form-control" placeholder="Password" name="password" required />
				</div>
				<div style="margin-left: 0px !important;">
					<input type="submit" name="login-submit" value="login" class ="btn btn-lg btn-success btn-block">
				</div>
				<div>
					<a class="reset_pass" href="#">Lost your password?</a>
				</div>

				<div class="clearfix"></div>

				<div class="separator">
					<p class="change_link">Ingin mendaftar ?
						<a href="<?=base_url('login/daftar')?>" class="to_register"> Klik ini!</a>
					</p>

					<div class="clearfix"></div>
					<br />

					</div>
				</form>
			</section>
		</div>
	</div>
</div>
</body>
</html>