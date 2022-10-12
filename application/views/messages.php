<?php if ($this->session->has_userdata('gagal')) { ?>
	<div class="alert alert-danger fade in m-b-15">
		<strong>Failed!</strong>
		<?= $this->session->flashdata('gagal'); ?>
		<span class="close" data-dismiss="alert">×</span>
	</div>


<?php } ?>
