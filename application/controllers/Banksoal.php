<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banksoal extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->library('form_validation');
		$this->load->library('session');
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
        // Ambil data mata pelajaran
        $this->db->from('tb_gurumatapelajaran');
        $this->db->join('tb_matapelajaran', 'tb_matapelajaran.id = tb_gurumatapelajaran.matapelajaran_id');
        if(!$this->session->userdata('rule') && $this->session->userdata('rule') == 'guru'){
        $this->db->where(['tb_gurumatapelajaran.pegawai_id' => $this->session->userdata('id_user')]);
        }
        $mapel = $this->db->get();

        // Ambil data bank soal dengan join mata pelajaran dan pegawai
        $this->db->select('tb_banksoal.*, tb_matapelajaran.kode_matapelajaran, tb_matapelajaran.nama_matapelajaran, tb_pegawai.nama as nama_pegawai');
        $this->db->from('tb_banksoal');
        $this->db->join('tb_matapelajaran', 'tb_matapelajaran.id = tb_banksoal.matapelajaran_id');
        $this->db->join('tb_pegawai', 'tb_pegawai.id = tb_banksoal.pegawai_id');
        $this->db->order_by('tb_banksoal.created_at', 'DESC');
        $banksoal = $this->db->get();

		$data = array(
			'page' => 'banksoal/index',
            'script' => 'banksoal/script',
            'link' => 'banksoal',
            'mapel' => $mapel,
            'banksoal' => $banksoal
		);
		$this->load->view('template_miminium/wrapper', $data);
	}

	public function create() {
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
		$this->form_validation->set_rules('matapelajaran_id', 'Mata Pelajaran', 'required|numeric');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Data tidak valid! ' . validation_errors());
			redirect('banksoal');
			return;
		}

		$data = array(
			'keterangan' => $this->input->post('keterangan', TRUE),
			'matapelajaran_id' => $this->input->post('matapelajaran_id', TRUE),
			'pegawai_id' => empty($this->session->userdata('id_user')) ? 2:$this->session->userdata('id_user')
		);

		if ($this->db->insert('tb_banksoal', $data)) {
			$this->session->set_flashdata('success', 'Bank soal berhasil ditambahkan!');
		} else {
			$this->session->set_flashdata('error', 'Gagal menambahkan bank soal!');
		}

		redirect('banksoal');
	}

	public function get_by_id($id) {
		$this->db->select('tb_banksoal.*, tb_matapelajaran.kode_matapelajaran, tb_matapelajaran.nama_matapelajaran');
		$this->db->from('tb_banksoal');
		$this->db->join('tb_matapelajaran', 'tb_matapelajaran.id = tb_banksoal.matapelajaran_id');
		$this->db->where('tb_banksoal.id', $id);
		$banksoal = $this->db->get()->row();
		
		if ($banksoal) {
			echo json_encode($banksoal);
		} else {
			echo json_encode(['error' => 'Data tidak ditemukan']);
		}
	}

	public function update() {
		$this->form_validation->set_rules('id', 'ID', 'required|numeric');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
		$this->form_validation->set_rules('matapelajaran_id', 'Mata Pelajaran', 'required|numeric');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Data tidak valid! ' . validation_errors());
			redirect('banksoal');
			return;
		}

		$id = $this->input->post('id', TRUE);
		$data = array(
			'keterangan' => $this->input->post('keterangan', TRUE),
			'matapelajaran_id' => $this->input->post('matapelajaran_id', TRUE)
		);

		$this->db->where('id', $id);
		if ($this->db->update('tb_banksoal', $data)) {
			$this->session->set_flashdata('success', 'Bank soal berhasil diupdate!');
		} else {
			$this->session->set_flashdata('error', 'Gagal mengupdate bank soal!');
		}

		redirect('banksoal');
	}

	public function delete($id) {
		$banksoal = $this->db->get_where('tb_banksoal', ['id' => $id])->row();
		if (!$banksoal) {
			$this->session->set_flashdata('error', 'Data bank soal tidak ditemukan!');
			redirect('banksoal');
			return;
		}

		$this->db->where('id', $id);
		if ($this->db->delete('tb_banksoal')) {
			$this->session->set_flashdata('success', 'Bank soal berhasil dihapus!');
		} else {
			$this->session->set_flashdata('error', 'Gagal menghapus bank soal!');
		}

		redirect('banksoal');
	}

	public function soalkuncijawaban($banksoal_id){
		$this->db->select('tb_banksoal.*, tb_matapelajaran.kode_matapelajaran, tb_matapelajaran.nama_matapelajaran, tb_pegawai.nama as nama_pegawai');
		$this->db->from('tb_banksoal');
		$this->db->join('tb_matapelajaran', 'tb_matapelajaran.id = tb_banksoal.matapelajaran_id');
		$this->db->join('tb_pegawai', 'tb_pegawai.id = tb_banksoal.pegawai_id');
		$this->db->where('tb_banksoal.id', $banksoal_id);
		$banksoal = $this->db->get()->row();
		
		if (!$banksoal) {
			show_404();
		}

		$soal = $this->db->get_where('tb_soal', ['banksoal_id' => $banksoal_id])->result();

		$data = array(
			'page' => 'banksoal/soalkuncijawaban',
			'script' => 'banksoal/soalkuncijawaban_script',
			'link' => 'banksoal',
			'banksoal' => $banksoal,
			'soal' => $soal
		);

		$this->load->view('template_miminium/wrapper', $data);
	}

	public function create_soal() {
		$this->form_validation->set_rules('banksoal_id', 'Bank Soal ID', 'required|numeric');
		$this->form_validation->set_rules('soal', 'Soal', 'required');
		$this->form_validation->set_rules('pilihan_a', 'Pilihan A', 'required');
		$this->form_validation->set_rules('pilihan_b', 'Pilihan B', 'required');
		$this->form_validation->set_rules('pilihan_c', 'Pilihan C', 'required');
		$this->form_validation->set_rules('pilihan_d', 'Pilihan D', 'required');
		$this->form_validation->set_rules('kunci_jawaban', 'Kunci Jawaban', 'required');

		$banksoal_id = $this->input->post('banksoal_id', TRUE);

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Data tidak valid! ' . validation_errors());
			redirect('banksoal/soalkuncijawaban/' . $banksoal_id);
			return;
		}

		$data = array(
			'banksoal_id' => $banksoal_id,
			'soal' => $this->input->post('soal', TRUE),
			'pilihan_a' => $this->input->post('pilihan_a', TRUE),
			'pilihan_b' => $this->input->post('pilihan_b', TRUE),
			'pilihan_c' => $this->input->post('pilihan_c', TRUE),
			'pilihan_d' => $this->input->post('pilihan_d', TRUE),
			'kunci_jawaban' => $this->input->post('kunci_jawaban', TRUE)
		);

		if ($this->db->insert('tb_soal', $data)) {
			$this->session->set_flashdata('success', 'Soal berhasil ditambahkan!');
		} else {
			$this->session->set_flashdata('error', 'Gagal menambahkan soal!');
		}

		redirect('banksoal/soalkuncijawaban/' . $banksoal_id);
	}

	public function get_soal_by_id($soal_id) {
		$soal = $this->db->get_where('tb_soal', ['id' => $soal_id])->row();
		if ($soal) {
			echo json_encode($soal);
		} else {
			echo json_encode(['error' => 'Data soal tidak ditemukan']);
		}
	}
	
	public function update_soal() {
		$this->form_validation->set_rules('id', 'Soal ID', 'required|numeric');
		$this->form_validation->set_rules('soal', 'Soal', 'required');
		$this->form_validation->set_rules('pilihan_a', 'Pilihan A', 'required');
		$this->form_validation->set_rules('pilihan_b', 'Pilihan B', 'required');
		$this->form_validation->set_rules('pilihan_c', 'Pilihan C', 'required');
		$this->form_validation->set_rules('pilihan_d', 'Pilihan D', 'required');
		$this->form_validation->set_rules('kunci_jawaban', 'Kunci Jawaban', 'required');
	
		$banksoal_id = $this->input->post('banksoal_id', TRUE);
	
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Data tidak valid! ' . validation_errors());
			redirect('banksoal/soalkuncijawaban/' . $banksoal_id);
			return;
		}
	
		$id = $this->input->post('id', TRUE);
		$data = array(
			'soal' => $this->input->post('soal', TRUE),
			'pilihan_a' => $this->input->post('pilihan_a', TRUE),
			'pilihan_b' => $this->input->post('pilihan_b', TRUE),
			'pilihan_c' => $this->input->post('pilihan_c', TRUE),
			'pilihan_d' => $this->input->post('pilihan_d', TRUE),
			'kunci_jawaban' => $this->input->post('kunci_jawaban', TRUE)
		);
	
		$this->db->where('id', $id);
		if ($this->db->update('tb_soal', $data)) {
			$this->session->set_flashdata('success', 'Soal berhasil diupdate!');
		} else {
			$this->session->set_flashdata('error', 'Gagal mengupdate soal!');
		}
	
		redirect('banksoal/soalkuncijawaban/' . $banksoal_id);
	}
	
	public function delete_soal($soal_id) {
		$soal = $this->db->get_where('tb_soal', ['id' => $soal_id])->row();
		if (!$soal) {
			$this->session->set_flashdata('error', 'Data soal tidak ditemukan!');
			redirect('banksoal'); // Fallback
			return;
		}
	
		$banksoal_id = $soal->banksoal_id;
		$this->db->where('id', $soal_id);
		if ($this->db->delete('tb_soal')) {
			$this->session->set_flashdata('success', 'Soal berhasil dihapus!');
		} else {
			$this->session->set_flashdata('error', 'Gagal menghapus soal!');
		}
	
		redirect('banksoal/soalkuncijawaban/' . $banksoal_id);
	}
}