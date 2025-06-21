<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas_model extends CI_Model {
    private $table = 'tb_kelas';

    public function get_all() {
        return $this->db->get($this->table)->result();
    }

    public function get_all_with_siswa_count() {
        $this->db->select('tb_kelas.*, COUNT(tb_kelassiswa.siswa_id) as jumlah_siswa');
        $this->db->from($this->table);
        $this->db->join('tb_kelassiswa', 'tb_kelassiswa.kelas_id = tb_kelas.id', 'left');
        $this->db->group_by('tb_kelas.id');
        return $this->db->get()->result();
    }

    public function get_by_id($id) {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function insert($data) {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }
}