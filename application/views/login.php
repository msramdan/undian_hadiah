<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<title>Aplikasi Undian Doorprize</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />

	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
	<link href="<?= base_url() ?>temp/assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="<?= base_url() ?>temp/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="<?= base_url() ?>temp/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="<?= base_url() ?>temp/assets/css/animate.min.css" rel="stylesheet" />
	<link href="<?= base_url() ?>temp/assets/css/style.min.css" rel="stylesheet" />
	<link href="<?= base_url() ?>temp/assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="<?= base_url() ?>temp/assets/css/theme/default.css" rel="stylesheet" id="theme" />
	<!-- ================== END BASE CSS STYLE ================== -->

	<!-- ================== BEGIN BASE JS ================== -->
	<script src="<?= base_url() ?>temp/assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
</head>

<body class="pace-top">

	<div class="login-cover">
		<div class="login-cover-image"><img src="<?= base_url() ?>temp/assets/img/login-bg/bg-2.jpg" data-id="login-cover-image" alt="" /></div>
		<div class="login-cover-bg"></div>
	</div>
	<!-- begin #page-container -->
	<div id="page-container" class="fade">
		<!-- begin login -->
		<div class="login login-v2" data-pageload-addclass="animated fadeIn">
			<!-- begin brand -->
			<div class="login-header">
				<div class="brand">
					<span class="logo"></span> Halaman Login
					<small>Aplikasi Undian Doorprize</small>
				</div>
				<div class="icon">
					<i class="fa fa-sign-in"></i>
				</div>
			</div>
			<!-- end brand -->
			<div class="login-content">
			<?php $this->view('messages') ?>
				<form action="<?= site_url('auth/process') ?>" method="POST" class="margin-bottom-0">
					<div class="form-group m-b-20">
						<input type="text" name="username" class="form-control input-lg" placeholder="Username" required />
					</div>
					<div class="form-group m-b-20">
						<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" required />
					</div>
					<div class="checkbox m-b-20">
						<label>
							<input type="checkbox" value="1" id="rememberMe" onclick="myFunction()" /> Lihat Password
						</label>
					</div>
					<div class="login-buttons">
						<button type="submit" name="login" class="btn btn-success btn-block btn-lg">Sign In</button>
					</div>

				</form>
			</div>
		</div>
		<!-- end login -->
	</div>
	<!-- end page container -->

	<!-- ================== BEGIN BASE JS ================== -->
	<script src="<?= base_url() ?>temp/assets/plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="<?= base_url() ?>temp/assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="<?= base_url() ?>temp/assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
	<script src="<?= base_url() ?>temp/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?= base_url() ?>temp/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="<?= base_url() ?>temp/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
	<!-- ================== END BASE JS ================== -->

	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="<?= base_url() ?>temp/assets/js/login-v2.demo.min.js"></script>
	<script src="<?= base_url() ?>temp/assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	<script>
		$(document).ready(function() {
			App.init();
			LoginV2.init();
		});
	</script>
	<script>
		function myFunction() {
			var x = document.getElementById("password");
			if (x.type === "password") {
				x.type = "text";
			} else {
				x.type = "password";
			}
		}
	</script>
</body>

</html>
