<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Kelasrombel_model');
        $this->load->model('Kelas_model');
        $this->load->model('Tahunakademik_model');
        $this->load->model('Pegawai_model');
        $this->load->model('Siswa_model');
        $this->load->model('Kelassiswa_model');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index() {
        $data = array(
            'page' => 'admin/master/kelasrombel/index',
            'script' => 'admin/master/kelasrombel/script',
            'kelasrombel' => $this->Kelasrombel_model->get_all_with_relations(),
            'link' => 'Admin/Kelasrombel/Index'
        );
        $this->load->view('template_miminium/wrapper', $data);
    }

    public function siswa($kelasrombel_id) {
        $kelasrombel = $this->Kelasrombel_model->get_by_id($kelasrombel_id);
        if (!$kelasrombel) show_404();
        
        $kelas = $this->Kelas_model->get_by_id($kelasrombel->kelas_id);
        $siswa = $this->Siswa_model->get_all();
        
        $data = array(
            'page' => 'admin/master/kelasrombel/siswa',
            'script' => 'admin/master/kelasrombel/script',
            'kelas' => $kelas,
            'kelasrombel' => $kelasrombel,
            'siswa_kelas' => $this->Kelasrombel_model->get_siswa_by_kelas($kelasrombel_id),
            'link' => 'Admin/Kelasrombel/Index',
            'siswa_list' => $siswa
        );
        $this->load->view('template_miminium/wrapper', $data);
    }

    public function simpanSiswa() {
        // Validasi input
        $this->form_validation->set_rules('id_kelasrombel', 'Kelas Rombel', 'required|numeric');
        $this->form_validation->set_rules('id_siswa', 'Siswa', 'required|numeric');
        
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'Data tidak valid! ' . validation_errors());
            redirect('Admin/Kelasrombel/Index/siswa/' . $this->input->post('id_kelasrombel'));
            return;
        }
        
        $kelasrombel_id = $this->input->post('id_kelasrombel');
        $siswa_id = $this->input->post('id_siswa');
        
        // Cek apakah siswa sudah ada di kelas rombel ini
        if ($this->Kelassiswa_model->cek_siswa_di_kelasrombel($siswa_id, $kelasrombel_id)) {
            $this->session->set_flashdata('error', 'Siswa sudah terdaftar dalam kelas ini!');
            redirect('Admin/Kelasrombel/Index/siswa/' . $kelasrombel_id);
            return;
        }
        
        // Ambil data kelas rombel untuk mendapatkan kelas_id
        $kelasrombel = $this->Kelasrombel_model->get_by_id($kelasrombel_id);
        if (!$kelasrombel) {
            $this->session->set_flashdata('error', 'Data kelas rombel tidak ditemukan!');
            redirect('Admin/Kelasrombel/Index');
            return;
        }
        
        // Data untuk disimpan
        $data = array(
            'siswa_id' => $siswa_id,
            'kelasrombel_id' => $kelasrombel_id,
        );
        
        // Simpan data
        if ($this->Kelassiswa_model->insert($data)) {
            $this->session->set_flashdata('success', 'Siswa berhasil ditambahkan ke kelas!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menambahkan siswa ke kelas!');
        }
        
        redirect('Admin/Kelasrombel/Index/siswa/' . $kelasrombel_id);
    }

    public function hapusSiswa($id) {
        $kelassiswa = $this->Kelassiswa_model->get_by_id($id);
        if (!$kelassiswa) {
            $this->session->set_flashdata('error', 'Data tidak ditemukan!');
            redirect('Admin/Kelasrombel/Index');
            return;
        }
        
        if ($this->Kelassiswa_model->delete($id)) {
            $this->session->set_flashdata('success', 'Siswa berhasil dihapus dari kelas!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus siswa dari kelas!');
        }
        
        redirect('Admin/Kelasrombel/Index/siswa/' . $kelassiswa->kelasrombel_id);
    }

    public function create() {
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'page' => 'admin/master/kelasrombel/form',
                'script' => 'admin/master/kelasrombel/script',
                'kelas' => $this->Kelas_model->get_all(),
                'tahunakademik' => $this->Tahunakademik_model->get_all(),
                'pegawai' => $this->Pegawai_model->get_all(),
                'link' => 'Admin/Kelasrombel/Index'
            );
            $this->load->view('template_miminium/wrapper', $data);
        } else {
            $data = $this->_get_posted_data();
            $this->Kelasrombel_model->insert($data);
            $this->session->set_flashdata('success', 'Data kelas rombel berhasil ditambahkan!');
            redirect('Admin/Kelasrombel/Index');
        }
    }

    public function edit($id) {
        $kelasrombel = $this->Kelasrombel_model->get_by_id($id);
        if (!$kelasrombel) show_404();
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'page' => 'admin/master/kelasrombel/form',
                'script' => 'admin/master/kelasrombel/script',
                'kelasrombel' => $kelasrombel,
                'kelas' => $this->Kelas_model->get_all(),
                'tahunakademik' => $this->Tahunakademik_model->get_all(),
                'pegawai' => $this->Pegawai_model->get_all(),
                'link' => 'Admin/Kelasrombel/Index'
            );
            $this->load->view('template_miminium/wrapper', $data);
        } else {
            $data = $this->_get_posted_data();
            $this->Kelasrombel_model->update($id, $data);
            $this->session->set_flashdata('success', 'Data kelas rombel berhasil diupdate!');
            redirect('Admin/Kelasrombel/Index');
        }
    }

    public function delete($id) {
        $this->Kelasrombel_model->delete($id);
        $this->session->set_flashdata('success', 'Data kelas rombel berhasil dihapus!');
        redirect('Admin/Kelasrombel/Index');
    }

    private function _rules() {
        $this->form_validation->set_rules('kelas_id', 'Kelas', 'required');
        $this->form_validation->set_rules('tahunakademik_id', 'Tahun Akademik', 'required');
        $this->form_validation->set_rules('walikelas_id', 'Wali Kelas', 'required');
    }

    private function _get_posted_data() {
        return [
            'kelas_id' => $this->input->post('kelas_id', TRUE),
            'tahunakademik_id' => $this->input->post('tahunakademik_id', TRUE),
            'walikelas_id' => $this->input->post('walikelas_id', TRUE),
        ];
    }
} 