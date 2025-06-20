<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Siswa_model');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index() {
        $data = array(
            'page' => 'admin/master/siswa/index',
            'script' => 'admin/master/siswa/script',
            'siswa' => $this->Siswa_model->get_all(),
            'link' => 'Admin/Siswa/Index'
        );
        $this->load->view('template_miminium/wrapper', $data);
    }

    public function create() {
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'page' => 'admin/master/siswa/form',
                'script' => 'admin/master/siswa/script',
                'link' => 'Admin/Siswa/Index'
            );
            $this->load->view('template_miminium/wrapper', $data);
        } else {
            $data = $this->_get_posted_data();
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            $this->Siswa_model->insert($data);
            $this->session->set_flashdata('success', 'Data siswa berhasil ditambahkan!');
            redirect('Admin/Siswa/Index');
        }
    }

    public function edit($id) {
        $siswa = $this->Siswa_model->get_by_id($id);
        if (!$siswa) show_404();
        $this->_rules($id);
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'page' => 'admin/master/siswa/form',
                'script' => 'admin/master/siswa/script',
                'siswa' => $siswa,
                'link' => 'Admin/Siswa/Index'
            );
            $this->load->view('template_miminium/wrapper', $data);
        } else {
            $data = $this->_get_posted_data();
            if (!empty($data['password'])) {
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            } else {
                unset($data['password']);
            }
            $this->Siswa_model->update($id, $data);
            $this->session->set_flashdata('success', 'Data siswa berhasil diupdate!');
            redirect('Admin/Siswa/Index');
        }
    }

    public function delete($id) {
        $this->Siswa_model->delete($id);
        $this->session->set_flashdata('success', 'Data siswa berhasil dihapus!');
        redirect('Admin/Siswa/Index');
    }

    private function _rules($id = null) {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('nis', 'NIS', 'required|is_unique[tb_siswa.nis' . ($id ? '.id.' . $id : '') . ']');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        if (!$id) {
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        }
        $this->form_validation->set_rules('no_hp', 'No HP', 'required');
        $this->form_validation->set_rules('nama_ibu', 'Nama Ibu', 'required');
        $this->form_validation->set_rules('nama_ayah', 'Nama Ayah', 'required');
        $this->form_validation->set_rules('pekerjaan_ibu', 'Pekerjaan Ibu', 'required');
        $this->form_validation->set_rules('pekerjaan_ayah', 'Pekerjaan Ayah', 'required');
    }

    private function _get_posted_data() {
        return [
            'nama' => $this->input->post('nama', TRUE),
            'nis' => $this->input->post('nis', TRUE),
            'tempat_lahir' => $this->input->post('tempat_lahir', TRUE),
            'tanggal_lahir' => $this->input->post('tanggal_lahir', TRUE),
            'jenis_kelamin' => $this->input->post('jenis_kelamin', TRUE),
            'alamat' => $this->input->post('alamat', TRUE),
            'email' => $this->input->post('email', TRUE),
            'password' => $this->input->post('password', TRUE),
            'no_hp' => $this->input->post('no_hp', TRUE),
            'nama_ibu' => $this->input->post('nama_ibu', TRUE),
            'nama_ayah' => $this->input->post('nama_ayah', TRUE),
            'pekerjaan_ibu' => $this->input->post('pekerjaan_ibu', TRUE),
            'pekerjaan_ayah' => $this->input->post('pekerjaan_ayah', TRUE),
        ];
    }
} 