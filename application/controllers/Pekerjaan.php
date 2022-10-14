<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pekerjaan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // is_login();
        $this->load->model('Pekerjaan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $pekerjaan = $this->Pekerjaan_model->get_all();
        $data = array(
            'pekerjaan_data' => $pekerjaan,
        );
        $this->template->load('template','pekerjaan/pekerjaan_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Pekerjaan_model->get_by_id(decrypt_url($id));
        if ($row) {
            $data = array(
		'pekerjaan_id' => $row->pekerjaan_id,
		'nama_pekerjaan' => $row->nama_pekerjaan,
	    );
            $this->template->load('template','pekerjaan/pekerjaan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pekerjaan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('pekerjaan/create_action'),
	    'pekerjaan_id' => set_value('pekerjaan_id'),
	    'nama_pekerjaan' => set_value('nama_pekerjaan'),
	);
        $this->template->load('template','pekerjaan/pekerjaan_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_pekerjaan' => $this->input->post('nama_pekerjaan',TRUE),
	    );

            $this->Pekerjaan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('pekerjaan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Pekerjaan_model->get_by_id(decrypt_url($id));

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pekerjaan/update_action'),
		'pekerjaan_id' => set_value('pekerjaan_id', $row->pekerjaan_id),
		'nama_pekerjaan' => set_value('nama_pekerjaan', $row->nama_pekerjaan),
	    );
            $this->template->load('template','pekerjaan/pekerjaan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pekerjaan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('pekerjaan_id', TRUE));
        } else {
            $data = array(
		'nama_pekerjaan' => $this->input->post('nama_pekerjaan',TRUE),
	    );

            $this->Pekerjaan_model->update($this->input->post('pekerjaan_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pekerjaan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Pekerjaan_model->get_by_id(decrypt_url($id));

        if ($row) {
            $this->Pekerjaan_model->delete(decrypt_url($id));
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pekerjaan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pekerjaan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_pekerjaan', 'nama pekerjaan', 'trim|required');

	$this->form_validation->set_rules('pekerjaan_id', 'pekerjaan_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Pekerjaan.php */
/* Location: ./application/controllers/Pekerjaan.php */
/* Please DO NOT modify this information : */