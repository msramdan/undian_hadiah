<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Qr extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Banner_model');
    }

    public function index()
    {
        
        $data = array(
            'banner' => $this->Banner_model->get_by_id(1),
        );
        $this->template->load('template', 'qr/index', $data);
    }
}
