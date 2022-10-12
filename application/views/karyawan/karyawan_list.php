<div class="modal fade" id="modal-dialog-import">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">Import Data Karyawan</h4><br>
				<a href="<?= base_url() ?>format-upload-karyawan.xlsx" type="button" class="btn btn-success">Download Format Upload</a>
			</div>
			<div class="modal-body">
				<form action="<?= base_url() ?>karyawan/import" method="POST" enctype="multipart/form-data">
					<div class="modal-body">
						<div class="form-group">
							<label for="exampleInputEmail1">File Excel</label>
							<input id="file" class="form-control" name="upload_file" type="file">
						</div>
					</div>
					<div class="modal-footer">
						<a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
						<button type="submit" class="btn btn-sm btn-success">Upload</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<div id="content" class="content">
	<ol class="breadcrumb pull-right">
		<li><a href="javascript:;">Dashboard</a></li>
		<li class="active">Karyawan</li>
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
					<h4 class="panel-title">Data Karyawan</h4>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="x_panel">
								<div class="box-body">
									<div class='row'>
										<div class='col-md-9'>
											<div style="padding-bottom: 10px;">
												<?php echo anchor(site_url('karyawan/create'), '<i class="fa fa-plus-square" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm tambah_data"'); ?>

												<a href="#modal-dialog-import" class="btn btn-sm btn-success" data-toggle="modal">Import Excel</a>
											</div>
										</div>
									</div>
									<div class="box-body" style="overflow-x: scroll; ">
										<table id="data-table" class="table table-bordered table-hover table-td-valign-middle">
											<thead>
												<tr>
													<th>No</th>
													<th>Nik</th>
													<th>Nama Karyawan</th>
													<th>Jabatan</th>
													<th>Unit Kerja</th>
													<th>Jenis Kelamin</th>
													<th>No Telpon</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody><?php $no = 1;
													foreach ($karyawan_data as $karyawan) {
													?>
													<tr>
														<td><?= $no++ ?></td>
														<td><?php echo $karyawan->nik ?></td>
														<td><?php echo $karyawan->nama_karyawan ?></td>
														<td><?php echo $karyawan->nama_jabatan ?></td>
														<td><?php echo $karyawan->nama_unit_kerja ?></td>
														<td><?php echo $karyawan->jenis_kelamin ?></td>
														<td><?php echo $karyawan->no_telpon ?></td>
														<td style="text-align:center" width="200px">
															<?php

															echo anchor(site_url('karyawan/update/' . encrypt_url($karyawan->karyawan_id)), '<i class="fa fa-pencil" aria-hidden="true"></i>', 'class="btn btn-primary btn-sm update_data"');
															echo '  ';
															echo anchor(site_url('karyawan/delete/' . encrypt_url($karyawan->karyawan_id)), '<i class="fa fa-trash" aria-hidden="true"></i>', 'class="btn btn-danger btn-sm delete_data" Delete', 'onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
															?>
														</td>
													</tr>
												<?php } ?>
											</tbody>
										</table>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>