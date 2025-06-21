<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Kelasrombel_model');
        $this->load->model('Kelas_model');
        $this->load->model('Tahunakademik_model');
        $this->load->model('Pegawai_model');
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
        
        $data = array(
            'page' => 'admin/master/kelasrombel/siswa',
            'script' => 'admin/master/kelasrombel/script',
            'kelas' => $kelas,
            'kelasrombel' => $kelasrombel,
            'siswa_kelas' => $this->Kelasrombel_model->get_siswa_by_kelas($kelasrombel_id),
            'link' => 'Admin/Kelasrombel/Index'
        );
        $this->load->view('template_miminium/wrapper', $data);
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