<div id="content" class="content">
	<ol class="breadcrumb pull-right">
		<li><a href="javascript:;">Dashboard</a></li>
		<li class="active">Peserta</li>
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
					<h4 class="panel-title">Data Peserta</h4>
				</div>
				<div class="panel-body">

					<form action="<?php echo $action; ?>" method="post">
						<thead>
							<table id="data-table-default" class="table  table-bordered table-hover table-td-valign-middle">
								<tr>
									<td>Nama Peserta <?php echo form_error('nama_karyawan') ?></td>
									<td><input type="text" class="form-control" name="nama_karyawan" id="nama_karyawan" placeholder="Nama Peserta" value="<?php echo $nama_karyawan; ?>" /></td>
								</tr>
								<tr>
									<td>Pekerjaan <?php echo form_error('pekerjaan_id') ?></td>
									<td>
										<select name="pekerjaan_id" class="form-control theSelect">
											<option value="">-- Pilih -- </option>
											<?php foreach ($pekerjaan as $key => $data) { ?>
												<?php if ($pekerjaan_id == $data->pekerjaan_id) { ?>
													<option value="<?php echo $data->pekerjaan_id ?>" selected><?php echo $data->nama_pekerjaan ?></option>
												<?php } else { ?>
													<option value="<?php echo $data->pekerjaan_id ?>"><?php echo $data->nama_pekerjaan ?></option>
												<?php } ?>
											<?php } ?>
										</select>
									</td>
								</tr>
								<tr>
									<td>Instansi <?php echo form_error('instansi') ?></td>
									<td><input type="text" class="form-control" name="instansi" id="instansi" placeholder="Instansi" value="<?php echo $instansi; ?>" /></td>
								</tr>
								<tr>
									<td>Jabatan <?php echo form_error('jabatan') ?></td>
									<td><input type="text" class="form-control" name="jabatan" id="jabatan" placeholder="Jabatan" value="<?php echo $jabatan; ?>" /></td>
								</tr>
								<tr>
									<td>Nomor HP/WA <?php echo form_error('no_telpon') ?></td>
									<td><input type="text" class="form-control" name="no_telpon" id="no_telpon" placeholder="Nomor HP/WA" value="<?php echo $no_telpon; ?>" /></td>
								</tr>
								<tr>
									<td>Email <?php echo form_error('email') ?></td>
									<td><input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" /></td>
								</tr>
								<tr>
									<td></td>
									<td><input type="hidden" name="karyawan_id" value="<?php echo $karyawan_id; ?>" />
										<button type="submit" class="btn btn-danger"><i class="fa fa-save"></i> <?php echo $button ?></button>
										<a href="<?php echo site_url('karyawan') ?>" class="btn btn-info"><i class="fa fa-undo"></i> Kembali</a>
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