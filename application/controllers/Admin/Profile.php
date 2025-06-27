<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Pegawai_model');
		$this->load->library('form_validation');
		$this->load->library('session');

		$roles = $this->session->userdata('rule');
		$allow = ['admin', 'operator', 'guru', 'kepala sekolah'];
		if (!in_array($roles, $allow)) {
			echo '<script>alert("Maaf, anda tidak diizinkan mengakses halaman ini")</script>';
			echo '<script>window.location.href="' . base_url() . '";</script>';
		}
	}

	public function index()
	{
		$id = $this->session->userdata('id_user');
		$pegawai = $this->Pegawai_model->get_by_id($id);
		if (!$pegawai) show_404();

		$data = array(
			'page' => 'admin/profile/index',
			'script' => 'admin/profile/script',
			'pegawai' => $pegawai,
			'link' => 'admin/profile'
		);
		$this->load->view('template_stisla/wrapper', $data);
	}

	public function edit($id)
	{
		$pegawai = $this->Pegawai_model->get_by_id($id);
		if (!$pegawai) show_404();

		$this->_rules_edit($id);
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Terjadi kesalahan dalam validasi data. Silakan periksa kembali inputan Anda.');
			$data = array(
				'page' => 'admin/profile/view',
				'script' => 'admin/profile/script',
				'pegawai' => $pegawai,
				'link' => 'admin/profile',
				'validation_errors' => validation_errors(),
				'edit_mode' => true
			);
			$this->load->view('template_stisla/wrapper', $data);
		} else {
			try {
				$data = $this->_get_posted_data();
				if (!empty($data['password'])) {
					$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
				} else {
					unset($data['password']);
				}
				// Remove fields that shouldn't be updated
				unset($data['id'], $data['email'], $data['role'], $data['created_at'], $data['updated_at']);
				$data['updated_at'] = date('Y-m-d H:i:s');
				$update_result = $this->Pegawai_model->update($id, $data);
				if ($update_result) {
					$this->session->set_flashdata('success', 'Data profil berhasil diperbarui!');
				} else {
					$this->session->set_flashdata('error', 'Gagal memperbarui data profil. Silakan coba lagi.');
				}
			} catch (Exception $e) {
				$this->session->set_flashdata('error', 'Terjadi kesalahan sistem. Silakan coba lagi atau hubungi administrator.');
				log_message('error', 'Profile update error: ' . $e->getMessage());
			}
			redirect('admin/profile');
		}
	}

	private function _rules_edit($id)
	{
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
		$this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required|trim');
		$this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|in_list[L,P]');
		$this->form_validation->set_rules('password', 'Password', 'min_length[6]');
		$this->form_validation->set_rules('no_telepon', 'No Telepon', 'trim|numeric');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim');
	}

	private function _get_posted_data()
	{
		return [
			'id' => $this->input->post('id', TRUE), // Will be unset in edit method
			'nama' => $this->input->post('nama', TRUE),
			'tempat_lahir' => $this->input->post('tempat_lahir', TRUE),
			'tanggal_lahir' => $this->input->post('tanggal_lahir', TRUE),
			'jenis_kelamin' => $this->input->post('jenis_kelamin', TRUE),
			'alamat' => $this->input->post('alamat', TRUE),
			'no_telepon' => $this->input->post('no_telepon', TRUE),
			'email' => $this->input->post('email', TRUE), // Will be unset in edit method
			'password' => $this->input->post('password', TRUE),
			'role' => $this->input->post('role', TRUE), // Will be unset in edit method
			'created_at' => $this->input->post('created_at', TRUE), // Will be unset in edit method
			'updated_at' => $this->input->post('updated_at', TRUE), // Will be set on update
		];
	}
}
