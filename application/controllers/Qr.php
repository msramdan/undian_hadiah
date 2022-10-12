<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Qr extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        is_login();
        // $unit_kerja = $this->Unit_kerja_model->get_all();
        $data = array(
            // 'unit_kerja_data' => $unit_kerja,
        );
        $this->template->load('template', 'qr/index', $data);
    }
}
