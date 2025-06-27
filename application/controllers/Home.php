<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$roles = $this->session->userdata('rule');

		// Cek apakah sudah login atau belum
		if (empty($roles)) {
			echo '<script>
				alert("Maaf, anda harus login terlebih dahulu");
				window.location.href = "' . base_url() . '";
			</script>';
			exit;
		}

		$allow = ['admin', 'operator', 'guru', 'kepala sekolah', 'siswa'];
		if (!in_array($roles, $allow)) {
			echo '<script>alert("Maaf, anda tidak diizinkan mengakses halaman ini")</script>';
			echo '<script>window.location.href="' . base_url() . '";</script>';
		}
	}

	public function index()
	{
		$total_guru = $this->db->where('role', 'guru')->count_all_results('tb_pegawai');
		$total_siswa = $this->db->count_all('tb_siswa');
		$tahun_ajaran = $this->db->select('tahun')
			->from('tb_tahunakademik')
			->where('status', 'aktif')
			->order_by('tahun', 'DESC')
			->limit(1)
			->get()
			->row('tahun');

		$data = array(
			'page' => 'home/index',
			'link' => 'home',
			'script' => 'home/script',
			'total_guru' => $total_guru,
			'total_siswa' => $total_siswa,
			'tahun_ajaran' => $tahun_ajaran,
		);
		$this->load->view('template_stisla/wrapper', $data);
	}


	public function logout()
	{
		$this->session->sess_destroy();
		echo '<script>alert("Berhasil Logout...");window.location.href = "' . base_url() . 'auth";</script>';
	}
}
