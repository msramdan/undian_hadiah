<?php

require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Karyawan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Karyawan_model');
        $this->load->model('Unit_kerja_model');
        $this->load->model('Jabatan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $karyawan = $this->Karyawan_model->get_all();
        $data = array(
            'karyawan_data' => $karyawan,
        );
        $this->template->load('template', 'karyawan/karyawan_list', $data);
    }

    public function import()
    {

        $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        if (isset($_FILES['upload_file']['name']) && in_array($_FILES['upload_file']['type'], $file_mimes)) {
            $arr_file = explode('.', $_FILES['upload_file']['name']);
            $extension = end($arr_file);
            if ('csv' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } elseif ('xls' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            $spreadsheet = $reader->load($_FILES['upload_file']['tmp_name']);

            $sheetData = $spreadsheet->getActiveSheet()->toArray();
            if (!empty($sheetData)) {
                for ($i = 1; $i < count($sheetData); $i++) {
                    $nama_karyawan = $sheetData[$i][0];
                    $jenis_kelamin = $sheetData[$i][1];
                    $no_telpon = $sheetData[$i][2];
                        $data = array(
                            'nama_karyawan' => $nama_karyawan,
                            'jenis_kelamin' => $jenis_kelamin,
                            'no_telpon' => $no_telpon,
                        );
                        $this->db->insert('karyawan', $data);
                }
            }
        }
        redirect(base_url('karyawan'), 'refresh');
    }


    public function read($id)
    {
        $row = $this->Karyawan_model->get_by_id(decrypt_url($id));
        if ($row) {
            $data = array(
                'karyawan_id' => $row->karyawan_id,
                'nama_karyawan' => $row->nama_karyawan,
                'jabatan_id' => $row->jabatan_id,
                'unit_kerja_id' => $row->unit_kerja_id,
                'jenis_kelamin' => $row->jenis_kelamin,
                'no_telpon' => $row->no_telpon,
            );
            $this->template->load('template', 'karyawan/karyawan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('karyawan'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'jabatan' => $this->Jabatan_model->get_all(),
            'unit_kerja' => $this->Unit_kerja_model->get_all(),
            'action' => site_url('karyawan/create_action'),
            'karyawan_id' => set_value('karyawan_id'),
            'nama_karyawan' => set_value('nama_karyawan'),
            'jabatan_id' => set_value('jabatan_id'),
            'unit_kerja_id' => set_value('unit_kerja_id'),
            'jenis_kelamin' => set_value('jenis_kelamin'),
            'no_telpon' => set_value('no_telpon'),
        );
        $this->template->load('template', 'karyawan/karyawan_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'nama_karyawan' => $this->input->post('nama_karyawan', TRUE),
                'jabatan_id' => $this->input->post('jabatan_id', TRUE),
                'unit_kerja_id' => $this->input->post('unit_kerja_id', TRUE),
                'jenis_kelamin' => $this->input->post('jenis_kelamin', TRUE),
                'no_telpon' => $this->input->post('no_telpon', TRUE),
            );

            $this->Karyawan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('karyawan'));
        }
    }

    public function update($id)
    {
        $row = $this->Karyawan_model->get_by_id(decrypt_url($id));

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('karyawan/update_action'),
                'karyawan_id' => set_value('karyawan_id', $row->karyawan_id),
                'jabatan' => $this->Jabatan_model->get_all(),
                'unit_kerja' => $this->Unit_kerja_model->get_all(),
                'nama_karyawan' => set_value('nama_karyawan', $row->nama_karyawan),
                'jabatan_id' => set_value('jabatan_id', $row->jabatan_id),
                'unit_kerja_id' => set_value('unit_kerja_id', $row->unit_kerja_id),
                'jenis_kelamin' => set_value('jenis_kelamin', $row->jenis_kelamin),
                'no_telpon' => set_value('no_telpon', $row->no_telpon),
            );
            $this->template->load('template', 'karyawan/karyawan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('karyawan'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('karyawan_id', TRUE));
        } else {
            $data = array(
                'nama_karyawan' => $this->input->post('nama_karyawan', TRUE),
                'jabatan_id' => $this->input->post('jabatan_id', TRUE),
                'unit_kerja_id' => $this->input->post('unit_kerja_id', TRUE),
                'jenis_kelamin' => $this->input->post('jenis_kelamin', TRUE),
                'no_telpon' => $this->input->post('no_telpon', TRUE),
            );

            $this->Karyawan_model->update($this->input->post('karyawan_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('karyawan'));
        }
    }

    public function delete($id)
    {
        $row = $this->Karyawan_model->get_by_id(decrypt_url($id));

        if ($row) {
            $this->Karyawan_model->delete(decrypt_url($id));
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('karyawan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('karyawan'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nama_karyawan', 'nama karyawan', 'trim|required');
        $this->form_validation->set_rules('jabatan_id', 'jabatan id', 'trim|required');
        $this->form_validation->set_rules('unit_kerja_id', 'unit kerja id', 'trim|required');
        $this->form_validation->set_rules('jenis_kelamin', 'jenis kelamin', 'trim|required');
        $this->form_validation->set_rules('no_telpon', 'no telpon', 'trim|required');

        $this->form_validation->set_rules('karyawan_id', 'karyawan_id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "karyawan.xls";
        $judul = "karyawan";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
        xlsWriteLabel($tablehead, $kolomhead++, "Nama Karyawan");
        xlsWriteLabel($tablehead, $kolomhead++, "Jabatan Id");
        xlsWriteLabel($tablehead, $kolomhead++, "Unit Kerja Id");
        xlsWriteLabel($tablehead, $kolomhead++, "Jenis Kelamin");
        xlsWriteLabel($tablehead, $kolomhead++, "No Telpon");

        foreach ($this->Karyawan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama_karyawan);
            xlsWriteNumber($tablebody, $kolombody++, $data->jabatan_id);
            xlsWriteNumber($tablebody, $kolombody++, $data->unit_kerja_id);
            xlsWriteLabel($tablebody, $kolombody++, $data->jenis_kelamin);
            xlsWriteNumber($tablebody, $kolombody++, $data->no_telpon);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }
}

/* End of file Karyawan.php */
/* Location: ./application/controllers/Karyawan.php */
/* Please DO NOT modify this information : */