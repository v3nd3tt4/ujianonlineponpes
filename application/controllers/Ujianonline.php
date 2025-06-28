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

	public function history_jawaban_siswa($jadwal_ujian_id)
	{
		$data = array(
			'page' => 'admin/ujianonline/history_jawaban_siswa',
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

	public function detail_history_jawaban_siswa($siswa_id, $jadwal_ujian_id)
	{
		// $siswa_id = $this->session->userdata('id_user');

		// Verify that this exam belongs to the logged-in student
		$this->db->select('tb_jawaban_ujian.*, tb_siswa.nama as nama_siswa, tb_siswa.nis, tb_matapelajaran.nama_matapelajaran, tb_jadwal_ujian.jenis_ujian, tb_jadwal_ujian.tanggal_ujian, tb_jadwal_ujian.jam_mulai, tb_jadwal_ujian.jam_selesai, tb_jadwal_ujian.lama_ujian, tb_kelas.nama_kelas, tb_jadwal_ujian.banksoal_id');
		$this->db->from('tb_jawaban_ujian');
		$this->db->join('tb_siswa', 'tb_jawaban_ujian.siswa_id = tb_siswa.id');
		$this->db->join('tb_jadwal_ujian', 'tb_jawaban_ujian.jadwal_ujian_id = tb_jadwal_ujian.id');
		$this->db->join('tb_matapelajaran', 'tb_jadwal_ujian.matapelajaran_id = tb_matapelajaran.id');
		$this->db->join('tb_kelasrombel', 'tb_jadwal_ujian.kelasrombel_id = tb_kelasrombel.id');
		$this->db->join('tb_kelas', 'tb_kelas.id = tb_kelasrombel.kelas_id');
		$this->db->where('tb_jawaban_ujian.jadwal_ujian_id', $jadwal_ujian_id);
		$this->db->where('tb_jawaban_ujian.siswa_id', $siswa_id);
		$jawaban_ujian = $this->db->get()->row();

		if (!$jawaban_ujian) {
			echo '<script>alert("Data tidak ditemukan atau anda tidak memiliki akses")</script>';
			echo '<script>window.location.href="' . base_url('ujianonline') . '";</script>';
			return;
		}

		// Get soal from banksoal
		$this->db->select('tb_soal.*');
		$this->db->from('tb_soal');
		$this->db->where('tb_soal.banksoal_id', $jawaban_ujian->banksoal_id);
		$this->db->order_by('tb_soal.id', 'ASC');
		$soal_list = $this->db->get()->result();

		// Parse student answers
		$jawaban_siswa = json_decode($jawaban_ujian->jawaban, true);
		if (!$jawaban_siswa) {
			$jawaban_siswa = array();
		}

		// Calculate correct and wrong answers
		$benar = 0;
		$salah = 0;
		$kosong = 0;
		$detail_jawaban = array();

		foreach ($soal_list as $index => $soal) {
			$nomor_soal = $index + 1;
			$jawaban_siswa_soal = isset($jawaban_siswa[$soal->id]) ? $jawaban_siswa[$soal->id] : '';
			$status = '';
			$keterangan = '';

			if ($jawaban_siswa_soal == '') {
				$status = 'kosong';
				$keterangan = 'Tidak dijawab';
				$kosong++;
			} elseif ($jawaban_siswa_soal == $soal->kunci_jawaban) {
				$status = 'benar';
				$keterangan = 'Jawaban benar';
				$benar++;
			} else {
				$status = 'salah';
				$keterangan = 'Jawaban salah';
				$salah++;
			}

			$detail_jawaban[] = array(
				'nomor' => $nomor_soal,
				'soal' => $soal,
				'jawaban_siswa' => $jawaban_siswa_soal,
				'kunci_jawaban' => $soal->kunci_jawaban,
				'status' => $status,
				'keterangan' => $keterangan
			);
		}

		$data = array(
			'jawaban_ujian' => $jawaban_ujian,
			'detail_jawaban' => $detail_jawaban,
			'statistik' => array(
				'benar' => $benar,
				'salah' => $salah,
				'kosong' => $kosong,
				'total' => count($soal_list)
			),
			'page' => 'admin/ujianonline/detail_history_jawaban_siswa',
			'script' => 'admin/ujianonline/script',
			'link' => 'ujianonline'
		);
		$this->load->view('template_stisla/wrapper', $data);
	}
}
