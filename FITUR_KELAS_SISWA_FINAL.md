# Fitur "Kelas Anda" - Daftar Kelas Siswa

## Deskripsi
Fitur ini menampilkan **daftar kelas** yang diikuti oleh siswa yang sedang login. Siswa dapat melihat semua kelas yang pernah/sedang diikutinya dan dapat melihat daftar siswa dalam setiap kelas.

## Fitur yang Tersedia

### 1. **Daftar Kelas Siswa**
- Menampilkan semua kelas yang diikuti siswa
- Informasi: Nama Kelas, Tahun Akademik, Wali Kelas, Keterangan
- Diurutkan berdasarkan tahun akademik (terbaru dulu) dan nama kelas

### 2. **Daftar Siswa dalam Kelas**
- Modal yang menampilkan semua siswa dalam kelas tertentu
- Informasi: NIS, Nama, Jenis Kelamin, Email, No HP
- Tombol untuk melihat biodata lengkap siswa

### 3. **Biodata Siswa dengan QR Code**
- Modal yang menampilkan informasi lengkap siswa
- QR code berisi data: `{"nis": "nis_siswa", "id": "id_siswa"}`

## Struktur File

### Controller
- `application/controllers/User/Kelas.php` - Controller utama dengan 3 method:
  - `index()` - Menampilkan daftar kelas siswa
  - `siswa_kelas($kelasrombel_id)` - Menampilkan daftar siswa dalam kelas tertentu
  - `biodata($siswa_id)` - Menampilkan biodata siswa dengan QR code

### Views
- `application/views/siswa/kelas/index.php` - Halaman utama daftar kelas
- `application/views/siswa/kelas/siswa_kelas.php` - Modal content daftar siswa
- `application/views/siswa/kelas/biodata.php` - Modal content biodata siswa
- `application/views/siswa/kelas/script.php` - JavaScript untuk interaksi

### Menu
- Menu "Kelas Anda" di sidebar untuk role siswa

## Cara Penggunaan

1. **Login sebagai siswa**
2. **Klik menu "Kelas Anda" di sidebar**
3. **Lihat daftar kelas yang diikuti**
4. **Klik "Lihat Siswa" untuk melihat daftar siswa dalam kelas tersebut**
5. **Klik "Biodata" untuk melihat informasi lengkap siswa dengan QR code**

## Keamanan

- ✅ Siswa hanya dapat melihat kelas yang diikutinya
- ✅ Siswa hanya dapat melihat daftar siswa dari kelas yang diikutinya
- ✅ Siswa hanya dapat melihat biodata siswa dari kelas yang diikutinya
- ✅ Validasi session dan keanggotaan kelas di setiap method
- ✅ SQL injection protection dengan CodeIgniter Query Builder
- ✅ XSS protection dengan `htmlspecialchars()`

## Database Query

### Daftar Kelas Siswa:
```sql
SELECT tb_kelassiswa.*, tb_kelas.nama_kelas, tb_kelas.keterangan, 
       tb_kelasrombel.id as kelasrombel_id, tb_tahunakademik.tahun, 
       tb_tahunakademik.semester, tb_pegawai.nama as wali_kelas
FROM tb_kelassiswa
JOIN tb_kelasrombel ON tb_kelasrombel.id = tb_kelassiswa.kelasrombel_id
JOIN tb_kelas ON tb_kelas.id = tb_kelasrombel.kelas_id
JOIN tb_tahunakademik ON tb_tahunakademik.id = tb_kelasrombel.tahunakademik_id
JOIN tb_pegawai ON tb_pegawai.id = tb_kelasrombel.walikelas_id
WHERE tb_kelassiswa.siswa_id = [siswa_id]
ORDER BY tb_tahunakademik.tahun DESC, tb_tahunakademik.semester ASC, tb_kelas.nama_kelas ASC
```

### Daftar Siswa dalam Kelas:
```sql
SELECT tb_siswa.*, tb_kelassiswa.id as kelassiswa_id
FROM tb_siswa
JOIN tb_kelassiswa ON tb_kelassiswa.siswa_id = tb_siswa.id
WHERE tb_kelassiswa.kelasrombel_id = [kelasrombel_id]
ORDER BY tb_siswa.nama ASC
```

## QR Code

- Menggunakan Google Charts API (gratis, tanpa dependency)
- Format data: `{"nis": "nis_siswa", "id": "id_siswa"}`
- Dapat digunakan untuk presensi atau identifikasi siswa

## Tabel Database yang Digunakan

- `tb_kelassiswa` - Relasi siswa dengan kelas
- `tb_kelasrombel` - Informasi kelas rombel
- `tb_kelas` - Data kelas
- `tb_siswa` - Data siswa
- `tb_tahunakademik` - Tahun akademik
- `tb_pegawai` - Data wali kelas

## Contoh Tampilan

### Halaman Utama (Daftar Kelas):
```
┌─────────────────────────────────────────────────────────────┐
│ Daftar Kelas Anda                                           │
├─────────────────────────────────────────────────────────────┤
│ No │ Nama Kelas │ Tahun Akademik │ Wali Kelas │ Aksi       │
├────┼────────────┼────────────────┼────────────┼────────────┤
│ 1  │ VII A      │ 2025/2026 - G  │ Pak Guru   │ Lihat Siswa│
│ 2  │ VIII A     │ 2024/2025 - G  │ Bu Guru    │ Lihat Siswa│
└────┴────────────┴────────────────┴────────────┴────────────┘
```

### Modal Daftar Siswa:
```
┌─────────────────────────────────────────────────────────────┐
│ Daftar Siswa Kelas: VII A                                   │
├─────────────────────────────────────────────────────────────┤
│ No │ NIS      │ Nama Siswa │ L/P │ Email │ No HP │ Aksi    │
├────┼──────────┼────────────┼─────┼───────┼───────┼─────────┤
│ 1  │ 1011111  │ Ahmad      │ L   │ ...   │ ...   │ Biodata │
│ 2  │ 1011112  │ Siti       │ P   │ ...   │ ...   │ Biodata │
└────┴──────────┴────────────┴─────┴───────┴───────┴─────────┘
```

## Catatan Penting

- Fitur ini mendukung siswa yang memiliki multiple kelas (misal: kelas paralel, pindah kelas)
- Data diurutkan berdasarkan tahun akademik terbaru
- Modal menggunakan AJAX untuk performa yang lebih baik
- Semua validasi keamanan sudah diterapkan
- Responsive design untuk desktop dan mobile 