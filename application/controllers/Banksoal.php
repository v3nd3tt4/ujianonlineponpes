<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'third_party/SimpleXLSX/SimpleXLSX.php';

use Shuchkin\SimpleXLSX;

class Banksoal extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('form_validation');
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
		// Ambil data mata pelajaran
		$this->db->from('tb_gurumatapelajaran');
		$this->db->join('tb_matapelajaran', 'tb_matapelajaran.id = tb_gurumatapelajaran.matapelajaran_id');
		if (!$this->session->userdata('rule') && $this->session->userdata('rule') == 'guru') {
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
		$this->load->view('template_stisla/wrapper', $data);
	}

	public function create()
	{
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
			'pegawai_id' => empty($this->session->userdata('id_user')) ? 2 : $this->session->userdata('id_user')
		);

		if ($this->db->insert('tb_banksoal', $data)) {
			$this->session->set_flashdata('success', 'Bank soal berhasil ditambahkan!');
		} else {
			$this->session->set_flashdata('error', 'Gagal menambahkan bank soal!');
		}

		redirect('banksoal');
	}

	public function get_by_id($id)
	{
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

	public function update()
	{
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

	public function delete($id)
	{
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

	public function soalkuncijawaban($banksoal_id)
	{
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

		$this->load->view('template_stisla/wrapper', $data);
	}

	public function create_soal()
	{
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

		// Handle image upload
		$gambar_soal = null;
		if (!empty($_FILES['gambar_soal']['name'])) {
			$config['upload_path'] = './assets/uploads/soal/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size'] = 2048; // 2MB
			$config['encrypt_name'] = TRUE;

			// Create directory if not exists
			if (!is_dir($config['upload_path'])) {
				mkdir($config['upload_path'], 0777, true);
			}

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('gambar_soal')) {
				$upload_data = $this->upload->data();
				$gambar_soal = $upload_data['file_name'];
			} else {
				$this->session->set_flashdata('error', 'Gagal upload gambar: ' . $this->upload->display_errors());
				redirect('banksoal/soalkuncijawaban/' . $banksoal_id);
				return;
			}
		}

		$data = array(
			'banksoal_id' => $banksoal_id,
			'soal' => $this->input->post('soal', TRUE),
			'gambar_soal' => $gambar_soal,
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

	public function get_soal_by_id($soal_id)
	{
		$soal = $this->db->get_where('tb_soal', ['id' => $soal_id])->row();
		if ($soal) {
			echo json_encode($soal);
		} else {
			echo json_encode(['error' => 'Data soal tidak ditemukan']);
		}
	}

	public function update_soal()
	{
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
		
		// Get current soal data
		$current_soal = $this->db->get_where('tb_soal', ['id' => $id])->row();
		
		// Handle image upload
		$gambar_soal = $current_soal->gambar_soal; // Keep existing image by default
		if (!empty($_FILES['gambar_soal']['name'])) {
			$config['upload_path'] = './assets/uploads/soal/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size'] = 2048; // 2MB
			$config['encrypt_name'] = TRUE;

			// Create directory if not exists
			if (!is_dir($config['upload_path'])) {
				mkdir($config['upload_path'], 0777, true);
			}

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('gambar_soal')) {
				$upload_data = $this->upload->data();
				$gambar_soal = $upload_data['file_name'];
				
				// Delete old image if exists
				if ($current_soal->gambar_soal && file_exists('./assets/uploads/soal/' . $current_soal->gambar_soal)) {
					unlink('./assets/uploads/soal/' . $current_soal->gambar_soal);
				}
			} else {
				$this->session->set_flashdata('error', 'Gagal upload gambar: ' . $this->upload->display_errors());
				redirect('banksoal/soalkuncijawaban/' . $banksoal_id);
				return;
			}
		}

		$data = array(
			'soal' => $this->input->post('soal', TRUE),
			'gambar_soal' => $gambar_soal,
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

	public function delete_soal($soal_id)
	{
		$soal = $this->db->get_where('tb_soal', ['id' => $soal_id])->row();
		if (!$soal) {
			$this->session->set_flashdata('error', 'Data soal tidak ditemukan!');
			redirect('banksoal'); // Fallback
			return;
		}

		$banksoal_id = $soal->banksoal_id;
		
		// Delete image file if exists
		if ($soal->gambar_soal && file_exists('./assets/uploads/soal/' . $soal->gambar_soal)) {
			unlink('./assets/uploads/soal/' . $soal->gambar_soal);
		}
		
		$this->db->where('id', $soal_id);
		if ($this->db->delete('tb_soal')) {
			$this->session->set_flashdata('success', 'Soal berhasil dihapus!');
		} else {
			$this->session->set_flashdata('error', 'Gagal menghapus soal!');
		}

		redirect('banksoal/soalkuncijawaban/' . $banksoal_id);
	}

	public function preview_excel()
	{
		if (isset($_FILES["file_excel"]["name"])) {
			$path = $_FILES["file_excel"]["tmp_name"];

			if ($xlsx = SimpleXLSX::parse($path)) {
				$rows = $xlsx->rows();
				// Hapus header
				$header = array_shift($rows);

				// table responsive
				$html = '<div class="table-responsive">';
				$html .= '<table id="previewTable" class="table table-striped table-bordered table-hover">';
				$html .= '<thead><tr>';
				$html .= '<th>No</th>'; // Tambahkan kolom nomor urut
				foreach ($header as $h) {
					$html .= '<th>' . htmlspecialchars($h) . '</th>';
				}
				$html .= '</tr></thead>';
				$html .= '<tbody>';

				$i = 0;
				foreach ($rows as $row) {
					$html .= '<tr>';
					$html .= '<td><input type="hidden" name="soal[' . $i . '][soal]" value="' . htmlspecialchars($row[0]) . '">' . htmlspecialchars($row[0]) . '</td>';
					$html .= '<td><input type="hidden" name="soal[' . $i . '][pilihan_a]" value="' . htmlspecialchars($row[1]) . '">' . htmlspecialchars($row[1]) . '</td>';
					$html .= '<td><input type="hidden" name="soal[' . $i . '][pilihan_b]" value="' . htmlspecialchars($row[2]) . '">' . htmlspecialchars($row[2]) . '</td>';
					$html .= '<td><input type="hidden" name="soal[' . $i . '][pilihan_c]" value="' . htmlspecialchars($row[3]) . '">' . htmlspecialchars($row[3]) . '</td>';
					$html .= '<td><input type="hidden" name="soal[' . $i . '][pilihan_d]" value="' . htmlspecialchars($row[4]) . '">' . htmlspecialchars($row[4]) . '</td>';
					$html .= '<td><input type="hidden" name="soal[' . $i . '][kunci_jawaban]" value="' . htmlspecialchars($row[5]) . '">' . htmlspecialchars($row[5]) . '</td>';
					$html .= '</tr>';
					$i++;
				}

				$html .= '</tbody></table></div>';
				echo $html;
			} else {
				echo '<div class="alert alert-danger">Gagal mem-parsing file Excel. Pastikan format file benar.</div>';
			}
		} else {
			echo '<div class="alert alert-danger">File tidak ditemukan.</div>';
		}
	}

	public function import_soal()
	{
		$soal_data = $this->input->post('soal');
		$banksoal_id = $this->input->post('banksoal_id');

		if (!empty($soal_data)) {
			$data_to_insert = [];
			foreach ($soal_data as $s) {
				$data_to_insert[] = [
					'banksoal_id' => $banksoal_id,
					'soal' => $s['soal'],
					'gambar_soal' => null, // Import Excel tidak mendukung gambar
					'pilihan_a' => $s['pilihan_a'],
					'pilihan_b' => $s['pilihan_b'],
					'pilihan_c' => $s['pilihan_c'],
					'pilihan_d' => $s['pilihan_d'],
					'kunci_jawaban' => $s['kunci_jawaban'],
				];
			}

			$this->db->insert_batch('tb_soal', $data_to_insert);
			$this->session->set_flashdata('success', count($data_to_insert) . ' soal berhasil diimport!');
		} else {
			$this->session->set_flashdata('error', 'Tidak ada data untuk diimport.');
		}

		redirect('banksoal/soalkuncijawaban/' . $banksoal_id);
	}
}
