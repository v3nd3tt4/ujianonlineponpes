<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Histori_jawaban extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
		$this->load->helper(array('url', 'form'));

		$roles = $this->session->userdata('rule');
		// $allow = ['siswa'];
		// if (!in_array($roles, $allow)) {
		// 	echo '<script>alert("Maaf, anda tidak diizinkan mengakses halaman ini")</script>';
		// 	echo '<script>window.location.href="' . base_url() . '";</script>';
		// }
	}

	public function index()
	{
		$siswa_id = $this->session->userdata('id_user');

		// Get all exam attempts by the student
		$this->db->select('tb_jawaban_ujian.*, tb_siswa.nama as nama_siswa, tb_siswa.nis, tb_matapelajaran.nama_matapelajaran, tb_jadwal_ujian.jenis_ujian, tb_jadwal_ujian.tanggal_ujian, tb_jadwal_ujian.jam_mulai, tb_jadwal_ujian.jam_selesai, tb_jadwal_ujian.lama_ujian, tb_kelas.nama_kelas');
		$this->db->from('tb_jawaban_ujian');
		$this->db->join('tb_siswa', 'tb_jawaban_ujian.siswa_id = tb_siswa.id');
		$this->db->join('tb_jadwal_ujian', 'tb_jawaban_ujian.jadwal_ujian_id = tb_jadwal_ujian.id');
		$this->db->join('tb_matapelajaran', 'tb_jadwal_ujian.matapelajaran_id = tb_matapelajaran.id');
		$this->db->join('tb_kelasrombel', 'tb_jadwal_ujian.kelasrombel_id = tb_kelasrombel.id');
		$this->db->join('tb_kelas', 'tb_kelas.id = tb_kelasrombel.kelas_id');
		$this->db->where('tb_jawaban_ujian.siswa_id', $siswa_id);
		$this->db->order_by('tb_jadwal_ujian.tanggal_ujian', 'DESC');
		$this->db->order_by('tb_matapelajaran.nama_matapelajaran', 'ASC');
		$hasil_ujian = $this->db->get()->result();

		$data = array(
			'hasil_ujian' => $hasil_ujian,
			'page' => 'siswa/histori_jawaban/index',
			'script' => 'siswa/histori_jawaban/script',
			'link' => 'siswa/histori_jawaban'
		);
		$this->load->view('template_stisla/wrapper', $data);
	}

	public function detail($jawaban_ujian_id)
	{
		$siswa_id = $this->session->userdata('id_user');

		// Verify that this exam belongs to the logged-in student
		$this->db->select('tb_jawaban_ujian.*, tb_siswa.nama as nama_siswa, tb_siswa.nis, tb_matapelajaran.nama_matapelajaran, tb_jadwal_ujian.jenis_ujian, tb_jadwal_ujian.tanggal_ujian, tb_jadwal_ujian.jam_mulai, tb_jadwal_ujian.jam_selesai, tb_jadwal_ujian.lama_ujian, tb_kelas.nama_kelas, tb_jadwal_ujian.banksoal_id');
		$this->db->from('tb_jawaban_ujian');
		$this->db->join('tb_siswa', 'tb_jawaban_ujian.siswa_id = tb_siswa.id');
		$this->db->join('tb_jadwal_ujian', 'tb_jawaban_ujian.jadwal_ujian_id = tb_jadwal_ujian.id');
		$this->db->join('tb_matapelajaran', 'tb_jadwal_ujian.matapelajaran_id = tb_matapelajaran.id');
		$this->db->join('tb_kelasrombel', 'tb_jadwal_ujian.kelasrombel_id = tb_kelasrombel.id');
		$this->db->join('tb_kelas', 'tb_kelas.id = tb_kelasrombel.kelas_id');
		$this->db->where('tb_jawaban_ujian.id', $jawaban_ujian_id);
		$this->db->where('tb_jawaban_ujian.siswa_id', $siswa_id);
		$jawaban_ujian = $this->db->get()->row();

		if (!$jawaban_ujian) {
			echo '<script>alert("Data tidak ditemukan atau anda tidak memiliki akses")</script>';
			echo '<script>window.location.href="' . base_url('user/histori_jawaban') . '";</script>';
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
			'page' => 'siswa/histori_jawaban/detail',
			'script' => 'siswa/histori_jawaban/script',
			'link' => 'siswa/histori_jawaban'
		);
		$this->load->view('template_stisla/wrapper', $data);
	}
} 