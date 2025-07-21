# Changelog - Penambahan Fitur Gambar Soal

## Perubahan Database
- Menambahkan field `gambar_soal` (varchar(255), nullable) ke tabel `tb_soal`
- Field ini disimpan setelah field `soal`

## Perubahan Controller (Banksoal.php)
### Method create_soal()
- Menambahkan handling upload gambar
- Validasi tipe file (gif, jpg, jpeg, png)
- Maksimal ukuran file 2MB
- Enkripsi nama file untuk keamanan
- Membuat direktori upload jika belum ada

### Method update_soal()
- Menambahkan handling update gambar
- Menghapus gambar lama jika upload gambar baru
- Mempertahankan gambar lama jika tidak upload gambar baru

### Method delete_soal()
- Menghapus file gambar saat soal dihapus
- Validasi keberadaan file sebelum dihapus

### Method import_soal()
- Menambahkan field gambar_soal dengan nilai null
- Import Excel tidak mendukung gambar

## Perubahan View
### soalkuncijawaban.php
- Menampilkan gambar soal di tabel daftar soal
- Menambahkan field upload gambar di modal tambah soal
- Menambahkan field upload gambar di modal edit soal
- Menambahkan preview gambar saat ini di modal edit

### kerjakan.php (Ujian Online)
- Menampilkan gambar soal saat siswa mengerjakan ujian
- Responsive image display

## Perubahan JavaScript
### soalkuncijawaban_script.php
- Menambahkan preview gambar saat ini di modal edit
- Handling tampilan gambar existing

## Keamanan
- Membuat direktori upload: `assets/uploads/soal/`
- File .htaccess untuk membatasi akses hanya ke file gambar
- File index.php untuk mencegah directory listing
- Validasi tipe file dan ukuran
- Enkripsi nama file

## File SQL
- `databases/add_gambar_soal_field.sql` - Query untuk menambah field ke database existing
- `databases/db_ujianonlineponpes_27_06_2025.sql` - Database structure dengan field baru

## Cara Penggunaan
1. Jalankan query SQL untuk menambah field `gambar_soal`
2. Pastikan direktori `assets/uploads/soal/` sudah dibuat
3. Upload gambar saat membuat atau edit soal
4. Gambar akan ditampilkan di daftar soal dan saat ujian

## Catatan
- Import Excel tidak mendukung gambar, hanya text
- Gambar dihapus otomatis saat soal dihapus
- Maksimal ukuran gambar 2MB
- Format yang didukung: JPG, JPEG, PNG, GIF 