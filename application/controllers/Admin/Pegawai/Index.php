<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Pegawai_model');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index() {
        $data = array(
			'page' => 'admin/master/pegawai/index',
            'script' => 'admin/master/pegawai/script',
            'pegawai' => $this->Pegawai_model->get_all(),
            'link' => 'Admin/Pegawai/Index'
		);
		$this->load->view('template_miminium/wrapper', $data);
    }

    public function create() {
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'page' => 'admin/master/pegawai/form',
                'script' => 'admin/master/pegawai/script',
                'link' => 'Admin/Pegawai/Index'
            );
            $this->load->view('template_miminium/wrapper', $data);
        } else {
            $data = $this->_get_posted_data();
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            $this->Pegawai_model->insert($data);
            $this->session->set_flashdata('success', 'Data pegawai berhasil ditambahkan!');
            redirect('Admin/Pegawai/Index');
        }
    }

    public function edit($id) {
        $pegawai = $this->Pegawai_model->get_by_id($id);
        if (!$pegawai) show_404();
        $this->_rules($id);
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'page' => 'admin/master/pegawai/form',
                'script' => 'admin/master/pegawai/script',
                'link' => 'Admin/Pegawai/Index',
                'pegawai' => $pegawai
            );
            $this->load->view('template_miminium/wrapper', $data);
        } else {
            $data = $this->_get_posted_data();
            if (!empty($data['password'])) {
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            } else {
                unset($data['password']);
            }
            $this->Pegawai_model->update($id, $data);
            $this->session->set_flashdata('success', 'Data pegawai berhasil diupdate!');
            redirect('Admin/Pegawai/Index');
        }
    }

    public function delete($id) {
        $this->Pegawai_model->delete($id);
        $this->session->set_flashdata('success', 'Data pegawai berhasil dihapus!');
        redirect('Admin/Pegawai/Index');
    }

    private function _rules($id = null) {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $email_rule = 'required|valid_email';
        if (!$id) {
            $email_rule .= '|is_unique[tb_pegawai.email]';
        } else {
            $email_rule .= '|callback_email_unique['.$id.']';
        }
        $this->form_validation->set_rules('email', 'Email', $email_rule);
        $this->form_validation->set_rules('role', 'Role', 'required');
        if (!$id) {
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        }
    }

    private function _get_posted_data() {
        return [
            'nama' => $this->input->post('nama', TRUE),
            'tempat_lahir' => $this->input->post('tempat_lahir', TRUE),
            'tanggal_lahir' => $this->input->post('tanggal_lahir', TRUE),
            'jenis_kelamin' => $this->input->post('jenis_kelamin', TRUE),
            'alamat' => $this->input->post('alamat', TRUE),
            'no_telepon' => $this->input->post('no_telepon', TRUE),
            'email' => $this->input->post('email', TRUE),
            'password' => $this->input->post('password', TRUE),
            'role' => $this->input->post('role', TRUE),
        ];
    }

    public function email_unique($email, $id) {
        $this->db->where('email', $email);
        $this->db->where('id !=', $id);
        $query = $this->db->get('tb_pegawai');
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('email_unique', 'Email sudah digunakan oleh pegawai lain.');
            return FALSE;
        }
        return TRUE;
    }
}
