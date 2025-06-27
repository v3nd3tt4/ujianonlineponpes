<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa_model extends CI_Model
{
	private $table = 'tb_siswa';

	public function get_all()
	{
		return $this->db->get($this->table)->result();
	}

	public function get_by_id($id)
	{
		return $this->db->get_where($this->table, ['id' => $id])->row();
	}

	public function insert($data)
	{
		return $this->db->insert($this->table, $data);
	}

	public function update($id, $data)
	{
		$this->db->where('id', $id);
		return $this->db->update($this->table, $data);
	}

	public function delete($id)
	{
		// Validate $id
		if (empty($id) || !is_numeric($id)) {
			return false;
		}

		// Cek relasi di tb_kelassiswa
		$this->db->where('siswa_id', $id);
		$related = $this->db->get('tb_kelassiswa')->num_rows();
		if ($related > 0) {
			// Jika ada relasi, batalkan penghapusan
			return false;
		}

		// Hapus dari tb_siswa
		$this->db->where('id', $id);
		return $this->db->delete($this->table);
	}
}
