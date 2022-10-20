<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Banner extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->model('Banner_model');
		$this->load->library('form_validation');
	}

	public function update()
	{
		$id = 'Umhxc2ZDeHlpc1JpYWNIUVdzNG1sZz09';
		$row = $this->Banner_model->get_by_id(decrypt_url($id));

		if ($row) {
			$data = array(
				'button' => 'Update',
				'action' => site_url('banner/update_action'),
				'banner_id' => set_value('banner_id', $row->banner_id),
				'photo' => set_value('photo', $row->photo),
			);
			$this->template->load('template', 'banner/banner_form', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('banner'));
		}
	}

	public function update_action()
	{
		$id = $this->input->post('banner_id');
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->update($this->input->post('banner_id', TRUE));
		} else {
			$config['upload_path']      = './temp/assets/banner';
			$config['allowed_types']    = 'jpg|png|jpeg';
			$config['max_size']         = 10048;
			$config['file_name']        = 'File-' . date('ymd') . '-' . substr(sha1(rand()), 0, 10);
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if ($this->upload->do_upload("photo")) {
				$row = $this->Banner_model->get_by_id($id);
				$data = $this->upload->data();
				$photo = $data['file_name'];
				if ($row->photo == null || $row->photo == '') {
				} else {
					$target_file = './temp/assets/banner/' . $row->photo;
					unlink($target_file);
				}
			} else {
				$photo = $this->input->post('photo_lama');
			}

			$data = array(
				'photo' => $photo,
			);

			$this->Banner_model->update($this->input->post('banner_id', TRUE), $data);
			$this->session->set_flashdata('message', 'Update Record Success');
			redirect(site_url('banner/update'));
		}
	}

	public function _rules()
	{
		// $this->form_validation->set_rules('photo', 'photo', 'trim|required');
		$this->form_validation->set_rules('banner_id', 'banner_id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}
}

/* End of file Banner.php */
/* Location: ./application/controllers/Banner.php */
/* Please DO NOT modify this information : */