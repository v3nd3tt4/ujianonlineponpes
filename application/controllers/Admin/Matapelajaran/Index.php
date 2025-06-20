<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Matapelajaran_model');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index() {
        $data = array(
            'page' => 'admin/master/matapelajaran/index',
            'script' => 'admin/master/matapelajaran/script',
            'matapelajaran' => $this->Matapelajaran_model->get_all(),
            'link' => 'Admin/Matapelajaran/Index'
        );
        $this->load->view('template_miminium/wrapper', $data);
    }

    public function create() {
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'page' => 'admin/master/matapelajaran/form',
                'script' => 'admin/master/matapelajaran/script',
                'link' => 'Admin/Matapelajaran/Index'
            );
            $this->load->view('template_miminium/wrapper', $data);
        } else {
            $data = $this->_get_posted_data();
            $this->Matapelajaran_model->insert($data);
            $this->session->set_flashdata('success', 'Data mata pelajaran berhasil ditambahkan!');
            redirect('Admin/Matapelajaran/Index');
        }
    }

    public function edit($id) {
        $matapelajaran = $this->Matapelajaran_model->get_by_id($id);
        if (!$matapelajaran) show_404();
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'page' => 'admin/master/matapelajaran/form',
                'script' => 'admin/master/matapelajaran/script',
                'matapelajaran' => $matapelajaran,
                'link' => 'Admin/Matapelajaran/Index'
            );
            $this->load->view('template_miminium/wrapper', $data);
        } else {
            $data = $this->_get_posted_data();
            $this->Matapelajaran_model->update($id, $data);
            $this->session->set_flashdata('success', 'Data mata pelajaran berhasil diupdate!');
            redirect('Admin/Matapelajaran/Index');
        }
    }

    public function delete($id) {
        $this->Matapelajaran_model->delete($id);
        $this->session->set_flashdata('success', 'Data mata pelajaran berhasil dihapus!');
        redirect('Admin/Matapelajaran/Index');
    }

    private function _rules() {
        $this->form_validation->set_rules('kode_matapelajaran', 'Kode Mata Pelajaran', 'required');
        $this->form_validation->set_rules('nama_matapelajaran', 'Nama Mata Pelajaran', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
    }

    private function _get_posted_data() {
        return [
            'kode_matapelajaran' => $this->input->post('kode_matapelajaran', TRUE),
            'nama_matapelajaran' => $this->input->post('nama_matapelajaran', TRUE),
            'keterangan' => $this->input->post('keterangan', TRUE),
        ];
    }
} 