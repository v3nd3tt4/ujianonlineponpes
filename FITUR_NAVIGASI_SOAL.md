# Fitur Navigasi Soal Ujian Online

## Deskripsi
Sistem ujian online telah diperbarui dengan fitur navigasi soal yang lebih user-friendly dan intuitif.

## Fitur yang Ditambahkan

### 1. Tombol Navigasi Soal
- **Tombol Sebelumnya**: Untuk kembali ke soal sebelumnya
- **Tombol Selanjutnya**: Untuk maju ke soal berikutnya
- **Tombol Selesai**: Untuk menyelesaikan ujian (hanya muncul di soal terakhir)

### 2. Logika Tampilan Tombol
- **Soal Pertama**: Hanya menampilkan tombol "Selanjutnya"
- **Soal Tengah**: Menampilkan tombol "Sebelumnya" dan "Selanjutnya"
- **Soal Terakhir**: Menampilkan tombol "Sebelumnya" dan "Selesai"

### 3. Tombol Akhiri Ujian
- Tombol merah "Akhiri Ujian" di sebelah timer
- Konfirmasi sebelum mengakhiri ujian
- Otomatis menyimpan jawaban yang sudah diisi

### 4. Navigasi Keyboard
- **Arrow Left** atau **A**: Soal sebelumnya
- **Arrow Right** atau **D**: Soal selanjutnya
- **Enter**: Submit ujian (hanya di soal terakhir)

### 5. Fitur Timer yang Ditingkatkan
- Timer dengan format MM:SS
- Peringatan visual saat waktu < 5 menit (warna merah)
- Auto-submit saat waktu habis
- Alert notifikasi saat waktu habis

### 6. Indikator Status Soal
- **Kartu Aktif**: Orange (soal yang sedang ditampilkan)
- **Kartu Terjawab**: Hijau (soal yang sudah dijawab)
- **Kartu Belum Dijawab**: Abu-abu (soal yang belum dijawab)

### 7. Penyimpanan Otomatis
- Jawaban disimpan otomatis ke localStorage
- Jawaban dipulihkan saat halaman dimuat ulang
- localStorage dibersihkan setelah submit

### 8. Keamanan dan UX
- Warning saat mencoba meninggalkan halaman
- Konfirmasi sebelum submit ujian
- Scroll otomatis ke atas saat ganti soal
- Responsive design untuk mobile

## File yang Dimodifikasi

### 1. `application/views/siswa/ujianonline/kerjakan.php`
- Menambahkan tombol navigasi
- Menambahkan tombol akhiri ujian
- Memperbaiki layout dan styling
- Menambahkan CSS untuk responsive design

### 2. `application/views/siswa/ujianonline/script_kerjakan.php`
- Menambahkan fungsi navigasi soal
- Menambahkan keyboard navigation
- Meningkatkan timer functionality
- Menambahkan konfirmasi dan warning
- Memperbaiki localStorage handling

## Cara Penggunaan

### Untuk Siswa:
1. **Navigasi Manual**: Klik tombol "Sebelumnya" atau "Selanjutnya"
2. **Navigasi Kartu**: Klik nomor soal di sidebar
3. **Navigasi Keyboard**: Gunakan arrow keys atau A/D
4. **Akhiri Ujian**: Klik tombol "Akhiri Ujian" atau "Selesai"

### Untuk Developer:
- Semua fungsi sudah modular dan mudah dimodifikasi
- CSS menggunakan class-based styling
- JavaScript menggunakan event-driven architecture
- Responsive design sudah diimplementasikan

## Kompatibilitas
- Browser: Chrome, Firefox, Safari, Edge
- Mobile: Responsive design untuk tablet dan smartphone
- Framework: CodeIgniter 3.x
- Template: Stisla Admin Template

## Troubleshooting
1. **Timer tidak berjalan**: Pastikan JavaScript enabled
2. **Jawaban tidak tersimpan**: Cek localStorage di browser
3. **Tombol tidak muncul**: Pastikan CSS dan JS ter-load dengan benar
4. **Navigasi keyboard tidak bekerja**: Pastikan focus tidak di input field 