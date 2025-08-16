<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
		$this->load->helper(array('url', 'form'));

		$roles = $this->session->userdata('rule');
		$allow = ['siswa'];
		if (!in_array($roles, $allow)) {
			echo '<script>alert("Maaf, anda tidak diizinkan mengakses halaman ini")</script>';
			echo '<script>window.location.href="' . base_url() . '";</script>';
		}
	}

	public function index()
	{
		$siswa_id = $this->session->userdata('id_user');

		// Get all classes that the student is enrolled in
		$this->db->select('tb_kelassiswa.*, tb_kelas.nama_kelas, tb_kelas.keterangan, tb_kelasrombel.id as kelasrombel_id, tb_tahunakademik.tahun, tb_tahunakademik.semester, tb_pegawai.nama as wali_kelas');
		$this->db->from('tb_kelassiswa');
		$this->db->join('tb_kelasrombel', 'tb_kelasrombel.id = tb_kelassiswa.kelasrombel_id');
		$this->db->join('tb_kelas', 'tb_kelas.id = tb_kelasrombel.kelas_id');
		$this->db->join('tb_tahunakademik', 'tb_tahunakademik.id = tb_kelasrombel.tahunakademik_id');
		$this->db->join('tb_pegawai', 'tb_pegawai.id = tb_kelasrombel.walikelas_id');
		$this->db->where('tb_kelassiswa.siswa_id', $siswa_id);
		$this->db->order_by('tb_tahunakademik.tahun', 'DESC');
		$this->db->order_by('tb_tahunakademik.semester', 'ASC');
		$this->db->order_by('tb_kelas.nama_kelas', 'ASC');
		$kelas_list = $this->db->get()->result();

		$data = array(
			'kelas_list' => $kelas_list,
			'page' => 'siswa/kelas/index',
			'script' => 'siswa/kelas/script',
			'link' => 'siswa/kelas'
		);
		$this->load->view('template_stisla/wrapper', $data);
	}

	public function siswa_kelas($kelasrombel_id)
	{
		// Check if the current student is in this class
		$current_siswa_id = $this->session->userdata('id_user');

		if (!$current_siswa_id) {
			show_404();
		}

		// Check if current student is in this class
		$this->db->select('tb_kelassiswa.kelasrombel_id');
		$this->db->from('tb_kelassiswa');
		$this->db->where('tb_kelassiswa.siswa_id', $current_siswa_id);
		$this->db->where('tb_kelassiswa.kelasrombel_id', $kelasrombel_id);
		$is_in_class = $this->db->get()->row();

		if (!$is_in_class) {
			show_404();
		}

		// Get all students in this class
		$this->db->select('tb_siswa.*, tb_kelassiswa.id as kelassiswa_id');
		$this->db->from('tb_siswa');
		$this->db->join('tb_kelassiswa', 'tb_kelassiswa.siswa_id = tb_siswa.id');
		$this->db->where('tb_kelassiswa.kelasrombel_id', $kelasrombel_id);
		$this->db->order_by('tb_siswa.nama', 'ASC');
		$siswa_kelas = $this->db->get()->result();

		// For AJAX request, return only the siswa list content
		if ($this->input->is_ajax_request()) {
			$data = array(
				'siswa_kelas' => $siswa_kelas
			);
			$this->load->view('siswa/kelas/siswa_kelas', $data);
		} else {
			show_404();
		}
	}

	public function biodata($siswa_id)
	{
		// Check if the requested student is in the same class as the logged-in student
		$current_siswa_id = $this->session->userdata('id_user');

		if (!$current_siswa_id) {
			show_404();
		}

		// Get current student's class
		$this->db->select('tb_kelassiswa.kelasrombel_id');
		$this->db->from('tb_kelassiswa');
		$this->db->where('tb_kelassiswa.siswa_id', $current_siswa_id);
		$current_class = $this->db->get()->row();

		if (!$current_class) {
			show_404();
		}

		// Check if requested student is in the same class
		$this->db->select('tb_kelassiswa.kelasrombel_id');
		$this->db->from('tb_kelassiswa');
		$this->db->where('tb_kelassiswa.siswa_id', $siswa_id);
		$this->db->where('tb_kelassiswa.kelasrombel_id', $current_class->kelasrombel_id);
		$target_class = $this->db->get()->row();

		if (!$target_class) {
			show_404();
		}

		// Get student biodata
		$this->db->select('tb_siswa.*');
		$this->db->from('tb_siswa');
		$this->db->where('tb_siswa.id', $siswa_id);
		$siswa = $this->db->get()->row();

		if (!$siswa) {
			show_404();
		}

		// Generate QR code data
		$qr_data = json_encode([
			'nis' => $siswa->nis,
			'id' => $siswa->id
		]);

		// For AJAX request, return only the biodata content
		if ($this->input->is_ajax_request()) {
			$data = array(
				'siswa' => $siswa,
				'qr_data' => $qr_data
			);
			$this->load->view('siswa/kelas/biodata', $data);
		} else {
			// For direct access, return full template
			$data = array(
				'siswa' => $siswa,
				'qr_data' => $qr_data,
				'page' => 'siswa/kelas/biodata',
				'link' => 'siswa/kelas'
			);
			$this->load->view('template_stisla/wrapper', $data);
		}
	}

	public function generate_qr($siswa_id)
	{
		// Check if the requested student is in the same class as the logged-in student
		$current_siswa_id = $this->session->userdata('id_user');

		if (!$current_siswa_id) {
			show_404();
		}

		// Get current student's class
		$this->db->select('tb_kelassiswa.kelasrombel_id');
		$this->db->from('tb_kelassiswa');
		$this->db->where('tb_kelassiswa.siswa_id', $current_siswa_id);
		$current_class = $this->db->get()->row();

		if (!$current_class) {
			show_404();
		}

		// Check if requested student is in the same class
		$this->db->select('tb_kelassiswa.kelasrombel_id');
		$this->db->from('tb_kelassiswa');
		$this->db->where('tb_kelassiswa.siswa_id', $siswa_id);
		$this->db->where('tb_kelassiswa.kelasrombel_id', $current_class->kelasrombel_id);
		$target_class = $this->db->get()->row();

		if (!$target_class) {
			show_404();
		}

		// Get student data
		$this->db->select('tb_siswa.nis, tb_siswa.id, tb_siswa.nama');
		$this->db->from('tb_siswa');
		$this->db->where('tb_siswa.id', $siswa_id);
		$siswa = $this->db->get()->row();

		if (!$siswa) {
			show_404();
		}

		// Generate QR code data (do not allow user to change qr_data via GET/POST)
		$qr_data = json_encode([
			'nis' => $siswa->nis,
			'nama' => $siswa->nama,
			'id' => $siswa->id
		], JSON_UNESCAPED_UNICODE);

		// Use Google Charts API for QR code generation (free and no dependencies)
		$qr_url = "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=" . urlencode($qr_data) . "&choe=UTF-8";

		// Output QR code image directly
		header('Content-Type: image/png');
		readfile($qr_url);
		exit;
	}

	public function cetak_kartu_ujian()
	{
		$siswa_id = $this->session->userdata('id_user');
		$nis = $this->session->userdata('nis');
		$nama = $this->session->userdata('nama');


		if (!$siswa_id || !$nis || !$nama) {
			echo '<script>alert("Data siswa tidak lengkap")</script>';
			echo '<script>window.location.href="' . base_url() . '";</script>';
			return;
		}

		// Query detail siswa lengkap
		$this->db->select('tb_siswa.*, tb_kelasrombel.id as kelas_id, tb_kelas.nama_kelas, tb_tahunakademik.tahun, tb_tahunakademik.semester');
		$this->db->from('tb_siswa');
		$this->db->join('tb_kelassiswa', 'tb_siswa.id = tb_kelassiswa.siswa_id', 'left');
		$this->db->join('tb_kelasrombel', 'tb_kelassiswa.kelasrombel_id = tb_kelasrombel.id', 'left');
		$this->db->join('tb_kelas', 'tb_kelasrombel.kelas_id = tb_kelas.id', 'left');
		$this->db->join('tb_tahunakademik', 'tb_kelasrombel.tahunakademik_id = tb_tahunakademik.id', 'left');
		$this->db->where('tb_siswa.id', $siswa_id);
		$detail_siswa = $this->db->get()->row();

		if (!$detail_siswa) {
			echo '<script>alert("Data siswa tidak ditemukan")</script>';
			echo '<script>window.location.href="' . base_url() . '";</script>';
			return;
		}

		// Create QR code data
		$qr_data = json_encode([
			"nis" => $nis,
			"id" => $siswa_id,
			"nama" => $nama,
		]);

		// Generate QR Code menggunakan library QR Code
		require_once FCPATH . 'vendor/autoload.php';

		// Generate QR Code image
		$qr_code_generator = new \chillerlan\QRCode\QRCode();
		$qr_code_image = $qr_code_generator->render($qr_data);

		$data = [
			'detail_siswa' => $detail_siswa,
			'qr_code_data' => $qr_data,
			'qr_code_image' => $qr_code_image,
			'tanggal_cetak' => date('d/m/Y H:i:s')
		];

		// Render HTML untuk PDF
		$html = $this->load->view('siswa/kartu_ujian/kartu_ujian', $data, true);

		// Generate PDF
		$mpdf = new \Mpdf\Mpdf([
			'format' => [85, 50], // Ukuran kartu credit card (85mm x 54mm)
			'margin_left' => 5,
			'margin_right' => 5,
			'margin_top' => 5,
			'margin_bottom' => 5,
		]);

		$mpdf->WriteHTML($html);
		$mpdf->SetDisplayMode('fullpage');
		$filename = 'kartu_ujian_' . $nis . '_' . date('Ymd_His') . '.pdf';
		$mpdf->Output($filename, 'I'); // 'I' untuk tampil di browser, 'D' untuk download
	}
}
