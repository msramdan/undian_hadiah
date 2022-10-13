<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Form extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Unit_kerja_model');
        $this->load->model('Jabatan_model');
        $this->load->model('Karyawan_model');
    }

    public function index()
    {
        $data = array(
            'jabatan' => $this->Jabatan_model->get_all(),
            'unit_kerja' => $this->Unit_kerja_model->get_all(),
        );

        $this->load->view('form_datadiri', $data);
    }

    public function create_action()
    {
            $data = array(
                'nama_karyawan' => $this->input->post('nama_karyawan', TRUE),
                'jabatan_id' => $this->input->post('jabatan_id', TRUE),
                'unit_kerja_id' => $this->input->post('unit_kerja_id', TRUE),
                'jenis_kelamin' => $this->input->post('jenis_kelamin', TRUE),
                'no_telpon' => $this->input->post('no_telpon', TRUE),
            );
            $this->Karyawan_model->insert($data);
            $this->session->set_flashdata('message', 'Pendaftaran Undian Doorprize Berhasil');
        redirect(site_url('form'));
    }
}
