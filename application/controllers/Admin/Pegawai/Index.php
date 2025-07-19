<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Index extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Pegawai_model');
		$this->load->library('form_validation');
		$this->load->library('session');

		$roles = $this->session->userdata('rule');
		$allow = ['admin', 'pegawai', 'kepala sekolah', 'operator'];
		if (!in_array($roles, $allow)) {
			echo '<script>alert("Maaf, anda tidak diizinkan mengakses halaman ini")</script>';
			echo '<script>window.location.href="' . base_url() . '";</script>';
		}
	}

	public function index($role = null)
	{
		$allowed_roles = ['admin', 'pegawai', 'kepala sekolah', 'operator'];
		$filter_role = null;
		if ($role) {
			$role = str_replace('-', ' ', urldecode($role));
			if (in_array($role, $allowed_roles)) {
				$filter_role = $role;
			}
		}
		$data = array(
			'page' => 'admin/master/pegawai/index',
			'script' => 'admin/master/pegawai/script',
			'pegawai' => $this->Pegawai_model->get_by_role($filter_role),
			'link' => $filter_role ? 'Admin/Pegawai/Index/' . str_replace(' ', '-', $filter_role) : 'Admin/Pegawai/Index',
			'filter_role' => $filter_role
		);
		$this->load->view('template_stisla/wrapper', $data);
	}

	public function create()
	{
		$this->_rules();
		if ($this->form_validation->run() == FALSE) {
			$data = array(
				'page' => 'admin/master/pegawai/form',
				'script' => 'admin/master/pegawai/script',
				'link' => 'Admin/Pegawai/Index'
			);
			$this->load->view('template_stisla/wrapper', $data);
		} else {
			$data = $this->_get_posted_data();
			$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
			$this->Pegawai_model->insert($data);
			$this->session->set_flashdata('success', 'Data pegawai berhasil ditambahkan!');
			redirect('Admin/Pegawai/Index');
		}
	}

	public function edit($id)
	{
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
			$this->load->view('template_stisla/wrapper', $data);
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

	public function delete($id)
	{
		$this->Pegawai_model->delete($id);
		$this->session->set_flashdata('success', 'Data pegawai berhasil dihapus!');
		redirect('Admin/Pegawai/Index');
	}

	private function _rules($id = null)
	{
		$this->form_validation->set_rules('nik', 'NIK', 'required|is_unique[tb_pegawai.nik]' . ($id ? '|callback_nik_unique['.$id.']' : ''));
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required');
		$this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$email_rule = 'required|valid_email';
		if (!$id) {
			$email_rule .= '|is_unique[tb_pegawai.email]';
		} else {
			$email_rule .= '|callback_email_unique[' . $id . ']';
		}
		$this->form_validation->set_rules('email', 'Email', $email_rule);
		$this->form_validation->set_rules('role', 'Role', 'required');
		if (!$id) {
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
		}
	}

	public function nik_unique($nik, $id)
	{
		$this->db->where('nik', $nik);
		$this->db->where('id !=', $id);
		$query = $this->db->get('tb_pegawai');
		if ($query->num_rows() > 0) {
			$this->form_validation->set_message('nik_unique', 'NIK sudah digunakan oleh pegawai lain.');
			return FALSE;
		}
		return TRUE;
	}

	private function _get_posted_data()
	{
		return [
			'nik' => $this->input->post('nik', TRUE),
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

	public function email_unique($email, $id)
	{
		$this->db->where('email', $email);
		$this->db->where('id !=', $id);
		$query = $this->db->get('tb_pegawai');
		if ($query->num_rows() > 0) {
			$this->form_validation->set_message('email_unique', 'Email sudah digunakan oleh pegawai lain.');
			return FALSE;
		}
		return TRUE;
	}

	public function cetak_pdf($role = null)
	{
		// Ambil data pegawai
		$allowed_roles = ['admin', 'pegawai', 'kepala sekolah', 'operator'];
		$filter_role = null;
		if ($role) {
			$role = str_replace('-', ' ', urldecode($role));
			if (in_array($role, $allowed_roles)) {
				$filter_role = $role;
			}
		}
		$pegawai = $this->Pegawai_model->get_by_role($filter_role);

		$data['judul'] = 'Laporan Data SDM' . ($filter_role ? ' - ' . (strtolower($filter_role) == 'operator' ? 'Pengawas' : ucfirst($filter_role)) : '');
		$data['deskripsi'] = 'Laporan ini berisi data SDM yang terdaftar di sistem.';
		$data['waktu_cetak'] = date('d-m-Y H:i');
		$data['total_data'] = count($pegawai);
		$data['header'] = [
			'No',
			'Nama',
			'Tempat Lahir',
			'Tanggal Lahir',
			'Jenis Kelamin',
			'Email',
			'Role',
			'No Telepon',
			'Alamat'
		];
		$data['data'] = array_map(function ($row, $i) {
			return [
				$i + 1,
				$row->nama,
				$row->tempat_lahir,
				date('d-m-Y', strtotime($row->tanggal_lahir)),
				$row->jenis_kelamin,
				$row->email,
				$row->role == 'operator' ? 'Pengawas' : $row->role,
				$row->no_telepon,
				$row->alamat
			];
		}, $pegawai, array_keys($pegawai));

		// Render HTML
		$html = $this->load->view('admin/master/pegawai/laporan_pegawai', $data, true);

		// Pastikan mPDF sudah diinstall via composer
		require_once FCPATH . 'vendor/autoload.php';
		$mpdf = new \Mpdf\Mpdf([
			'format' => 'A4-L', // A4 Landscape
			'margin_left' => 10,
			'margin_right' => 10,
			'margin_top' => 10,
			'margin_bottom' => 10,
		]);
		$mpdf->WriteHTML($html);
		$mpdf->SetDisplayMode('fullpage');
		$filename = 'laporan_pegawai_' . date('Ymd_His') . '.pdf';
		$mpdf->Output($filename, 'I'); // Inline view dengan nama file datetime
	}
}
