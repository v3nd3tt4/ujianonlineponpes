<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelasrombel_model extends CI_Model {
    private $table = 'tb_kelasrombel';

    public function get_all() {
        return $this->db->get($this->table)->result();
    }

    public function get_all_with_relations() {
        $this->db->select('tb_kelasrombel.*, COUNT(tb_kelassiswa.siswa_id) as jumlah_siswa, tb_kelas.nama_kelas, tb_tahunakademik.tahun, tb_pegawai.nama');
        $this->db->from($this->table);
        $this->db->join('tb_kelassiswa', 'tb_kelassiswa.kelasrombel_id = tb_kelasrombel.id', 'left');
        $this->db->join('tb_kelas', 'tb_kelas.id = tb_kelasrombel.kelas_id', 'left');
        $this->db->join('tb_tahunakademik', 'tb_tahunakademik.id = tb_kelasrombel.tahunakademik_id', 'left');
        $this->db->join('tb_pegawai', 'tb_pegawai.id = tb_kelasrombel.walikelas_id', 'left');
        $this->db->group_by('tb_kelasrombel.id'); // penting
        return $this->db->get()->result();
    }
    

    // get siswa by kelas
    function get_siswa_by_kelas($kelas_id) {
        $this->db->select('tb_kelasrombel.id, tb_siswa.nama, tb_siswa.nis, tb_siswa.email, tb_siswa.no_hp');
        $this->db->from($this->table);
        $this->db->join('tb_kelassiswa', 'tb_kelassiswa.kelasrombel_id = tb_kelasrombel.id');
        $this->db->join('tb_siswa', 'tb_siswa.id = tb_kelassiswa.siswa_id');
        $this->db->where('tb_kelasrombel.id', $kelas_id);
        $this->db->order_by('tb_siswa.nama', 'ASC');
        return $this->db->get()->result();
    }

    public function get_by_id($id) {
        $this->db->from($this->table);
        $this->db->join('tb_pegawai', 'tb_pegawai.id = tb_kelasrombel.walikelas_id', 'left');
        $this->db->join('tb_kelas', 'tb_kelas.id = tb_kelasrombel.kelas_id');
        $this->db->join('tb_tahunakademik', 'tb_tahunakademik.id = tb_kelasrombel.tahunakademik_id', 'left');
        $this->db->where(['tb_kelasrombel.id' => $id]);
        return $this->db->get()->row();
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