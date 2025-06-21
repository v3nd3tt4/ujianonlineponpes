<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwalujian extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // The user requested no model.
        // All database operations will be done directly in the controller.
        $this->load->database();
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index() {
        $data = array(
            'page' => 'admin/master/jadwalujian/index',
            'script' => 'admin/master/jadwalujian/script',
            'link' => 'Admin/Jadwalujian'
        );
        $this->load->view('template_miminium/wrapper', $data);
    }

    public function get_all_data() {
        $this->db->select('a.id, b.kode_matapelajaran, b.nama_matapelajaran, c.nama_kelas, ta.tahun, p.nama as nama_walikelas, a.tanggal_ujian, a.jam_mulai, a.jenis_ujian');
        $this->db->from('tb_jadwal_ujian a');
        $this->db->join('tb_matapelajaran b', 'a.matapelajaran_id = b.id');
        $this->db->join('tb_kelasrombel kr', 'a.kelasrombel_id = kr.id');
        $this->db->join('tb_kelas c', 'kr.kelas_id = c.id');
        $this->db->join('tb_tahunakademik ta', 'kr.tahunakademik_id = ta.id');
        $this->db->join('tb_pegawai p', 'kr.walikelas_id = p.id');
        $query = $this->db->get();
        $result = $query->result();
        echo json_encode($result);
    }

    public function get_data_for_form() {
        // Get Mata Pelajaran
        $this->db->select('id, nama_matapelajaran, kode_matapelajaran');
        $matapelajaran = $this->db->get('tb_matapelajaran')->result();

        // Get Kelas Rombel (with correct name)
        $this->db->select('kr.id, k.nama_kelas as nama_kelas_rombel, ta.tahun, p.nama');
        $this->db->from('tb_kelasrombel kr');
        $this->db->join('tb_kelas k', 'kr.kelas_id = k.id');
        $this->db->join('tb_tahunakademik ta', 'ta.id = kr.tahunakademik_id' );
        $this->db->join('tb_pegawai p', 'p.id = kr.walikelas_id' );
        $kelasrombel = $this->db->get()->result();
        
        echo json_encode(array(
            'matapelajaran' => $matapelajaran,
            'kelasrombel' => $kelasrombel
        ));
    }

    public function get_by_id($id) {
        $data = $this->db->get_where('tb_jadwal_ujian', array('id' => $id))->row();
        echo json_encode($data);
    }

    public function store() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $errors = validation_errors();
            echo json_encode(['status' => FALSE, 'message' => $errors]);
        } else {
            $id = $this->input->post('id');
            $data = $this->_get_posted_data();

            if ($id) {
                // Update
                $this->db->where('id', $id);
                $this->db->update('tb_jadwal_ujian', $data);
                $message = 'Data jadwal ujian berhasil diupdate!';
            } else {
                // Create
                $this->db->insert('tb_jadwal_ujian', $data);
                $message = 'Data jadwal ujian berhasil ditambahkan!';
            }
            echo json_encode(['status' => TRUE, 'message' => $message]);
        }
    }

    public function destroy($id) {
        $this->db->where('id', $id);
        $this->db->delete('tb_jadwal_ujian');
        echo json_encode(['status' => TRUE, 'message' => 'Data jadwal ujian berhasil dihapus!']);
    }

    private function _rules() {
        $this->form_validation->set_rules('matapelajaran_id', 'Mata Pelajaran', 'required');
        $this->form_validation->set_rules('kelasrombel_id', 'Kelas Rombel', 'required');
        $this->form_validation->set_rules('tanggal_ujian', 'Tanggal Ujian', 'required');
        $this->form_validation->set_rules('jam_mulai', 'Jam Mulai', 'required');
        $this->form_validation->set_rules('jam_selesai', 'Jam Selesai', 'required');
        $this->form_validation->set_rules('lama_ujian', 'Lama Ujian', 'required|numeric');
        $this->form_validation->set_rules('jenis_ujian', 'Jenis Ujian', 'required');
    }

    private function _get_posted_data() {
        return [
            'matapelajaran_id' => $this->input->post('matapelajaran_id', TRUE),
            'kelasrombel_id' => $this->input->post('kelasrombel_id', TRUE),
            'tanggal_ujian' => $this->input->post('tanggal_ujian', TRUE),
            'jam_mulai' => $this->input->post('jam_mulai', TRUE),
            'jam_selesai' => $this->input->post('jam_selesai', TRUE),
            'lama_ujian' => $this->input->post('lama_ujian', TRUE),
            'jenis_ujian' => $this->input->post('jenis_ujian', TRUE),
        ];
    }
} 