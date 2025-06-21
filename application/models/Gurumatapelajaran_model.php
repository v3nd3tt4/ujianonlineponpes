<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gurumatapelajaran_model extends CI_Model {
    private $table = 'tb_gurumatapelajaran';

    public function get_all() {
        $this->db->select('tb_gurumatapelajaran.*, tb_pegawai.nama as nama_pegawai, tb_matapelajaran.nama_matapelajaran');
        $this->db->from($this->table);
        $this->db->join('tb_pegawai', 'tb_pegawai.id = tb_gurumatapelajaran.pegawai_id');
        $this->db->join('tb_matapelajaran', 'tb_matapelajaran.id = tb_gurumatapelajaran.matapelajaran_id');
        return $this->db->get()->result();
    }

    public function get_by_id($id) {
        $this->db->select('tb_gurumatapelajaran.*, tb_pegawai.nama as nama_pegawai, tb_matapelajaran.nama_matapelajaran');
        $this->db->from($this->table);
        $this->db->join('tb_pegawai', 'tb_pegawai.id = tb_gurumatapelajaran.pegawai_id');
        $this->db->join('tb_matapelajaran', 'tb_matapelajaran.id = tb_gurumatapelajaran.matapelajaran_id');
        $this->db->where('tb_gurumatapelajaran.id', $id);
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

    public function cek_duplikat($pegawai_id, $matapelajaran_id, $id = null) {
        $this->db->where('pegawai_id', $pegawai_id);
        $this->db->where('matapelajaran_id', $matapelajaran_id);
        if ($id) {
            $this->db->where('id !=', $id);
        }
        return $this->db->get($this->table)->num_rows() > 0;
    }
} 