<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Unit_kerja extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // is_login();
        $this->load->model('Unit_kerja_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $unit_kerja = $this->Unit_kerja_model->get_all();
        $data = array(
            'unit_kerja_data' => $unit_kerja,
        );
        $this->template->load('template','unit_kerja/unit_kerja_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Unit_kerja_model->get_by_id(decrypt_url($id));
        if ($row) {
            $data = array(
		'unit_kerja_id' => $row->unit_kerja_id,
		'nam_unit_kerja' => $row->nam_unit_kerja,
	    );
            $this->template->load('template','unit_kerja/unit_kerja_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('unit_kerja'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('unit_kerja/create_action'),
	    'unit_kerja_id' => set_value('unit_kerja_id'),
	    'nam_unit_kerja' => set_value('nam_unit_kerja'),
	);
        $this->template->load('template','unit_kerja/unit_kerja_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nam_unit_kerja' => $this->input->post('nam_unit_kerja',TRUE),
	    );

            $this->Unit_kerja_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('unit_kerja'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Unit_kerja_model->get_by_id(decrypt_url($id));

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('unit_kerja/update_action'),
		'unit_kerja_id' => set_value('unit_kerja_id', $row->unit_kerja_id),
		'nam_unit_kerja' => set_value('nam_unit_kerja', $row->nam_unit_kerja),
	    );
            $this->template->load('template','unit_kerja/unit_kerja_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('unit_kerja'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('unit_kerja_id', TRUE));
        } else {
            $data = array(
		'nam_unit_kerja' => $this->input->post('nam_unit_kerja',TRUE),
	    );

            $this->Unit_kerja_model->update($this->input->post('unit_kerja_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('unit_kerja'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Unit_kerja_model->get_by_id(decrypt_url($id));

        if ($row) {
            $this->Unit_kerja_model->delete(decrypt_url($id));
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('unit_kerja'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('unit_kerja'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nam_unit_kerja', 'nam unit kerja', 'trim|required');

	$this->form_validation->set_rules('unit_kerja_id', 'unit_kerja_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Unit_kerja.php */
/* Location: ./application/controllers/Unit_kerja.php */
/* Please DO NOT modify this information : */