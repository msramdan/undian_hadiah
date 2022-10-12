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
<table id=\"data-table-default\" class=\"table table-hover table-bordered table-td-valign-middle\">";
foreach ($non_pk as $row) {
    $string .= "\n\t    <tr><td>".label($row["column_name"])."</td><td><?php echo $".$row["column_name"]."; ?></td></tr>";
}
$string .= "\n\t    <tr><td></td><td><a href=\"<?php echo site_url('".$c_url."') ?>\" class=\"btn btn-default\">Cancel</a></td></tr>";
$string .= "\n\t</table>
			</div>
        </div>
    </div>
	</div>
</div>";



$hasil_view_read = createFile($string, $target."views/" . $c_url . "/" . $v_read_file);

?>
