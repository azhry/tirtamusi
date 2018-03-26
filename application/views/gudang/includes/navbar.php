<!-- tob Navigation -->
<div class="top_nav">
	<div class="nav_menu">
	<nav>
		<div class="nav toggle">
			<a id="menu_toggle"><i class="fa fa-bars"></i></a>
			</div>
			<ul class="nav navbar-nav navbar-right">
				<li class="">
					<a href="javascript:;" class="user-profil dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
						<i class="fa fa-user"></i> <?=$nip ?>
						<span class=" fa fa-angle-down"></span>
					</a>
					<ul class="dropdown-menu dropdown-username pull-right">
						<li><a href="<?= base_url('logout') ?>"><i class="fa fa-sign-out"></i> LogOut</a></li>
					</ul>
				</li>
				<li><a href="<?= base_url() ?>"><h5>PDAM Tirta Musi</h5></a></li>
			</ul>
			</nav>
		</div>
	</div>
	<!-- /top navigatior-->