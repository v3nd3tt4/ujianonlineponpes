<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Siswa_model');
		$this->load->library('form_validation');
		$this->load->library('session');

		$roles = $this->session->userdata('rule');
		$allow = ['siswa'];
		if (!in_array($roles, $allow)) {
			echo '<script>alert("Maaf, anda tidak diizinkan mengakses halaman ini")</script>';
			echo '<script>window.location.href="' . base_url() . '";</script>';
		}
	}

	public function index()
	{
		$id = $this->session->userdata('id_user');
		$siswa = $this->Siswa_model->get_by_id($id);
		if (!$siswa) show_404();

		$data = array(
			'page' => 'siswa/profile/index',
			'script' => 'siswa/profile/script',
			'siswa' => $siswa,
			'link' => 'siswa/profile'
		);
		$this->load->view('template_stisla/wrapper', $data);
	}

	public function edit($id)
	{
		$siswa = $this->Siswa_model->get_by_id($id);
		if (!$siswa) show_404();

		$this->_rules_edit($id);
		if ($this->form_validation->run() == FALSE) {
			// Set error flash message
			$this->session->set_flashdata('error', 'Terjadi kesalahan dalam validasi data. Silakan periksa kembali inputan Anda.');
			
			// Return to view page with validation errors
			$data = array(
				'page' => 'siswa/profile/view',
				'script' => 'siswa/profile/script',
				'siswa' => $siswa,
				'link' => 'siswa/profile',
				'validation_errors' => validation_errors(),
				'edit_mode' => true
			);
			$this->load->view('template_stisla/wrapper', $data);
		} else {
			try {
				$data = $this->_get_posted_data();
				
				// Only hash password if it's provided
				if (!empty($data['password'])) {
					$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
				} else {
					unset($data['password']);
				}

				// Remove fields that shouldn't be updated
				unset($data['nis'], $data['email'], $data['tahun_masuk']);

				$update_result = $this->Siswa_model->update($id, $data);
				
				if ($update_result) {
					$this->session->set_flashdata('success', 'Data profil berhasil diperbarui!');
				} else {
					$this->session->set_flashdata('error', 'Gagal memperbarui data profil. Silakan coba lagi.');
				}
			} catch (Exception $e) {
				$this->session->set_flashdata('error', 'Terjadi kesalahan sistem. Silakan coba lagi atau hubungi administrator.');
				log_message('error', 'Profile update error: ' . $e->getMessage());
			}
			
			redirect('user/profile');
		}
	}

	private function _rules_edit($id)
	{
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
		$this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required|trim');
		$this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|in_list[L,P]');
		$this->form_validation->set_rules('password', 'Password', 'min_length[6]'); // Optional on edit
		$this->form_validation->set_rules('no_hp', 'No HP', 'trim|numeric');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim');
		$this->form_validation->set_rules('nama_ayah', 'Nama Ayah', 'trim');
		$this->form_validation->set_rules('nama_ibu', 'Nama Ibu', 'trim');
		$this->form_validation->set_rules('pekerjaan_ayah', 'Pekerjaan Ayah', 'trim');
		$this->form_validation->set_rules('pekerjaan_ibu', 'Pekerjaan Ibu', 'trim');
	}

	private function _get_posted_data()
	{
		return [
			'nama' => $this->input->post('nama', TRUE),
			'nis' => $this->input->post('nis', TRUE), // Will be unset in edit method
			'tempat_lahir' => $this->input->post('tempat_lahir', TRUE),
			'tanggal_lahir' => $this->input->post('tanggal_lahir', TRUE),
			'jenis_kelamin' => $this->input->post('jenis_kelamin', TRUE),
			'alamat' => $this->input->post('alamat', TRUE),
			'email' => $this->input->post('email', TRUE), // Will be unset in edit method
			'password' => $this->input->post('password', TRUE),
			'no_hp' => $this->input->post('no_hp', TRUE),
			'nama_ibu' => $this->input->post('nama_ibu', TRUE),
			'nama_ayah' => $this->input->post('nama_ayah', TRUE),
			'pekerjaan_ibu' => $this->input->post('pekerjaan_ibu', TRUE),
			'pekerjaan_ayah' => $this->input->post('pekerjaan_ayah', TRUE),
			'tahun_masuk' => $this->input->post('tahun_masuk', TRUE), // Will be unset in edit method
		];
	}
}
