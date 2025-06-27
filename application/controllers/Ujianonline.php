<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ujianonline extends CI_Controller
{

	/**
	 * @var CI_DB_query_builder
	 */
	public $db;

	/**
	 * @var CI_Input
	 */
	public $input;

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');


		$roles = $this->session->userdata('rule');
		$allow = ['admin', 'guru', 'kepala sekolah', 'operator'];
		if (!in_array($roles, $allow)) {
			echo '<script>alert("Maaf, anda tidak diizinkan mengakses halaman ini")</script>';
			echo '<script>window.location.href="' . base_url() . '";</script>';
		}
	}

	public function index()
	{
		$data = array(
			'page' => 'admin/ujianonline/index',
			'script' => 'admin/ujianonline/script',
			'link' => 'ujianonline'
		);

		$data['jadwal_ujian'] = $this->db->query("
            SELECT 
                ju.*,
                mp.nama_matapelajaran,
                kr.id as kelasrombel_id,
                k.nama_kelas,
                ta.tahun,
                ta.semester
            FROM tb_jadwal_ujian ju
            JOIN tb_matapelajaran mp ON ju.matapelajaran_id = mp.id
            JOIN tb_kelasrombel kr ON ju.kelasrombel_id = kr.id
            JOIN tb_kelas k ON kr.kelas_id = k.id
            JOIN tb_tahunakademik ta ON kr.tahunakademik_id = ta.id
            ORDER BY ju.tanggal_ujian DESC, ju.jam_mulai ASC
        ")->result();

		$this->load->view('template_stisla/wrapper', $data);
	}

	public function absensi($jadwal_ujian_id)
	{
		$data = array(
			'page' => 'admin/ujianonline/absensi',
			'script' => 'admin/ujianonline/script',
			'link' => 'ujianonline'
		);

		// Get jadwal ujian detail
		$data['jadwal'] = $this->db->query("
            SELECT 
                ju.*,
                mp.nama_matapelajaran,
                kr.id as kelasrombel_id,
                k.nama_kelas,
                ta.tahun,
                ta.semester
            FROM tb_jadwal_ujian ju
            JOIN tb_matapelajaran mp ON ju.matapelajaran_id = mp.id
            JOIN tb_kelasrombel kr ON ju.kelasrombel_id = kr.id
            JOIN tb_kelas k ON kr.kelas_id = k.id
            JOIN tb_tahunakademik ta ON kr.tahunakademik_id = ta.id
            WHERE ju.id = ?
        ", array($jadwal_ujian_id))->row();

		// Get students in the class with their attendance status
		$data['siswa'] = $this->db->query("
            SELECT 
                s.*,
                p.waktu_hadir
            FROM tb_siswa s
            JOIN tb_kelassiswa ks ON s.id = ks.siswa_id
            LEFT JOIN tb_presensi_ujian p ON p.siswa_id = s.id AND p.jadwal_ujian_id = ?
            WHERE ks.kelasrombel_id = ?
            ORDER BY s.nama ASC
        ", array($jadwal_ujian_id, $data['jadwal']->kelasrombel_id))->result();

		$this->load->view('template_stisla/wrapper', $data);
	}

	public function presensi()
	{
		// Check if request is AJAX
		if (!$this->input->is_ajax_request()) {
			show_404();
		}

		$jadwal_id = $this->input->post('jadwal_id');
		$siswa_id = $this->input->post('siswa_id');
		$nis = $this->input->post('nis');

		// Validate student
		$siswa = $this->db->get_where('tb_siswa', array('id' => $siswa_id, 'nis' => $nis))->row();
		if (!$siswa) {
			echo json_encode(array('status' => 'error', 'message' => 'Data siswa tidak valid!'));
			return;
		}

		// Check if student is in the class
		$jadwal = $this->db->query("
            SELECT kr.id as kelasrombel_id
            FROM tb_jadwal_ujian ju
            JOIN tb_kelasrombel kr ON ju.kelasrombel_id = kr.id
            WHERE ju.id = ?
        ", array($jadwal_id))->row();

		$is_in_class = $this->db->get_where('tb_kelassiswa', array(
			'siswa_id' => $siswa_id,
			'kelasrombel_id' => $jadwal->kelasrombel_id
		))->num_rows() > 0;

		if (!$is_in_class) {
			echo json_encode(array('status' => 'error', 'message' => 'Siswa tidak terdaftar di kelas ini!'));
			return;
		}

		// Check if already present
		$existing = $this->db->get_where('tb_presensi_ujian', array(
			'jadwal_ujian_id' => $jadwal_id,
			'siswa_id' => $siswa_id
		))->num_rows();

		if ($existing > 0) {
			echo json_encode(array('status' => 'error', 'message' => 'Siswa sudah melakukan presensi!'));
			return;
		}

		// Record attendance
		$this->db->insert('tb_presensi_ujian', array(
			'jadwal_ujian_id' => $jadwal_id,
			'siswa_id' => $siswa_id,
			'waktu_hadir' => date('Y-m-d H:i:s')
		));

		if ($this->db->affected_rows() > 0) {
			echo json_encode(array(
				'status' => 'success',
				'message' => 'Presensi berhasil dicatat!',
				'waktu_hadir' => date('d/m/Y H:i')
			));
		} else {
			echo json_encode(array('status' => 'error', 'message' => 'Gagal mencatat presensi!'));
		}
	}
}
