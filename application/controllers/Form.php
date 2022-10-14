<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Form extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Pekerjaan_model');
        $this->load->model('Karyawan_model');
    }

    public function index()
    {
        $data = array(
            'pekerjaan' => $this->Pekerjaan_model->get_all(),
        );

        $this->load->view('form_datadiri', $data);
    }

    public function create_action()
    {
            $data = array(
                'nama_karyawan' => $this->input->post('nama_karyawan', TRUE),
                'pekerjaan_id' => $this->input->post('pekerjaan_id', TRUE),
                'jabatan' => $this->input->post('jabatan', TRUE),
                'no_telpon' => $this->input->post('no_telpon', TRUE),
                'instansi' => $this->input->post('instansi', TRUE),
                'email' => $this->input->post('email', TRUE),
            );
            $this->Karyawan_model->insert($data);
            $this->session->set_flashdata('message', 'Pendaftaran Undian Doorprize Berhasil');
        redirect(site_url('form'));
    }
}
