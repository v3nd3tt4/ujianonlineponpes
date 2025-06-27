<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Index extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Gurumatapelajaran_model');
		$this->load->model('Pegawai_model');
		$this->load->model('Matapelajaran_model');
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
			'page' => 'admin/master/gurumatapelajaran/index',
			'script' => 'admin/master/gurumatapelajaran/script',
			'gurumatapelajaran' => $this->Gurumatapelajaran_model->get_all(),
			'link' => 'Admin/Gurumatapelajaran/Index'
		);
		$this->load->view('template_stisla/wrapper', $data);
	}

	public function create()
	{
		$this->_rules();
		if ($this->form_validation->run() == FALSE) {
			$data = array(
				'page' => 'admin/master/gurumatapelajaran/form',
				'script' => 'admin/master/gurumatapelajaran/script',
				'pegawai' => $this->Pegawai_model->get_all(),
				'matapelajaran' => $this->Matapelajaran_model->get_all(),
				'link' => 'Admin/Gurumatapelajaran/Index'
			);
			$this->load->view('template_stisla/wrapper', $data);
		} else {
			$data = $this->_get_posted_data();

			// Cek duplikasi
			if ($this->Gurumatapelajaran_model->cek_duplikat($data['pegawai_id'], $data['matapelajaran_id'])) {
				$this->session->set_flashdata('error', 'Guru sudah terdaftar untuk mata pelajaran ini!');
				redirect('Admin/Gurumatapelajaran/Index/create');
				return;
			}

			$this->Gurumatapelajaran_model->insert($data);
			$this->session->set_flashdata('success', 'Data guru mata pelajaran berhasil ditambahkan!');
			redirect('Admin/Gurumatapelajaran/Index');
		}
	}

	public function edit($id)
	{
		$gurumatapelajaran = $this->Gurumatapelajaran_model->get_by_id($id);
		if (!$gurumatapelajaran) show_404();
		$this->_rules();
		if ($this->form_validation->run() == FALSE) {
			$data = array(
				'page' => 'admin/master/gurumatapelajaran/form',
				'script' => 'admin/master/gurumatapelajaran/script',
				'gurumatapelajaran' => $gurumatapelajaran,
				'pegawai' => $this->Pegawai_model->get_all(),
				'matapelajaran' => $this->Matapelajaran_model->get_all(),
				'link' => 'Admin/Gurumatapelajaran/Index'
			);
			$this->load->view('template_stisla/wrapper', $data);
		} else {
			$data = $this->_get_posted_data();

			// Cek duplikasi
			if ($this->Gurumatapelajaran_model->cek_duplikat($data['pegawai_id'], $data['matapelajaran_id'], $id)) {
				$this->session->set_flashdata('error', 'Guru sudah terdaftar untuk mata pelajaran ini!');
				redirect('Admin/Gurumatapelajaran/Index/edit/' . $id);
				return;
			}

			$this->Gurumatapelajaran_model->update($id, $data);
			$this->session->set_flashdata('success', 'Data guru mata pelajaran berhasil diupdate!');
			redirect('Admin/Gurumatapelajaran/Index');
		}
	}

	public function delete($id)
	{
		$this->Gurumatapelajaran_model->delete($id);
		$this->session->set_flashdata('success', 'Data guru mata pelajaran berhasil dihapus!');
		redirect('Admin/Gurumatapelajaran/Index');
	}

	private function _rules()
	{
		$this->form_validation->set_rules('pegawai_id', 'Pegawai', 'required');
		$this->form_validation->set_rules('matapelajaran_id', 'Mata Pelajaran', 'required');
	}

	private function _get_posted_data()
	{
		return [
			'pegawai_id' => $this->input->post('pegawai_id', TRUE),
			'matapelajaran_id' => $this->input->post('matapelajaran_id', TRUE),
		];
	}
}
