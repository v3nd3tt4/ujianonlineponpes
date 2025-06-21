<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Kelas_model');
        $this->load->model('Kelassiswa_model');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index() {
        $data = array(
            'page' => 'admin/master/kelas/index',
            'script' => 'admin/master/kelas/script',
            'kelas' => $this->Kelas_model->get_all(),
            'link' => 'Admin/Kelas/Index'
        );
        $this->load->view('template_miminium/wrapper', $data);
    }

    public function siswa($kelas_id) {
        $kelas = $this->Kelas_model->get_by_id($kelas_id);
        if (!$kelas) show_404();
        
        $data = array(
            'page' => 'admin/master/kelas/siswa',
            'script' => 'admin/master/kelas/script',
            'kelas' => $kelas,
            'siswa_kelas' => $this->Kelassiswa_model->get_siswa_by_kelas($kelas_id),
            'link' => 'Admin/Kelas/Index'
        );
        $this->load->view('template_miminium/wrapper', $data);
    }

    public function create() {
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'page' => 'admin/master/kelas/form',
                'script' => 'admin/master/kelas/script',
                'link' => 'Admin/Kelas/Index'
            );
            $this->load->view('template_miminium/wrapper', $data);
        } else {
            $data = $this->_get_posted_data();
            $this->Kelas_model->insert($data);
            $this->session->set_flashdata('success', 'Data kelas berhasil ditambahkan!');
            redirect('Admin/Kelas/Index');
        }
    }

    public function edit($id) {
        $kelas = $this->Kelas_model->get_by_id($id);
        if (!$kelas) show_404();
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'page' => 'admin/master/kelas/form',
                'script' => 'admin/master/kelas/script',
                'kelas' => $kelas,
                'link' => 'Admin/Kelas/Index'
            );
            $this->load->view('template_miminium/wrapper', $data);
        } else {
            $data = $this->_get_posted_data();
            $this->Kelas_model->update($id, $data);
            $this->session->set_flashdata('success', 'Data kelas berhasil diupdate!');
            redirect('Admin/Kelas/Index');
        }
    }

    public function delete($id) {
        $this->Kelas_model->delete($id);
        $this->session->set_flashdata('success', 'Data kelas berhasil dihapus!');
        redirect('Admin/Kelas/Index');
    }

    private function _rules() {
        $this->form_validation->set_rules('nama_kelas', 'Nama Kelas', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
    }

    private function _get_posted_data() {
        return [
            'nama_kelas' => $this->input->post('nama_kelas', TRUE),
            'keterangan' => $this->input->post('keterangan', TRUE),
        ];
    }
}