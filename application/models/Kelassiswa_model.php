<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelassiswa_model extends CI_Model {
    public $table = 'tb_kelassiswa';
    public $id = 'id';
    public $order = 'DESC';

    function __construct() {
        parent::__construct();
    }

    // get all
    function get_all() {
        $this->db->select('tb_kelassiswa.*, tb_siswa.nama, tb_siswa.nis, tb_kelas.nama_kelas');
        $this->db->from($this->table);
        $this->db->join('tb_siswa', 'tb_siswa.id = tb_kelassiswa.siswa_id');
        $this->db->join('tb_kelas', 'tb_kelas.id = tb_kelassiswa.kelas_id');
        $this->db->order_by($this->id, $this->order);
        return $this->db->get()->result();
    }

    // get data by id
    function get_by_id($id) {
        $this->db->select('tb_kelassiswa.*, tb_siswa.nama, tb_siswa.nis, tb_kelas.nama_kelas');
        $this->db->from($this->table);
        $this->db->join('tb_siswa', 'tb_siswa.id = tb_kelassiswa.siswa_id');
        $this->db->join('tb_kelas', 'tb_kelas.id = tb_kelassiswa.kelas_id');
        $this->db->where($this->id, $id);
        return $this->db->get()->row();
    }

    // get siswa by kelas
    function get_siswa_by_kelas($kelas_id) {
        $this->db->select('tb_kelassiswa.id, tb_siswa.nama, tb_siswa.nis, tb_siswa.email, tb_siswa.no_hp');
        $this->db->from($this->table);
        $this->db->join('tb_siswa', 'tb_siswa.id = tb_kelassiswa.siswa_id');
        $this->db->where('tb_kelassiswa.kelas_id', $kelas_id);
        $this->db->order_by('tb_siswa.nama', 'ASC');
        return $this->db->get()->result();
    }

    // cek apakah siswa sudah ada di kelas
    function cek_siswa_di_kelas($siswa_id, $kelas_id) {
        $this->db->where('siswa_id', $siswa_id);
        $this->db->where('kelas_id', $kelas_id);
        $result = $this->db->get($this->table);
        return $result->num_rows() > 0;
    }

    // cek apakah siswa sudah ada di kelas (untuk edit, exclude current record)
    function cek_siswa_di_kelas_edit($siswa_id, $kelas_id, $exclude_id = null) {
        $this->db->where('siswa_id', $siswa_id);
        $this->db->where('kelas_id', $kelas_id);
        if ($exclude_id) {
            $this->db->where('id !=', $exclude_id);
        }
        $result = $this->db->get($this->table);
        return $result->num_rows() > 0;
    }

    // insert data
    function insert($data) {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data) {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id) {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    public function get_all_with_siswa_count() {
        $this->db->select('tb_kelas.*, COUNT(tb_kelassiswa.siswa_id) as jumlah_siswa');
        $this->db->from('tb_kelas');
        $this->db->join('tb_kelassiswa', 'tb_kelassiswa.kelas_id = tb_kelas.id', 'left');
        $this->db->group_by('tb_kelas.id');
        return $this->db->get()->result();
    }
} 