<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Index extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Tahunakademik_model');
		$this->load->library('form_validation');
		$this->load->library('session');

		$roles = $this->session->userdata('rule');
		$allow = ['admin'];
		if (!in_array($roles, $allow)) {
			echo '<script>alert("Maaf, anda tidak diizinkan mengakses halaman ini")</script>';
			echo '<script>window.location.href="' . base_url() . '";</script>';
		}
	}

	public function index()
	{
		$data = array(
			'page' => 'admin/master/tahunakademik/index',
			'script' => 'admin/master/tahunakademik/script',
			'tahunakademik' => $this->Tahunakademik_model->get_all(),
			'link' => 'Admin/Tahunakademik/Index'
		);
		$this->load->view('template_stisla/wrapper', $data);
	}

	public function create()
	{
		$this->_rules();
		if ($this->form_validation->run() == FALSE) {
			$data = array(
				'page' => 'admin/master/tahunakademik/form',
				'script' => 'admin/master/tahunakademik/script',
				'link' => 'Admin/Tahunakademik/Index'
			);
			$this->load->view('template_stisla/wrapper', $data);
		} else {
			$data = $this->_get_posted_data();
			$this->Tahunakademik_model->insert($data);
			$this->session->set_flashdata('success', 'Data tahun akademik berhasil ditambahkan!');
			redirect('Admin/Tahunakademik/Index');
		}
	}

	public function edit($id)
	{
		$tahunakademik = $this->Tahunakademik_model->get_by_id($id);
		if (!$tahunakademik) show_404();
		$this->_rules();
		if ($this->form_validation->run() == FALSE) {
			$data = array(
				'page' => 'admin/master/tahunakademik/form',
				'script' => 'admin/master/tahunakademik/script',
				'tahunakademik' => $tahunakademik,
				'link' => 'Admin/Tahunakademik/Index'
			);
			$this->load->view('template_stisla/wrapper', $data);
		} else {
			$data = $this->_get_posted_data();
			$this->Tahunakademik_model->update($id, $data);
			$this->session->set_flashdata('success', 'Data tahun akademik berhasil diupdate!');
			redirect('Admin/Tahunakademik/Index');
		}
	}

	public function delete($id)
	{
		$this->Tahunakademik_model->delete($id);
		$this->session->set_flashdata('success', 'Data tahun akademik berhasil dihapus!');
		redirect('Admin/Tahunakademik/Index');
	}

	private function _rules()
	{
		$this->form_validation->set_rules('tahun', 'Tahun', 'required');
		// $this->form_validation->set_rules('semester', 'Semester', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');
	}

	private function _get_posted_data()
	{
		return [
			'tahun' => $this->input->post('tahun', TRUE),
			'semester' => $this->input->post('semester', TRUE),
			'status' => $this->input->post('status', TRUE),
		];
	}
}
