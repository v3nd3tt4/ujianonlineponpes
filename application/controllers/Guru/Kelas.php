<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('form_validation');
		$this->load->library('session');

		$roles = $this->session->userdata('rule');
		$allow = ['guru'];
		if (!in_array($roles, $allow)) {
			echo '<script>alert("Maaf, anda tidak diizinkan mengakses halaman ini")</script>';
			echo '<script>window.location.href="' . base_url() . '";</script>';
		}
	}

	public function index()
	{
		// Misal ID pegawai yang login disimpan di session
		$guru_id = $this->session->userdata('id_user');

		$this->db->select('
            tb_kelasrombel.id as kelasrombel_id, 
            tb_kelas.nama_kelas, 
            tb_tahunakademik.tahun as tahun_akademik, 
            tb_tahunakademik.semester,
            tb_kelasrombel.walikelas_id
        ');
		$this->db->from('tb_kelasrombel');
		$this->db->join('tb_kelas', 'tb_kelasrombel.kelas_id = tb_kelas.id');
		$this->db->join('tb_tahunakademik', 'tb_kelasrombel.tahunakademik_id = tb_tahunakademik.id');
		$this->db->where('tb_kelasrombel.walikelas_id', $guru_id);

		$query = $this->db->get();
		$data['kelas'] = $query->result();

		$data = array(
			'page' => 'guru/kelas/index',
			'script' => 'guru/kelas/script',
			'link' => 'guru/kelas',
			'kelas' => $query->result(),
		);
		$this->load->view('template_stisla/wrapper', $data);
	}

	public function daftar_siswa($kelasrombel_id)
	{
		// Ambil nama kelas dan tahun akademik jika ingin ditampilkan
		$this->db->select('tb_kelas.nama_kelas, tb_tahunakademik.tahun, tb_tahunakademik.semester');
		$this->db->from('tb_kelasrombel');
		$this->db->join('tb_kelas', 'tb_kelasrombel.kelas_id = tb_kelas.id');
		$this->db->join('tb_tahunakademik', 'tb_kelasrombel.tahunakademik_id = tb_tahunakademik.id');
		$this->db->where('tb_kelasrombel.id', $kelasrombel_id);
		$kelas = $this->db->get()->row();

		// Ambil siswa di kelas tersebut
		$this->db->select('tb_siswa.*');
		$this->db->from('tb_kelassiswa');
		$this->db->join('tb_siswa', 'tb_kelassiswa.siswa_id = tb_siswa.id');
		$this->db->where('tb_kelassiswa.kelasrombel_id', $kelasrombel_id);
		$siswa = $this->db->get()->result();


		$data = array(
			'page' => 'guru/kelas/siswa',
			'script' => 'guru/kelas/script_siswa',
			'link' => 'guru/kelas',
			'kelas' => $kelas,
			'siswa' => $siswa
		);
		$this->load->view('template_stisla/wrapper', $data);
	}
}
