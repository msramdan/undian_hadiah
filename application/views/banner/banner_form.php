<div id="content" class="content">
	<ol class="breadcrumb pull-right">
		<li><a href="javascript:;">Dashboard</a></li>
		<li class="active">Banner</li>
	</ol>
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
					<h4 class="panel-title">Data BANNER</h4>
				</div>
				<div class="panel-body">

					<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
						<thead>
							<table id="data-table-default" class="table  table-bordered table-hover table-td-valign-middle"  >
									<div class="form-group">
										<tr>
											<td>
												<a href="#modal-dialog" data-bs-toggle="modal"><img src="<?php echo base_url(); ?>temp/assets/banner/<?= $photo ?>" style="width: 100%;height: auto;border-radius: 1%;" ></img></a>
												<input type="hidden" name="photo_lama" value="<?= $photo ?>">
												<p style="color: red">Note :Pilih Banner Jika Ingin Merubahnya</p>
												<input type="file" class="form-control" name="photo" id="photo" placeholder="photo" value="" required  />
												<!-- <div id="preview"></div> -->
											</td>

										</tr>
									</div>
								<tr>
									<td><input type="hidden" name="banner_id" value="<?php echo $banner_id; ?>" />
										<button type="submit" class="btn btn-danger"><i class="fa fa-save"></i> <?php echo $button ?></button>
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