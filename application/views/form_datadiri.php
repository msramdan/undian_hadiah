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

    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="<?= base_url() ?>temp/assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
    <link href="<?= base_url() ?>temp/assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
    <!-- ================== END PAGE LEVEL STYLE ================== -->

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="<?= base_url() ?>temp/assets/plugins/pace/pace.min.js"></script>
    <!-- ================== END BASE JS ================== -->
</head>

<body>


    <!-- begin #page-container -->
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
    <?php if ($this->session->flashdata('message')) : ?>
    <?php endif; ?>

    <div class="flash-data2" data-flashdata2="<?= $this->session->flashdata('error'); ?>"></div>
    <?php if ($this->session->flashdata('error')) : ?>
    <?php endif; ?>

    <div id="page-container" class="page-container">
        <div id="content" class="content offset-md-2">
            <div class="row">
                <div class="col-md-offset-2 col-md-6 ">
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-3">
                        <div class="panel-body">
                            <img src="<?= base_url() ?>temp/assets/gambar1.png" style="width: 100%;" />
                            <img src="<?= base_url() ?>temp/assets/gambar2.png" style="width: 100%;" />

                            <hr>

                            <form action="<?= base_url() ?>form/create_action" method="POST" style="padding: 10px;">
                                <div class="form-group">
                                    <label for="nik">NIK</label>
                                    <input type="number" class="form-control" id="nik" name="nik" placeholder="" required>
                                </div>
                                <div class="form-group">
                                    <label for="nama_karyawan">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="nama_karyawan" id="nama_karyawan" placeholder="" required>
                                </div>
                                <div class="form-group">
                                    <label for="jabatan_id">Jabatan</label>
                                    <select name="jabatan_id" class="form-control theSelect" required>
                                        <option value="">-- Pilih -- </option>
                                        <?php foreach ($jabatan as $key => $data) { ?>
                                            <option value="<?php echo $data->jabatan_id ?>"><?php echo $data->nama_jabatan ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="unit_kerja_id">Unit Kerja</label>
                                    <select name="unit_kerja_id" class="form-control theSelect" required>
                                        <option value="">-- Pilih -- </option>
                                        <?php foreach ($unit_kerja as $key => $data) { ?>
                                            <option value="<?php echo $data->unit_kerja_id ?>"><?php echo $data->nama_unit_kerja ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="form-control theSelect" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="Perempuan">Perempuan</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="no_telpon">No Telpon</label>
                                    <input type="text" name="no_telpon" class="form-control" id="no_telpon" placeholder="" required>
                                </div>
                                <button type="submit" class="btn btn-sm btn-primary m-r-5"><i class="fa fa-floppy-o" aria-hidden="true"></i> Kirim</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
    </div>
    <!-- end page container -->

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="<?= base_url() ?>temp/assets/plugins/jquery/jquery-1.9.1.min.js"></script>
    <script src="<?= base_url() ?>temp/assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
    <script src="<?= base_url() ?>temp/assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
    <script src="<?= base_url() ?>temp/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>temp/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?= base_url() ?>temp/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>temp/assets/js/sweetalert.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>temp/assets/js/sweetalert.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="<?= base_url(); ?>temp/assets/js/dataflash.js"></script>
    <!-- ================== END BASE JS ================== -->

    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src="<?= base_url() ?>temp/assets/plugins/DataTables/media/js/jquery.dataTables.js"></script>
    <script src="<?= base_url() ?>temp/assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js"></script>
    <script src="<?= base_url() ?>temp/assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url() ?>temp/assets/js/table-manage-default.demo.min.js"></script>
    <script src="<?= base_url() ?>temp/assets/js/apps.min.js"></script>
    <!-- ================== END PAGE LEVEL JS ================== -->
    <script>
        $(document).ready(function() {
            App.init();
            TableManageDefault.init();
        });
    </script>
</body>

</html>