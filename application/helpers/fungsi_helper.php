<?php
date_default_timezone_set('Asia/Jayapura');

function check_already_login()
{
	$ci = &get_instance();
	$user_session = $ci->session->userdata('userid');
	if ($user_session) {
		redirect('dashboard');
	}
}

function is_login()
{
	$ci = &get_instance();
	$user_session = $ci->session->userdata('userid');
	if (!$user_session) {
		redirect('auth');
	}
}

function check_admin()
{
	$ci = &get_instance();
	$ci->load->library('fungsi');
	if ($ci->fungsi->user_login()->level_id != 1) {
		redirect('dashboard_user');
	}
}

function getNilai($karyawan_id, $kategori_id, $priode)
{
	$ci = &get_instance();

	$jml = $ci->db->query("SELECT * FROM nilai WHERE karyawan_id ='$karyawan_id' AND kategori_id ='$kategori_id' AND priode ='$priode'");

	if ($jml->num_rows() == 0) {
		$value = 0;
	} else {
		$x = $jml->row();
		$value = $x->nilai;
	}
	return $value;
}
