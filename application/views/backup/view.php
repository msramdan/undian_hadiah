<div id="content" class="content">
	<ol class="breadcrumb pull-right">
		<li><a href="<?= base_url() ?>dashboard">Dashboard</a></li>
		<li class="active">Backup</li>
	</ol>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
					<h4 class="panel-title">Backup Database</h4>
				</div>
				<div class="panel-body">
					<div class="alert alert-success fade in m-b-15" style="display: none;" id="alert-box">
						<i class="fa fa-check"></i> <strong>Success!</strong>
						Berhasil mencadangkan database
						<span class="close" data-dismiss="alert">×</span>
					</div>


					<center>
						<a href="<?= site_url(); ?>backup/file" class="btn btn-primary btn-raised btn-lg" onclick="alert()"><i class="fa fa-download"></i> Back Up DataBase</a>
					</center>
				</div>

			</div>

		</div>
	</div>
</div>

<script type="text/javascript">
	function alert() {
		$("#alert-box").css({
			"display": "block"
		});
	}
</script>
