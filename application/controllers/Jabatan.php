<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jabatan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // is_login();
        $this->load->model('Jabatan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $jabatan = $this->Jabatan_model->get_all();
        $data = array(
            'jabatan_data' => $jabatan,
        );
        $this->template->load('template','jabatan/jabatan_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Jabatan_model->get_by_id(decrypt_url($id));
        if ($row) {
            $data = array(
		'jabatan_id' => $row->jabatan_id,
		'nama_jabatan' => $row->nama_jabatan,
	    );
            $this->template->load('template','jabatan/jabatan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jabatan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('jabatan/create_action'),
	    'jabatan_id' => set_value('jabatan_id'),
	    'nama_jabatan' => set_value('nama_jabatan'),
	);
        $this->template->load('template','jabatan/jabatan_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_jabatan' => $this->input->post('nama_jabatan',TRUE),
	    );

            $this->Jabatan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('jabatan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Jabatan_model->get_by_id(decrypt_url($id));

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('jabatan/update_action'),
		'jabatan_id' => set_value('jabatan_id', $row->jabatan_id),
		'nama_jabatan' => set_value('nama_jabatan', $row->nama_jabatan),
	    );
            $this->template->load('template','jabatan/jabatan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jabatan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('jabatan_id', TRUE));
        } else {
            $data = array(
		'nama_jabatan' => $this->input->post('nama_jabatan',TRUE),
	    );

            $this->Jabatan_model->update($this->input->post('jabatan_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('jabatan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Jabatan_model->get_by_id(decrypt_url($id));

        if ($row) {
            $this->Jabatan_model->delete(decrypt_url($id));
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('jabatan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jabatan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_jabatan', 'nama jabatan', 'trim|required');

	$this->form_validation->set_rules('jabatan_id', 'jabatan_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Jabatan.php */
/* Location: ./application/controllers/Jabatan.php */
/* Please DO NOT modify this information : */