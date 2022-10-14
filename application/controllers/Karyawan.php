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
        $this->load->model('Pekerjaan_model');
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
                    $instansi = $sheetData[$i][1];
                    $jabatan = $sheetData[$i][2];
                    $no_telpon = $sheetData[$i][3];
                    $email = $sheetData[$i][4];

                    $jml = $this->db->query("SELECT * from karyawan where no_telpon='$no_telpon' OR email='$email'")->num_rows();
                    if ($jml == 0) {
                        $data = array(
                            'nama_karyawan' => $nama_karyawan,
                            'instansi' => $instansi,
                            'jabatan' => $jabatan,
                            'no_telpon' => $no_telpon,
                            'email' => $email,
                        );
                        $this->db->insert('karyawan', $data);
                    }
                }
            }
        }
        redirect(base_url('karyawan'), 'refresh');
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'pekerjaan' => $this->Pekerjaan_model->get_all(),
            'action' => site_url('karyawan/create_action'),
            'karyawan_id' => set_value('karyawan_id'),
            'nama_karyawan' => set_value('nama_karyawan'),
            'pekerjaan_id' => set_value('pekerjaan'),
            'jabatan' => set_value('jabatan'),
            'instansi' => set_value('instansi'),
            'no_telpon' => set_value('no_telpon'),
            'email' => set_value('email'),
        );
        $this->template->load('template', 'karyawan/karyawan_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $no_telpon = $this->input->post('no_telpon', TRUE);
            $email = $this->input->post('email', TRUE);
            $jml = $this->db->query("SELECT * from karyawan where no_telpon='$no_telpon' OR email='$email'")->num_rows();
            if ($jml == 0) {
                $data = array(
                    'nama_karyawan' => $this->input->post('nama_karyawan', TRUE),
                    'pekerjaan_id' => $this->input->post('pekerjaan_id', TRUE),
                    'jabatan' => $this->input->post('jabatan', TRUE),
                    'instansi' => $this->input->post('instansi', TRUE),
                    'no_telpon' => $this->input->post('no_telpon', TRUE),
                    'email' => $this->input->post('email', TRUE),
                );
                $this->Karyawan_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
            } else {
                $this->session->set_flashdata('error', 'Peserta sudah terdaftar dengan nomor HP/WA/Email tersebut');
            }
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
                'pekerjaan' => $this->Pekerjaan_model->get_all(),
                'nama_karyawan' => set_value('nama_karyawan', $row->nama_karyawan),
                'pekerjaan_id' => set_value('pekerjaan_id', $row->pekerjaan_id),
                'jabatan' => set_value('jabatan', $row->jabatan),
                'instansi' => set_value('jabatan', $row->instansi),
                'no_telpon' => set_value('no_telpon', $row->no_telpon),
                'email' => set_value('email', $row->email),
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
                'pekerjaan_id' => $this->input->post('pekerjaan_id', TRUE),
                'jabatan' => $this->input->post('jabatan', TRUE),
                'instansi' => $this->input->post('instansi', TRUE),
                'no_telpon' => $this->input->post('no_telpon', TRUE),
                'email' => $this->input->post('email', TRUE),
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
        $this->form_validation->set_rules('pekerjaan_id', 'pekerjaan id', 'trim|required');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|required');
        $this->form_validation->set_rules('instansi', 'Instansi', 'trim|required');
        $this->form_validation->set_rules('no_telpon', 'Nomor HP/WA', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
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
        xlsWriteLabel($tablehead, $kolomhead++, "pekerjaan Id");
        xlsWriteLabel($tablehead, $kolomhead++, "Unit Kerja Id");
        xlsWriteLabel($tablehead, $kolomhead++, "Jenis Kelamin");
        xlsWriteLabel($tablehead, $kolomhead++, "No Telpon");

        foreach ($this->Karyawan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama_karyawan);
            xlsWriteNumber($tablebody, $kolombody++, $data->pekerjaan);
            xlsWriteNumber($tablebody, $kolombody++, $data->jabatan);
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