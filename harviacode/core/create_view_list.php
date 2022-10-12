<?php 

$string = "<div id=\"content\" class=\"content\">
<ol class=\"breadcrumb pull-right\">
	<li><a href=\"javascript:;\">Dashboard</a></li>
	<li class=\"active\">".  ucfirst($table_name)."</li>
</ol>
<div class=\"row\">
	<div class=\"col-md-12\">
		<div class=\"panel panel-inverse\">
			<div class=\"panel-heading\">
				<div class=\"panel-heading-btn\">
					<a href=\"javascript:;\" class=\"btn btn-xs btn-icon btn-circle btn-default\" data-click=\"panel-expand\"><i class=\"fa fa-expand\"></i></a>
					<a href=\"javascript:;\" class=\"btn btn-xs btn-icon btn-circle btn-success\" data-click=\"panel-reload\"><i class=\"fa fa-repeat\"></i></a>
					<a href=\"javascript:;\" class=\"btn btn-xs btn-icon btn-circle btn-warning\" data-click=\"panel-collapse\"><i class=\"fa fa-minus\"></i></a>
					<a href=\"javascript:;\" class=\"btn btn-xs btn-icon btn-circle btn-danger\" data-click=\"panel-remove\"><i class=\"fa fa-times\"></i></a>
				</div>
				<h4 class=\"panel-title\">Data ".  ucfirst($table_name)."</h4>
			</div>
			<div class=\"panel-body\">
                    <div class=\"row\">
                        <div class=\"col-md-12 col-sm-12 col-xs-12\">
                            <div class=\"x_panel\">        
                                <div class=\"box-body\">
                                    <div class='row'>
                                        <div class='col-md-9'>
                                            <div style=\"padding-bottom: 10px;\">
        <?php echo anchor(site_url('".$c_url."/create'), '<i class=\"fa fa-plus-square\" aria-hidden=\"true\"></i> Tambah Data', 'class=\"btn btn-danger btn-sm tambah_data\"'); ?>";
if ($export_excel == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/excel'), '<i class=\"far fa-file-excel\" aria-hidden=\"true\"></i> Export Ms Excel', 'class=\"btn btn-success btn-sm export_data\"'); ?>";
}
if ($export_word == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/word'), '<i class=\"fa fa-file-word-o\" aria-hidden=\"true\"></i> Export Ms Word', 'class=\"btn btn-primary btn-sm\"'); ?>";
}
if ($export_pdf == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/pdf'), 'PDF', 'class=\"btn btn-primary\"'); ?>";
}
$string.="
                </div>
            </div>
        </div>    
        <div class=\"box-body\" style=\"overflow-x: scroll; \">
        <table id=\"data-table\" class=\"table table-bordered table-hover table-td-valign-middle\">
         <thead>
            <tr>
                <th>No</th>";
foreach ($non_pk as $row) {
    $string .= "\n\t\t<th>" . label($row['column_name']) . "</th>";
}
$string .= "\n\t\t<th>Action</th>
            </tr></thead><tbody>";
$string .= "<?php \$no = 1;
            foreach ($" . $c_url . "_data as \$$c_url)
            {
                ?>
                <tr>";

$string .= "\n\t\t\t<td><?= \$no++?></td>";
foreach ($non_pk as $row) {
    $string .= "\n\t\t\t<td><?php echo $" . $c_url ."->". $row['column_name'] . " ?></td>";
}


$string .= "\n\t\t\t<td style=\"text-align:center\" width=\"200px\">"
        . "\n\t\t\t\t<?php "
        . "\n\t\t\t\techo anchor(site_url('".$c_url."/read/'.encrypt_url($".$c_url."->".$pk.")),'<i class=\"fa fa-eye\" aria-hidden=\"true\"></i>','class=\"btn btn-success btn-sm read_data\"'); "
        . "\n\t\t\t\techo '  '; "
        . "\n\t\t\t\techo anchor(site_url('".$c_url."/update/'.encrypt_url($".$c_url."->".$pk.")),'<i class=\"fa fa-pencil\" aria-hidden=\"true\"></i>','class=\"btn btn-primary btn-sm update_data\"'); "
        . "\n\t\t\t\techo '  '; "
        . "\n\t\t\t\techo anchor(site_url('".$c_url."/delete/'.encrypt_url($".$c_url."->".$pk.")),'<i class=\"fa fa-trash\" aria-hidden=\"true\"></i>','class=\"btn btn-danger btn-sm delete_data\" Delete','onclick=\"javasciprt: return confirm(\\'Are You Sure ?\\')\"'); "
        . "\n\t\t\t\t?>"
        . "\n\t\t\t</td>";

$string .=  "\n\t\t</tr>
                <?php } ?>
            </tbody>
        </table>
                ";

$string .= "\n\t  </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>"
;



$hasil_view_list = createFile($string, $target."views/" . $c_url . "/" . $v_list_file);

?>

