<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Presensi_ujian extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('form_validation');
        $this->load->library('session');

        $roles = $this->session->userdata('rule');
        $allow = ['guru', 'kepala sekolah', 'admin'];
        if (!in_array($roles, $allow)) {
            echo '<script>alert("Maaf, anda tidak diizinkan mengakses halaman ini")</script>';
            echo '<script>window.location.href="' . base_url() . '";</script>';
        }
    }

    public function index()
    {
        $guru_id = $this->session->userdata('id_user');
        $this->db->select('tb_matapelajaran.*');
        $this->db->from('tb_gurumatapelajaran');
        $this->db->join('tb_matapelajaran', 'tb_gurumatapelajaran.matapelajaran_id = tb_matapelajaran.id');
        $this->db->where('tb_gurumatapelajaran.pegawai_id', $guru_id);
        $query = $this->db->get();

        $data = array(
            'page' => 'guru/presensi_ujian/index',
            'script' => 'guru/presensi_ujian/script',
            'link' => 'guru/presensi_ujian',
            'mapel' => $query->result(),
        );
        $this->load->view('template_stisla/wrapper', $data);
    }

    public function get_kelas_by_mapel()
    {
        $matapelajaran_id = $this->input->post('matapelajaran_id');
        $kelas = [];

        if ($matapelajaran_id) {
            $this->db->select('tb_kelas.id, tb_kelas.nama_kelas, tb_tahunakademik.tahun, tb_tahunakademik.semester, tb_pegawai.nama as wali_kelas');
            $this->db->from('tb_jadwal_ujian');
            $this->db->join('tb_kelasrombel', 'tb_jadwal_ujian.kelasrombel_id = tb_kelasrombel.id');
            $this->db->join('tb_kelas', 'tb_kelasrombel.kelas_id = tb_kelas.id');
            $this->db->join('tb_tahunakademik', 'tb_kelasrombel.tahunakademik_id = tb_tahunakademik.id');
            $this->db->join('tb_pegawai', 'tb_kelasrombel.walikelas_id = tb_pegawai.id');
            $this->db->where('tb_jadwal_ujian.matapelajaran_id', $matapelajaran_id);
            $this->db->group_by('tb_kelas.id, tb_tahunakademik.tahun, tb_tahunakademik.semester, tb_pegawai.nama');
            $query = $this->db->get();
            $kelas = $query->result();
        }

        echo json_encode($kelas);
    }

    public function cetak_pdf()
    {
        $matapelajaran_id = $this->input->post('matapelajaran_id');
        $kelas_id = $this->input->post('kelas_id');

        $kelasrombel = $this->db->get_where('tb_kelasrombel', ['kelas_id' => $kelas_id])->row();
        $kelasrombel_id = $kelasrombel ? $kelasrombel->id : null;

        // Query presensi ujian
        $this->db->select('tb_presensi_ujian.*, tb_siswa.nama as nama_siswa, tb_siswa.nis');
        $this->db->from('tb_presensi_ujian');
        $this->db->join('tb_siswa', 'tb_presensi_ujian.siswa_id = tb_siswa.id');
        $this->db->where('tb_presensi_ujian.jadwal_ujian_id IN (SELECT id FROM tb_jadwal_ujian WHERE matapelajaran_id = ' . $this->db->escape($matapelajaran_id) . ' AND kelasrombel_id = ' . $this->db->escape($kelasrombel_id) . ')', null, false);
        $presensi_ujian = $this->db->get()->result();

        // Query detail matapelajaran, kelas, wali kelas, tahun akademik
        $this->db->select('tb_matapelajaran.nama_matapelajaran, tb_kelas.nama_kelas, tb_pegawai.nama as wali_kelas, tb_tahunakademik.tahun, tb_tahunakademik.semester');
        $this->db->from('tb_kelasrombel');
        $this->db->join('tb_kelas', 'tb_kelasrombel.kelas_id = tb_kelas.id');
        $this->db->join('tb_pegawai', 'tb_kelasrombel.walikelas_id = tb_pegawai.id');
        $this->db->join('tb_tahunakademik', 'tb_kelasrombel.tahunakademik_id = tb_tahunakademik.id');
        $this->db->join('tb_jadwal_ujian', 'tb_jadwal_ujian.kelasrombel_id = tb_kelasrombel.id');
        $this->db->join('tb_matapelajaran', 'tb_jadwal_ujian.matapelajaran_id = tb_matapelajaran.id');
        $this->db->where('tb_kelasrombel.id', $kelasrombel_id);
        $this->db->where('tb_matapelajaran.id', $matapelajaran_id);
        $this->db->limit(1);
        $detail = $this->db->get()->row();

        $data = [
            'presensi_ujian' => $presensi_ujian,
            'detail' => $detail,
        ];

        // Render HTML
        $html = $this->load->view('guru/presensi_ujian/laporan_presensi_ujian', $data, true);

        // PDF
        require_once FCPATH . 'vendor/autoload.php';
        $mpdf = new \Mpdf\Mpdf(['format' => 'A4-P']);
        $mpdf->WriteHTML($html);
        $mpdf->SetDisplayMode('fullpage');
        $filename = 'laporan_presensi_ujian_' . date('Ymd_His') . '.pdf';
        $mpdf->Output($filename, 'I');
    }
}