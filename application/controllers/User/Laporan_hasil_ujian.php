<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_hasil_ujian extends CI_Controller
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
			'page' => 'siswa/laporan_hasil_ujian/index',
			'script' => 'siswa/laporan_hasil_ujian/script',
			'link' => 'siswa/laporan_hasil_ujian'
		);
		$this->load->view('template_stisla/wrapper', $data);
    }

	public function cetak_pdf()
	{
		$siswa_id = $this->session->userdata('id_user');
		$kelas_id = $this->input->post('kelasrombel_id'); // This is actually kelas_id due to FK constraint issue

		if (!$kelas_id) {
			echo '<script>alert("Silahkan pilih kelas terlebih dahulu")</script>';
			echo '<script>window.location.href="' . base_url('user/laporan_hasil_ujian') . '";</script>';
			return;
		}

		// Query hasil ujian siswa berdasarkan kelas_id dan siswa_id
		$this->db->select('tb_jawaban_ujian.*, tb_siswa.nama as nama_siswa, tb_siswa.nis, tb_matapelajaran.nama_matapelajaran, tb_jadwal_ujian.jenis_ujian, tb_jadwal_ujian.tanggal_ujian, tb_jadwal_ujian.jam_mulai, tb_jadwal_ujian.jam_selesai, tb_jadwal_ujian.lama_ujian');
		$this->db->from('tb_jawaban_ujian');
		$this->db->join('tb_siswa', 'tb_jawaban_ujian.siswa_id = tb_siswa.id');
		$this->db->join('tb_jadwal_ujian', 'tb_jawaban_ujian.jadwal_ujian_id = tb_jadwal_ujian.id');
		$this->db->join('tb_matapelajaran', 'tb_jadwal_ujian.matapelajaran_id = tb_matapelajaran.id');
		$this->db->join('tb_kelasrombel', 'tb_jadwal_ujian.kelasrombel_id = tb_kelasrombel.id');
		$this->db->where('tb_jawaban_ujian.siswa_id', $siswa_id);
		$this->db->where('tb_kelasrombel.id', $kelas_id);
		$this->db->order_by('tb_jadwal_ujian.tanggal_ujian', 'DESC');
		$this->db->order_by('tb_matapelajaran.nama_matapelajaran', 'ASC');
		$hasil_ujian = $this->db->get()->result();
		// echo $this->db->last_query();exit();

		// Query detail kelas, wali kelas, tahun akademik
		$this->db->select('tb_kelas.nama_kelas, tb_pegawai.nama as wali_kelas, tb_tahunakademik.tahun, tb_tahunakademik.semester');
		$this->db->from('tb_kelasrombel');
		$this->db->join('tb_kelas', 'tb_kelas.id = tb_kelasrombel.kelas_id');
		$this->db->join('tb_pegawai', 'tb_kelasrombel.walikelas_id = tb_pegawai.id');
		$this->db->join('tb_tahunakademik', 'tb_kelasrombel.tahunakademik_id = tb_tahunakademik.id');
		$this->db->where('tb_kelasrombel.id', $kelas_id);
		$this->db->limit(1);
		$detail_kelas = $this->db->get()->row();

		// Query detail siswa
		$this->db->select('tb_siswa.nama, tb_siswa.nis, tb_siswa.tempat_lahir, tb_siswa.tanggal_lahir, tb_siswa.jenis_kelamin');
		$this->db->from('tb_siswa');
		$this->db->where('tb_siswa.id', $siswa_id);
		$detail_siswa = $this->db->get()->row();

		$data = [
			'hasil_ujian' => $hasil_ujian,
			'detail_kelas' => $detail_kelas,
			'detail_siswa' => $detail_siswa,
		];

		// Render HTML
		$html = $this->load->view('siswa/laporan_hasil_ujian/laporan_pdf', $data, true);

		// PDF
		require_once FCPATH . 'vendor/autoload.php';
		$mpdf = new \Mpdf\Mpdf([
			'format' => 'A4-P',
			'margin_left' => 15,
			'margin_right' => 15,
			'margin_top' => 15,
			'margin_bottom' => 15,
		]);
		$mpdf->WriteHTML($html);
		$mpdf->SetDisplayMode('fullpage');
		$filename = 'laporan_hasil_ujian_siswa_' . date('Ymd_His') . '.pdf';
		$mpdf->Output($filename, 'I');
	}
}
