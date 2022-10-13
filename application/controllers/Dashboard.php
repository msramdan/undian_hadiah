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
        );
		$this->template->load('template','dashboard', $data);
	}

	public function list_karyawan() {
		$data = $this->Karyawan_model->get_all();
		echo json_encode($data);
	}

}
