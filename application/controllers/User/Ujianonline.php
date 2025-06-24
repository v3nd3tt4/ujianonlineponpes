<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ujianonline extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->helper(array('url', 'form'));
        if ($this->session->userdata('rule') != 'siswa') {
            redirect('auth');
        }
    }

    public function index() {
        $siswa_id = $this->session->userdata('id_user');
        $this->db->select('tb_jadwal_ujian.*, tb_matapelajaran.nama_matapelajaran, tb_kelasrombel.id as kelasrombel_id, tb_kelas.nama_kelas, tb_presensi_ujian.waktu_hadir, j.status as status_ujian, j.nilai_akhir, j.jawaban');
        $this->db->from('tb_presensi_ujian');
        $this->db->join('tb_jadwal_ujian', 'tb_jadwal_ujian.id = tb_presensi_ujian.jadwal_ujian_id');
        $this->db->join('tb_matapelajaran', 'tb_matapelajaran.id = tb_jadwal_ujian.matapelajaran_id');
        $this->db->join('tb_kelasrombel', 'tb_kelasrombel.id = tb_jadwal_ujian.kelasrombel_id');
        $this->db->join('tb_kelas', 'tb_kelas.id = tb_kelasrombel.kelas_id');
        $this->db->join('tb_jawaban_ujian j', 'j.jadwal_ujian_id = tb_jadwal_ujian.id AND j.siswa_id = '.$siswa_id, 'left');
        $this->db->where('tb_presensi_ujian.siswa_id', $siswa_id);
        $this->db->order_by('tb_jadwal_ujian.tanggal_ujian', 'DESC');
        $jadwal = $this->db->get()->result();
        $data = array(
            'jadwal' => $jadwal,
            'page' => 'siswa/ujianonline/index',
            'script' => 'siswa/ujianonline/script',
            'link' => 'siswa/ujianonline'
        );
        $this->load->view('template_miminium/wrapper', $data);
    }

    public function mulai($jadwal_ujian_id) {
        $siswa_id = $this->session->userdata('id_user');
        // Cek apakah sudah ada record jawaban_ujian
        $cek = $this->db->get_where('tb_jawaban_ujian', [
            'jadwal_ujian_id' => $jadwal_ujian_id,
            'siswa_id' => $siswa_id
        ])->row();
        if (!$cek) {
            // Insert baru
            $this->db->insert('tb_jawaban_ujian', [
                'jadwal_ujian_id' => $jadwal_ujian_id,
                'siswa_id' => $siswa_id,
                'waktu_mulai' => date('Y-m-d H:i:s'),
                'status' => 'sedang'
            ]);
        } else if ($cek->status == 'belum') {
            // Update ke sedang
            $this->db->where('id', $cek->id);
            $this->db->update('tb_jawaban_ujian', [
                'waktu_mulai' => date('Y-m-d H:i:s'),
                'status' => 'sedang'
            ]);
        }
        redirect('user/ujianonline/kerjakan/'.$jadwal_ujian_id);
    }

    public function kerjakan($jadwal_ujian_id) {
        $siswa_id = $this->session->userdata('id_user');
        // Ambil detail jadwal ujian dengan join ke matapelajaran dan kelas
        $this->db->select('tb_jadwal_ujian.*, tb_matapelajaran.nama_matapelajaran, tb_kelasrombel.id as kelasrombel_id, tb_kelas.nama_kelas');
        $this->db->from('tb_jadwal_ujian');
        $this->db->join('tb_matapelajaran', 'tb_matapelajaran.id = tb_jadwal_ujian.matapelajaran_id');
        $this->db->join('tb_kelasrombel', 'tb_kelasrombel.id = tb_jadwal_ujian.kelasrombel_id');
        $this->db->join('tb_kelas', 'tb_kelas.id = tb_kelasrombel.kelas_id');
        $this->db->where('tb_jadwal_ujian.id', $jadwal_ujian_id);
        $jadwal = $this->db->get()->row();
        $soal = [];
        if ($jadwal && $jadwal->banksoal_id) {
            $soal = $this->db->get_where('tb_soal', ['banksoal_id' => $jadwal->banksoal_id])->result();
        }
        // Ambil data jawaban_ujian
        $jawaban_ujian = $this->db->get_where('tb_jawaban_ujian', [
            'jadwal_ujian_id' => $jadwal_ujian_id,
            'siswa_id' => $siswa_id
        ])->row();
        $data = [
            'jadwal' => $jadwal,
            'soal' => $soal,
            'jawaban_ujian' => $jawaban_ujian,
            'page' => 'siswa/ujianonline/kerjakan',
            'link' => 'siswa/ujianonline'
        ];
        $this->load->view('template_miminium/wrapper', $data);
    }

    public function submit_jawaban($jadwal_ujian_id) {
        $siswa_id = $this->session->userdata('id_user');
        $jawaban = $this->input->post('jawaban'); // array: soal_id => jawaban
        // Ambil soal dan kunci
        $soal = $this->db->get_where('tb_soal', ['banksoal_id' => $this->input->post('banksoal_id')])->result();
        $benar = 0;
        $total = count($soal);
        foreach ($soal as $s) {
            if (isset($jawaban[$s->id]) && $jawaban[$s->id] == $s->kunci_jawaban) {
                $benar++;
            }
        }
        $nilai = $total > 0 ? round(($benar / $total) * 100, 2) : 0;
        // Update tb_jawaban_ujian
        $this->db->where([
            'jadwal_ujian_id' => $jadwal_ujian_id,
            'siswa_id' => $siswa_id
        ]);
        $this->db->update('tb_jawaban_ujian', [
            'jawaban' => json_encode($jawaban),
            'nilai_akhir' => $nilai,
            'waktu_selesai' => date('Y-m-d H:i:s'),
            'status' => 'selesai'
        ]);
        $this->session->set_flashdata('success', 'Ujian selesai! Nilai Anda: '.$nilai);
        redirect('user/ujianonline');
    }
} 