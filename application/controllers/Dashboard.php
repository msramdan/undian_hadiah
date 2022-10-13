<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Dashboard extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        is_login();
		$this->load->model('Karyawan_model');
		// check_admin();
    }

	public function index()
	{
		$data = array(
            'karyawan_data' => $this->Karyawan_model->get_all(),
			'disclass' => $this
        );
		$this->template->load('template','dashboard', $data);
	}

	public function list_spinwheeldata() {
		$data = $this->Karyawan_model->get_all();

		$arrppl = [];

		foreach($data as $v) {
			$arrppl[] = [
				'id_karyawan' => $v->karyawan_id,
				'fillStyle' => sprintf('#%06X', mt_rand(0, 0xFFFFFF)),
				'text' => $v->nama_karyawan
			];
		}

		echo json_encode($arrppl);
	}

	public function jumlah_karyawan() {
		$data = $this->Karyawan_model->get_all();
		echo count($data);
	}

}
