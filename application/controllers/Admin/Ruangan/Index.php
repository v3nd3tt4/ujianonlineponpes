<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Index extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Ruangan_model');
		$this->load->library('form_validation');
		$this->load->library('session');

		$roles = $this->session->userdata('rule');
		$allow = ['admin', 'kepala sekolah'];
		if (!in_array($roles, $allow)) {
			echo '<script>alert("Maaf, anda tidak diizinkan mengakses halaman ini")</script>';
			echo '<script>window.location.href="' . base_url() . '";</script>';
		}
	}

	public function index()
	{
		$data = array(
			'page' => 'admin/master/ruangan/index',
			'script' => 'admin/master/ruangan/script',
			'ruangan' => $this->Ruangan_model->get_all(),
			'link' => 'Admin/Ruangan/Index'
		);
		$this->load->view('template_stisla/wrapper', $data);
	}

	public function create()
	{
		$this->_rules();
		if ($this->form_validation->run() == FALSE) {
			$data = array(
				'page' => 'admin/master/ruangan/form',
				'script' => 'admin/master/ruangan/script',
				'link' => 'Admin/Ruangan/Index'
			);
			$this->load->view('template_stisla/wrapper', $data);
		} else {
			$data = $this->_get_posted_data();
			$this->Ruangan_model->insert($data);
			$this->session->set_flashdata('success', 'Data ruangan berhasil ditambahkan!');
			redirect('Admin/Ruangan/Index');
		}
	}

	public function edit($id)
	{
		$ruangan = $this->Ruangan_model->get_by_id($id);
		if (!$ruangan) show_404();
		$this->_rules();
		if ($this->form_validation->run() == FALSE) {
			$data = array(
				'page' => 'admin/master/ruangan/form',
				'script' => 'admin/master/ruangan/script',
				'ruangan' => $ruangan,
				'link' => 'Admin/Ruangan/Index'
			);
			$this->load->view('template_stisla/wrapper', $data);
		} else {
			$data = $this->_get_posted_data();
			$this->Ruangan_model->update($id, $data);
			$this->session->set_flashdata('success', 'Data ruangan berhasil diupdate!');
			redirect('Admin/Ruangan/Index');
		}
	}

	public function delete($id)
	{
		$this->Ruangan_model->delete($id);
		$this->session->set_flashdata('success', 'Data ruangan berhasil dihapus!');
		redirect('Admin/Ruangan/Index');
	}

	private function _rules()
	{
		$this->form_validation->set_rules('nama_ruangan', 'Nama Ruangan', 'required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
	}

	private function _get_posted_data()
	{
		return [
			'nama_ruangan' => $this->input->post('nama_ruangan', TRUE),
			'keterangan' => $this->input->post('keterangan', TRUE),
		];
	}
}
