<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ujianonline extends CI_Controller
{

	public $db;
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
				kr.tahunakademik_id as tahunakademik_id,
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
			'jadwal_ujian_id' => $jadwal_ujian_id,
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

	// versi hard-code
	public function cetak_kartu_ujian_multiple_code($kelas_id = null, $tahun_akademik_id = null)
	{
		// Ambil parameter filter
		if (!$kelas_id || !$tahun_akademik_id) {
			echo '<script>alert("Parameter kelas dan tahun akademik harus diisi")</script>';
			echo '<script>window.location.href="' . base_url() . 'admin/siswa";</script>';
			return;
		}

		// Query untuk mendapatkan semua siswa berdasarkan filter
		$this->db->select('tb_siswa.*, tb_kelasrombel.id as kelas_id, tb_kelas.nama_kelas, tb_tahunakademik.tahun, tb_tahunakademik.semester');
		$this->db->from('tb_siswa');
		$this->db->join('tb_kelassiswa', 'tb_siswa.id = tb_kelassiswa.siswa_id', 'inner');
		$this->db->join('tb_kelasrombel', 'tb_kelassiswa.kelasrombel_id = tb_kelasrombel.id', 'inner');
		$this->db->join('tb_kelas', 'tb_kelasrombel.kelas_id = tb_kelas.id', 'inner');
		$this->db->join('tb_tahunakademik', 'tb_kelasrombel.tahunakademik_id = tb_tahunakademik.id', 'inner');
		$this->db->where('tb_kelasrombel.id', $kelas_id);
		$this->db->where('tb_tahunakademik.id', $tahun_akademik_id);
		$this->db->order_by('tb_siswa.nama', 'ASC');

		$siswa_list = $this->db->get()->result();

		if (empty($siswa_list)) {
			echo '<script>alert("Tidak ada siswa ditemukan")</script>';
			echo '<script>window.location.href="' . base_url('Ujianonline') . '";</script>';
			return;
		}

		// Generate QR Code untuk setiap siswa
		require_once FCPATH . 'vendor/autoload.php';

		// Initialize mPDF
		$mpdf = new \Mpdf\Mpdf([
			'format' => 'A4',
			'margin_left' => 5,
			'margin_right' => 5,
			'margin_top' => 5,
			'margin_bottom' => 5,
		]);

		$qr_code_generator = new \chillerlan\QRCode\QRCode();

		// Definisikan jumlah siswa per batch (sesuaikan dengan kebutuhan)
		$batch_size = 20; // Proses 20 siswa per batch
		$total_siswa = count($siswa_list);
		$total_batches = ceil($total_siswa / $batch_size);

		// CSS yang akan digunakan
		$css = $this->getCSSForKartuUjian();

		for ($batch = 0; $batch < $total_batches; $batch++) {
			$start_index = $batch * $batch_size;
			$end_index = min(($batch + 1) * $batch_size, $total_siswa);

			// Ambil siswa untuk batch ini
			$current_batch = array_slice($siswa_list, $start_index, $end_index - $start_index);

			// Prepare data untuk batch ini
			$siswa_data = [];
			foreach ($current_batch as $siswa) {
				$qr_data = json_encode([
					"nis" => $siswa->nis,
					"id" => $siswa->id,
					"nama" => $siswa->nama,
				]);

				$qr_code_image = $qr_code_generator->render($qr_data);

				$siswa_data[] = [
					'detail_siswa' => $siswa,
					'qr_code_data' => $qr_data,
					'qr_code_image' => $qr_code_image,
				];
			}

			// Generate HTML untuk batch ini
			$html_content = $this->generateKartuHTML($siswa_data, $siswa_list[0]);

			// Jika batch pertama, tulis CSS + HTML
			if ($batch === 0) {
				$mpdf->WriteHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);
				$mpdf->WriteHTML($html_content, \Mpdf\HTMLParserMode::HTML_BODY);
			} else {
				// Untuk batch selanjutnya, tambah page break dan tulis HTML
				$mpdf->AddPage();
				$mpdf->WriteHTML($html_content, \Mpdf\HTMLParserMode::HTML_BODY);
			}
		}

		$mpdf->SetDisplayMode('fullpage');

		$filename = 'kartu_ujian_' . $siswa_list[0]->nama_kelas . '_' . date('Ymd_His') . '.pdf';
		$mpdf->Output($filename, 'I'); // 'I' untuk tampil di browser, 'D' untuk download
	}

	private function getCSSForKartuUjian()
	{
		return '
		<style>
			* {
				box-sizing: border-box;
				margin: 0;
				padding: 0;
				border: 0;
			}

			body {
				font-family: Arial, sans-serif;
				font-size: 9px;
				margin: 0;
				padding: 0;
				background: #f9f9f9;
			}

			.page-container {
				width: 100%;
			}

			.kartu-wrapper {
				width: 47%;
				float: left;
				padding: 10px;
			}

			.kartu-ujian {
				width: 95mm;
				height: 35mm;
				border: 1px solid #0066cc;
				border-radius: 3px;
				padding: 2mm;
				box-sizing: border-box;
				background: #fff;
				position: relative;
				overflow: hidden;
			}

			.header {
				text-align: center;
				margin-bottom: 2mm;
				border-bottom: 1px solid #0066cc;
				padding-bottom: 1mm;
			}

			.title {
				font-size: 11px;
				font-weight: bold;
				color: #0066cc;
				margin: 0;
			}

			.subtitle {
				font-size: 7px;
				color: #666;
				margin: 0;
			}

			.content {
				width: 100%;
				overflow: hidden;
				margin-top: 2mm;
			}

			.left-section {
				width: 64.5%;
				float: left;
			}

			.right-section {
				width: 34.5%;
				float: right;
				text-align: center;
			}

			.info-table {
				width: 100%;
				font-size: 10px;
			}

			.info-label {
				font-weight: bold;
				color: #333;
				width: 20mm;
				white-space: nowrap;
				font-size: 9px;
			}

			.info-colon {
				width: 3mm;
				color: #333;
				text-align: center;
				font-weight: normal;
				font-size: 9px;
			}

			.info-value {
				color: #000;
				white-space: nowrap;
				font-size: 9px;
			}

			.qr-placeholder {
				width: 25mm;
				height: 25mm;
				border: 1px dashed #ccc;
				display: block;
				margin: 0 auto;
				background: #f9f9f9;
				line-height: 25mm;
				text-align: center;
				font-size: 6px;
				color: #999;
			}

			.qr-text {
				font-size: 6px;
				margin-top: 1mm;
				color: #666;
				font-style: italic;
			}

			.footer {
				font-size: 6px;
				color: #666;
				text-align: center;
				border-top: 1px solid #ddd;
				padding-top: 1mm;
				margin-top: 2mm;
				clear: both;
			}

			.clearfix::after {
				content: "";
				display: table;
				clear: both;
			}
		</style>';
	}


	private function getJenisKelamin($siswa)
	{
		if (isset($siswa->jenis_kelamin)) {
			return ($siswa->jenis_kelamin === 'L') ? 'Laki-laki' : 'Perempuan';
		}
		return '-';
	}

	private function getTempaTanggalLahir($siswa)
	{
		$tempat = isset($siswa->tempat_lahir) ? htmlspecialchars($siswa->tempat_lahir) : '-';
		$tanggal = '-';

		if (isset($siswa->tanggal_lahir) && !empty($siswa->tanggal_lahir)) {
			$tanggal = date('d/m/Y', strtotime($siswa->tanggal_lahir));
		}

		return $tempat . ', ' . $tanggal;
	}

	private function generateKartuHTML($siswa_data, $info_kelas)
	{
		$html = '<div class="page-container clearfix">';

		foreach ($siswa_data as $data) {
			$siswa = $data['detail_siswa'];

			$html .= '
				<div class="kartu-wrapper">
					<div class="kartu-ujian">
						<div class="header">
							<h3 class="title">KARTU UJIAN SISWA</h3>
							<p class="subtitle">Tahun Akademik ' . $info_kelas->tahun . ' - Semester ' . $info_kelas->semester . '</p>
						</div>
						
						<div class="content">
							<div class="left-section">
								<table class="info-table">
									<tr>
										<td class="info-label">NIS</td>
										<td class="info-colon">:</td>
										<td class="info-value">' . htmlspecialchars($siswa->nis) . '</td>
									</tr>
									<tr>
										<td class="info-label">Nama</td>
										<td class="info-colon">:</td>
										<td class="info-value">' . htmlspecialchars($siswa->nama) . '</td>
									</tr>
									<tr>
										<td class="info-label">L/P</td>
										<td class="info-colon">:</td>
										<td class="info-value">' . $this->getJenisKelamin($siswa) . '</td>
									</tr>
									<tr>
										<td class="info-label">TTL</td>
										<td class="info-colon">:</td>
										<td class="info-value">' . $this->getTempaTanggalLahir($siswa) . '</td>
									</tr>
									<tr>
										<td class="info-label">Kelas</td>
										<td class="info-colon">:</td>
										<td class="info-value">' . htmlspecialchars($info_kelas->nama_kelas) . '</td>
									</tr>
								</table>
								
							</div>
							
							<div class="right-section">
								<img src="' . $data['qr_code_image'] . '" alt="QR Code" width="65%" style="max-width:200px;">
								<div class="qr-text">Scan untuk verifikasi</div>
							</div>
						</div>
						
						<div class="footer">
							Kartu Ujian Siswa di Cetak pada: ' . date('d/m/Y H:i:s') . '
						</div>
					</div>
				</div>';
		}

		$html .= '</div>';

		return $html;
	}

	// versi view
	public function cetak_kartu_ujian_multiple($kelas_id = null, $tahun_akademik_id = null)
	{

		// Ambil parameter filter
		if (!$kelas_id || !$tahun_akademik_id) {
			echo '<script>alert("Parameter kelas dan tahun akademik harus diisi")</script>';
			echo '<script>window.location.href="' . base_url() . 'admin/siswa";</script>';
			return;
		}

		// Query untuk mendapatkan semua siswa berdasarkan filter
		$this->db->select('tb_siswa.*, tb_kelasrombel.id as kelas_id, tb_kelas.nama_kelas, tb_tahunakademik.tahun, tb_tahunakademik.semester');
		$this->db->from('tb_siswa');
		$this->db->join('tb_kelassiswa', 'tb_siswa.id = tb_kelassiswa.siswa_id', 'inner');
		$this->db->join('tb_kelasrombel', 'tb_kelassiswa.kelasrombel_id = tb_kelasrombel.id', 'inner');
		$this->db->join('tb_kelas', 'tb_kelasrombel.kelas_id = tb_kelas.id', 'inner');
		$this->db->join('tb_tahunakademik', 'tb_kelasrombel.tahunakademik_id = tb_tahunakademik.id', 'inner');
		$this->db->where('tb_kelasrombel.id', $kelas_id);
		$this->db->where('tb_tahunakademik.id', $tahun_akademik_id);
		$this->db->order_by('tb_siswa.nama', 'ASC');

		$siswa_list = $this->db->get()->result();

		if (empty($siswa_list)) {
			echo '<script>alert("Tidak ada siswa ditemukan")</script>';
			echo '<script>window.location.href="' . base_url('Ujianonline') . '";</script>';
			return;
		}

		// Generate QR Code untuk setiap siswa
		require_once FCPATH . 'vendor/autoload.php';
		$qr_code_generator = new \chillerlan\QRCode\QRCode();

		// Prepare data untuk semua siswa
		$siswa_data = [];
		foreach ($siswa_list as $siswa) {
			$qr_data = json_encode([
				"nis" => $siswa->nis,
				"id" => $siswa->id,
				"nama" => $siswa->nama,
			]);

			$qr_code_image = $qr_code_generator->render($qr_data);

			$siswa_data[] = [
				'detail_siswa' => $siswa,
				'qr_code_data' => $qr_data,
				'qr_code_image' => $qr_code_image,
			];
		}

		$data = [
			'siswa_data' => $siswa_data,
			'tanggal_cetak' => date('d/m/Y H:i:s'),
			'info_kelas' => $siswa_list[0] // Ambil info kelas dari siswa pertama
		];

		// Render HTML untuk PDF
		$html = $this->load->view('ujianonline/kartu_ujian_multiple', $data, true);

		// Generate PDF dengan ukuran F4 (210mm x 330mm)
		$mpdf = new \Mpdf\Mpdf([
			'format' => 'A4', // Ukuran F4
			'margin_left' => 5,
			'margin_right' => 5,
			'margin_top' => 5,
			'margin_bottom' => 5,
		]);

		$mpdf->WriteHTML($html);
		$mpdf->SetDisplayMode('fullpage');

		$filename = 'kartu_ujian_' . $siswa_list[0]->nama_kelas . '_' . date('Ymd_His') . '.pdf';
		$mpdf->Output($filename, 'I'); // 'I' untuk tampil di browser, 'D' untuk download
	}
}
