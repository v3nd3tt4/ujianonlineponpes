<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Kelassiswa_model');
        $this->load->model('Siswa_model');
        $this->load->model('Kelas_model');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index() {
        $data = array(
            'page' => 'admin/master/kelassiswa/index',
            'script' => 'admin/master/kelassiswa/script',
            'kelas' => $this->Kelassiswa_model->get_all_with_siswa_count(),
            'link' => 'Admin/Kelassiswa/Index'
        );
        $this->load->view('template_miminium/wrapper', $data);
    }

    public function siswa($kelas_id) {
        $kelas = $this->Kelas_model->get_by_id($kelas_id);
        if (!$kelas) show_404();
        
        $data = array(
            'page' => 'admin/master/kelassiswa/siswa',
            'script' => 'admin/master/kelassiswa/script',
            'kelas' => $kelas,
            'siswa_kelas' => $this->Kelassiswa_model->get_siswa_by_kelas($kelas_id),
            'link' => 'Admin/Kelassiswa/Index'
        );
        $this->load->view('template_miminium/wrapper', $data);
    }

    public function create($kelas_id) {
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'page' => 'admin/master/kelassiswa/form',
                'script' => 'admin/master/kelassiswa/script',
                'siswa' => $this->Siswa_model->get_all(),
                'kelas' => $this->Kelas_model->get_by_id($kelas_id),
                'link' => 'Admin/Kelassiswa/Index'
            );
            $this->load->view('template_miminium/wrapper', $data);
        } else {
            $siswa_id = $this->input->post('siswa_id', TRUE);
            
            // Cek apakah siswa sudah ada di kelas ini
            if ($this->Kelassiswa_model->cek_siswa_di_kelas($siswa_id, $kelas_id)) {
                $this->session->set_flashdata('error', 'Siswa ini sudah ada di kelas tersebut!');
                redirect('Admin/Kelassiswa/Index/siswa/' . $kelas_id);
                return;
            }
            $data = $this->_get_posted_data();
            $this->Kelassiswa_model->insert($data);
            $this->session->set_flashdata('success', 'Data kelas siswa berhasil ditambahkan!');
            redirect('Admin/Kelassiswa/Index/siswa'.$kelas_id);
        }
    }

    public function edit($id) {
        $kelassiswa = $this->Kelassiswa_model->get_by_id($id);
        if (!$kelassiswa) show_404();
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'page' => 'admin/master/kelassiswa/form',
                'script' => 'admin/master/kelassiswa/script',
                'kelassiswa' => $kelassiswa,
                'siswa' => $this->Siswa_model->get_all(),
                'kelas' => $this->Kelas_model->get_all(),
                'link' => 'Admin/Kelassiswa/Index'
            );
            $this->load->view('template_miminium/wrapper', $data);
        } else {
            $data = $this->_get_posted_data();
            $this->Kelassiswa_model->update($id, $data);
            $this->session->set_flashdata('success', 'Data kelas siswa berhasil diupdate!');
            redirect('Admin/Kelassiswa/Index');
        }
    }

    public function delete($id) {
        $this->Kelassiswa_model->delete($id);
        $this->session->set_flashdata('success', 'Data kelas siswa berhasil dihapus!');
        redirect('Admin/Kelassiswa/Index');
    }

    private function _rules() {
        $this->form_validation->set_rules('siswa_id', 'Siswa', 'required');
        $this->form_validation->set_rules('kelas_id', 'Kelas', 'required');
    }

    private function _get_posted_data() {
        return [
            'siswa_id' => $this->input->post('siswa_id', TRUE),
            'kelas_id' => $this->input->post('kelas_id', TRUE),
        ];
    }
} 