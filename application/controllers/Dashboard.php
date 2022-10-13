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
			'pemenang_list' => $this->Karyawan_model->list_pemenang(),
			'disclass' => $this
        );
		$this->template->load('template','dashboard', $data);
	}

	public function list_karyawanbelummenang() {
		$data = $this->Karyawan_model->karyawan_belum_menang();

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

	public function jumlah_karyawanyangbelummenang() {
		$data = $this->Karyawan_model->karyawan_belum_menang();
		echo count($data);
	}

	public function insert_pemenang() {
		$data = array(
			'karyawan_id' => $this->input->post('id_karyawan'),
		);
		$this->Karyawan_model->insert_pemenang($data);

		$arr = [
			'status' => 'success',
			'message' => 'Data berhasil disimpan'
		];

		echo json_encode($arr);
	}

}
