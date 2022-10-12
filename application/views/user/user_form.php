<div id="content" class="content">
	<ol class="breadcrumb pull-right">
		<li><a href="<?= base_url() ?>dashboard">Dashboard</a></li>
		<li class="active">User</li>
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
					<h4 class="panel-title">Data USER</h4>
				</div>
				<div class="panel-body">

					<form action="<?php echo $action; ?>" method="post">
						<thead>
							<table id="data-table-default" class="table  table-bordered table-hover table-td-valign-middle">
								<tr>
									<td>Username <?php echo form_error('username') ?></td>
									<td><input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" /></td>
								</tr>
								<tr>
									<td>Password <?php echo form_error('password') ?></td>
									<td><input type="password" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo $password; ?>" /></td>
								</tr>
								<input type="hidden" class="form-control" name="level_id" id="level_id" placeholder="Level Id" value="1" />
								<tr>
									<td></td>
									<td><input type="hidden" name="user_id" value="<?php echo $user_id; ?>" />
										<button type="submit" class="btn btn-danger"><i class="fa fa-save"></i> <?php echo $button ?></button>
										<a href="<?php echo site_url('user') ?>" class="btn btn-info"><i class="fa fa-undo"></i> Kembali</a>
									</td>
								</tr>
						</thead>
						</table>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
