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
        // $jabatan = $this->jabatan_model->get_all();
        $data = array(
            // 'jabatan_data' => $jabatan,
        );
        $this->template->load('template', 'qr/index', $data);
    }
}
