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
			'karyawan_data' =>  $this->Karyawan_model->get_all(),
			'disclass' => $this
        );
		$this->template->load('template','dashboard', $data);
	}

	public function list_karyawanbelummenang() {
		$data = $this->Karyawan_model->karyawan_belum_menang();

		$arrppl = [];

		function adjustBrightness($hexCode, $adjustPercent) {
			$hexCode = ltrim($hexCode, '#');
		
			if (strlen($hexCode) == 3) {
				$hexCode = $hexCode[0] . $hexCode[0] . $hexCode[1] . $hexCode[1] . $hexCode[2] . $hexCode[2];
			}
		
			$hexCode = array_map('hexdec', str_split($hexCode, 2));
		
			foreach ($hexCode as & $color) {
				$adjustableLimit = $adjustPercent < 0 ? $color : 255 - $color;
				$adjustAmount = ceil($adjustableLimit * $adjustPercent);
		
				$color = str_pad(dechex($color + $adjustAmount), 2, '0', STR_PAD_LEFT);
			}
		
			return '#' . implode($hexCode);
		}

		foreach($data as $v) {
			$arrppl[] = [
				'id_karyawan' => $v->karyawan_id,
				'fillStyle' => adjustBrightness(sprintf('#%06X', mt_rand(0, 0xFFFFFF)), 0.5),
				'text' => $v->nama_karyawan
			];
		}

		echo json_encode($arrppl);
	}

	public function list_karyawanmenang() {
		$data = $this->Karyawan_model->list_pemenang();

		echo json_encode($data);
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

	public function delete_pemenang() {
		$id = $this->input->post('id_karyawan');
		$data_karyawan = $this->Karyawan_model->get_by_id($id);
		$this->Karyawan_model->delete_pemenang($id);

		$arr = [
			'karyawan_id' => $data_karyawan->karyawan_id,
			'nama_karyawan' => $data_karyawan->nama_karyawan,
			'status' => 'success',
			'message' => 'Data berhasil dihapus'
		];

		echo json_encode($arr);
	}

	public function delete_all() {
		$this->Karyawan_model->delete_all();

		$arr = [
			'status' => 'success',
			'message' => 'Data berhasil dihapus'
		];

		echo json_encode($arr);
	}

}
