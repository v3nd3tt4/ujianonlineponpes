<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Assignsoal extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');

		$roles = $this->session->userdata('rule');
		$allow = ['admin', 'guru', 'kepala sekolah'];
		if (!in_array($roles, $allow)) {
			echo '<script>alert("Maaf, anda tidak diizinkan mengakses halaman ini")</script>';
			echo '<script>window.location.href="' . base_url() . '";</script>';
		}
	}

	public function index()
	{
		$data = array(
			'page' => 'admin/master/assignsoal/index',
			'script' => 'admin/master/assignsoal/script',
			'link' => 'Admin/Assignsoal'
		);
		$this->load->view('template_stisla/wrapper', $data);
	}

	public function get_all_jadwal()
	{
		$this->db->select('
            j.id, 
            m.kode_matapelajaran, 
            m.nama_matapelajaran, 
            k.nama_kelas, 
            ta.tahun, 
            p.nama as nama_walikelas, 
            j.tanggal_ujian, 
            j.jenis_ujian,
            bs.keterangan as nama_banksoal,
            p_pembuat.nama as pembuat_soal,
            j.matapelajaran_id
        ');
		$this->db->from('tb_jadwal_ujian j');
		$this->db->join('tb_matapelajaran m', 'j.matapelajaran_id = m.id');
		$this->db->join('tb_kelasrombel kr', 'j.kelasrombel_id = kr.id');
		$this->db->join('tb_kelas k', 'kr.kelas_id = k.id');
		$this->db->join('tb_tahunakademik ta', 'kr.tahunakademik_id = ta.id');
		$this->db->join('tb_pegawai p', 'kr.walikelas_id = p.id');
		$this->db->join('tb_banksoal bs', 'j.banksoal_id = bs.id', 'left'); // LEFT JOIN in case no bank is assigned
		$this->db->join('tb_pegawai p_pembuat', 'bs.pegawai_id = p_pembuat.id', 'left');
		$query = $this->db->get();
		echo json_encode($query->result());
	}

	public function get_bank_soal_by_mapel($matapelajaran_id)
	{
		$this->db->select('
            bs.id, 
            bs.keterangan,
            mp.nama_matapelajaran,
            mp.kode_matapelajaran,
            p.nama as pembuat_soal
        ');
		$this->db->from('tb_banksoal bs');
		$this->db->join('tb_matapelajaran mp', 'bs.matapelajaran_id = mp.id');
		$this->db->join('tb_pegawai p', 'bs.pegawai_id = p.id');
		$this->db->where('bs.matapelajaran_id', $matapelajaran_id);
		$query = $this->db->get();
		echo json_encode($query->result());
	}

	public function save_assignment()
	{
		$jadwal_id = $this->input->post('jadwal_id');
		$banksoal_id = $this->input->post('banksoal_id');

		if (empty($jadwal_id) || empty($banksoal_id)) {
			echo json_encode(['status' => FALSE, 'message' => 'Data tidak lengkap.']);
			return;
		}

		$this->db->where('id', $jadwal_id);
		$this->db->update('tb_jadwal_ujian', ['banksoal_id' => $banksoal_id]);

		echo json_encode(['status' => TRUE, 'message' => 'Bank soal berhasil ditetapkan!']);
	}
}
