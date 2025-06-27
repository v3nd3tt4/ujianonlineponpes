<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
		$this->load->helper(array('url', 'form'));

		$roles = $this->session->userdata('rule');
		$allow = ['admin', 'operator', 'guru', 'kepala sekolah', 'siswa'];
		if (in_array($roles, $allow)) {
			echo '<script>alert("Maaf, anda tidak diizinkan mengakses halaman ini")</script>';
			echo '<script>window.location.href="' . base_url() . 'home";</script>';
		}
	}

	public function index()
	{
		$data = array(
			'page' => 'auth/index',
			'link' => 'auth'
		);
		$this->load->view('auth/index', $data);
	}

	public function login()
	{
		$role = $this->input->post('role');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$user = null;
		if ($role == 'siswa') {
			$query = $this->db->get_where('tb_siswa', ['email' => $email]);
			$user = $query->row();
		} else {
			$query = $this->db->get_where('tb_pegawai', ['email' => $email, 'role' => $role]);
			$user = $query->row();
		}
		if ($user && password_verify($password, $user->password)) {
			$userdata = [
				'id_user' => $user->id,
				'nama' => $user->nama,
				'rule' => $role,
				'logged_in' => true
			];

			// Add NIS for students
			if ($role == 'siswa') {
				$userdata['nis'] = $user->nis;
			}

			$this->session->set_userdata($userdata);
			redirect('home');
		} else {
			$this->session->set_flashdata('error', 'Email, password, atau role salah!');
			redirect('auth');
		}
	}
}
